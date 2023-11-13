<?php

namespace frontend\controllers;

use common\helpers\CommonHelper;
use frontend\models\ImageRates;
use Yii;
use yii\base\InvalidConfigException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions(): array
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionAddRate(): void
    {
        $extId = Yii::$app->request->post('extId');
        $isApproved = Yii::$app->request->post('isApproved');
        $url = Yii::$app->request->post('url');

        $message = 'Оценка успешно добавлена';
        $code = 200;
        $isSuccess = true;
        $isApproved = CommonHelper::convertToBool($isApproved);

        if (isset($extId, $url)) {
            $model = ImageRates::findOne(['ext_id' => (int)$extId]);

            if ($model) {
                $message = 'Эта картинка уже оценена';
                $code = 422;
                $isSuccess = false;
            } else {
                $model = new ImageRates();
                $model->ext_id = (int)$extId;
                $model->url = $url;
                $model->is_approved = (bool)$isApproved;

                if (!$model->save()) {
                    $message = 'Не удалось сохранить оценку';
                    $code = 500;
                    $isSuccess = false;
                }
            }
        } else {
            $message = 'Неверно указаны параметры запроса';
            $code = 422;
            $isSuccess = false;
        }

        $ourResponse = Yii::$app->response;
        $ourResponse->format = Response::FORMAT_JSON;
        $ourResponse->data = [
            'success' => $isSuccess,
            'message' => $message,
            'data' => null,
        ];
        $ourResponse->statusCode = $code;
        $ourResponse->send();
    }

    /**
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function actionGetImage(): void
    {
        // `identity` текущего пользователя. `Null`, если пользователь не аутентифицирован.
        $identity = Yii::$app->user->identity;

        // ID текущего пользователя. `Null`, если пользователь не аутентифицирован.
        $id = Yii::$app->user->id;

        // проверка на то, что текущий пользователь гость (не аутентифицирован)
        $isGuest = Yii::$app->user->isGuest;

        $client = new Client();

        # честное слово - впервые решил такое использовать
        requestPoint:
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setUrl('https://picsum.photos/800/600')
            ->send();

        $ourResponse = Yii::$app->response;
        $ourResponse->format = Response::FORMAT_JSON;

        if ($response->isOk) {
            $headers = $response->getHeaders();
            $url = $headers['location'] ?? null;
            $extId = $headers['picsum-id'] ?? null;

            if (isset($url, $extId)) {
                $model = ImageRates::findOne(['ext_id' => (int)$extId]);

                # Эта картинка уже оценена рекурсивно вновь делаем запрос
                if ($model) {
                    goto requestPoint;
                }

                $ourResponse->data = [
                    'success' => true,
                    'message' => null,
                    'data' => [
                        'url' => $url,
                        'extId' => $extId,
                    ]
                ];
                $ourResponse->statusCode = 200;
            }
        } else {
            $ourResponse->data = [
                'success' => false,
                'message' => 'Не удалось получить картинку.',
                'data' => null,
            ];
            $ourResponse->statusCode = 404;
        }

        $ourResponse->send();

        return;
    }
}

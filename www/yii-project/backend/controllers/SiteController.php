<?php

namespace backend\controllers;

use common\models\LoginForm;
use frontend\models\ImageRates;
use Throwable;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public const ACCESS_TOKEN = 'xyz123';

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'delete'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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

    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    public function actionIndex(?string $token = null): Response|string
    {
        //if (empty($token) || $token !== self::ACCESS_TOKEN) {
        // todo пользователь авторизован видеть контент и администрировать данные
        //    Yii::$app->session->setFlash(
        //        'error',
        //        'Токен доступа некорректен. В доступе отказано.'
        //    );
        //
        //    return $this->goHome();
        //}

        $query = ImageRates::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 30,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin(): Response|string
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id): Response
    {
        $model = ImageRates::findOne($id);

        if (isset($model) && $model->delete()) {
            Yii::$app->session->setFlash(
                    'success',
                    'Оценка успешно отменена.'
                );
        } else {
            Yii::$app->session->setFlash(
                'error',
                'Не удалось отменить оценку.'
            );
        }

        return $this->refresh($anchor = '');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

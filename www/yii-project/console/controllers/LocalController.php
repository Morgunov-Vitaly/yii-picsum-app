<?php

namespace console\controllers;

use backend\controllers\SiteController;
use common\models\User;
use frontend\models\ImageRates;
use yii\console\Controller;
use yii\console\controllers\MigrateController;

class LocalController extends Controller
{
    /**
     * Command: php yii local/add-admin-user
     */
    public function actionAddAdminUser(): void
    {
        echo 'Add admin user...' . PHP_EOL;
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@email.ru';
        $user->setPassword('admin');
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->status = User::STATUS_ACTIVE;

        echo $user->save() ? 'Admin added' . PHP_EOL : 'error' . PHP_EOL;

        if ($user->errors) {
            var_dump($user->getErrors());
        }
    }

    /**
     * Command: php yii local/test-code
     */
    public function actionTestCode(): void
    {
        \Yii::$app->runAction('site/get-image');
      //  \Yii::$app->runAction('migrate', ['migrationPath' => '@yii/rbac/migrations/']);
        dump(
            ImageRates::find()->all()
        );
    }
}
<?php

namespace console\controllers;

use common\models\User;
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
     * Command: php yii local/apply-migrations
     */
    public function actionApplyMigrations(): void
    {
        \Yii::$app->runAction('migrate', ['migrationPath' => '@yii/rbac/migrations/']);
    }
}
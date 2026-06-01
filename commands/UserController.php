<?php

namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

class UserController extends Controller
{
    public function actionCreate(string $username, string $password): int
    {
        $user = new User();
        $user->username = $username;
        $user->setPassword($password);
        $user->generateAuthKey();

        if ($user->save()) {
            echo "User '$username' created.\n";
            return ExitCode::OK;
        }

        echo "Failed: " . implode(', ', $user->getFirstErrors()) . "\n";
        return ExitCode::UNSPECIFIED_ERROR;
    }
}
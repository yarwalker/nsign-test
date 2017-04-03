<?php

namespace common\helpers;

use Yii;
use common\models\UserStatus;

class UserHelper
{
    public static function getRoleDescription($user_id)
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser($user_id);
        $result = '';

        foreach($roles as $key => $role)
            $result .= $role->description . ' ';

        return $result;
    }

    public static function getRoleKey($user_id)
    {
        $auth = Yii::$app->authManager;
        return key($auth->getRolesByUser($user_id));
    }

    public static function getRolesList()
    {
        $roles = [];
        $auth = Yii::$app->authManager;
        foreach($auth->getRoles() as $key => $role) {
            $roles[$key] = $role->description;
        }

        return $roles;
    }

    public static function getStatusList()
    {
        $states = UserStatus::find()->asArray()->all();
        $result = [];
        foreach($states as $state) {
            $result[$state['id']] = $state['title'];
        }
        krsort($result);

        return $result;
    }

    public static function setRole($user_id, $role)
    {
        $auth = Yii::$app->authManager;
        $auth->revokeAll($user_id);
        $auth->assign($auth->getRole($role), $user_id);
    }
}


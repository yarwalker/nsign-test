<?php

namespace backend\modules\users\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "user_view".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $email
 * @property integer $status
 * @property string $role
 * @property string $role_title
 * @property string $status_title
 */
class UserView extends ActiveRecord
{
    public $pass;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_view';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['username', 'password_hash', 'email', 'role', 'status_title'], 'required'],
            [['role_title'], 'string'],
            [['username', 'password_hash', 'email', 'status_title'], 'string', 'max' => 255],
            [['role'], 'string', 'max' => 64],
            [['pass'], 'string', 'min' => 6],
            [['username', 'email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'password_hash' => 'Хэш пароля',
            'email' => 'Email',
            'status' => 'Статус',
            'role' => 'Роль',
            'role_title' => 'Роль',
            'status_title' => 'Статус',
            'pass' => 'Пароль',
        ];
    }
}

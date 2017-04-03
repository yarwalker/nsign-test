<?php
/**
 * Created by PhpStorm.
 * User: avs
 * Date: 01.04.17
 * Time: 11:05
 */

namespace backend\modules\users\models;

use common\helpers\UserHelper;
use Yii;
use yii\base\Model;
use common\models\User;

class UserForm extends Model
{
    const PASS_LENGTH = 6;

    public $id = 0;
    public $username = '';
    public $email ='';
    public $role = 'manager';  // по умолчанию роль - менеджер
    public $status = 10;
    public $pass = '';
    public $isNewRecord = true;

    public function rules()
    {
        return [
            [['email', 'role', 'status'], 'required'],
            ['email', 'email'],
            ['username', 'string', 'min' => 3],
            ['pass', 'validatePassword'],
        ];
    }

    public function __construct($user_id = null)
    {
        parent::__construct();

        if( !is_null($user_id) ) {
            $user = UserView::findOne(['id' => $user_id]);

            $this->id = $user->id;
            $this->username = $user->username;
            $this->email = $user->email;
            $this->status = $user->status;
            $this->role = $user->role;
            $this->isNewRecord = false;
        }
    }

    public function validatePassword()
    {
        if( !$this->pass )
            return true;

        if( strlen($this->pass) < self::PASS_LENGTH )
            return false;
    }

    public function save()
    {
        if( $this->validate() ) {
            // сохраним данные по пользователю
            $user = $this->id ? User::findOne($this->id) : new User();
            $attributes = [
                'username' => substr($this->email,0, strpos($this->email, '@')),
                'email' => $this->email,
                'status' => $this->status
            ];
            if( $this->pass )
                $attributes['password_hash'] = Yii::$app->security->generatePasswordHash($this->pass);

            $user->setAttributes($attributes, false);
            if( $user->save() ) {
                UserHelper::setRole($user->id, $this->role);
                return $user;
            } else
                return false;
        } else
            return false;
    }

}
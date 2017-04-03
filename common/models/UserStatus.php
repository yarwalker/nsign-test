<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_status".
 *
 * @property integer $id
 * @property string $title
 */
class UserStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'state'], 'required'],
            [['id'], 'integer'],
            [['title', 'state'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'state' => 'Статус',
        ];
    }

    public static function getStatusByState($state)
    {
        return self::findOne(['state' => $state]);
    }

    public static function getStatusById($id)
    {
        return self::findOne($id);
    }
}

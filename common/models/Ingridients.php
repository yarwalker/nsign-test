<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ingridients".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $state
 *
 * @property DishesIngridients[] $dishesIngridients
 */
class Ingridients extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 'Активен';
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingridients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['state'], 'string'],
            [['name', 'image'], 'string', 'max' => 255],
            [['file'], 'safe'],
            [['file'], 'file', 'extensions' => 'jpg,gif,png'],
            [['file'], 'file', 'maxSize' => '20971520'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'image' => 'Изображение',
            'state' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishesIngridients()
    {
        return $this->hasMany(DishesIngridients::className(), ['ingridient_id' => 'id']);
    }
}

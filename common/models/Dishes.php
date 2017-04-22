<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dishes".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $description
 *
 * @property DishesIngridients[] $dishesIngridients
 */
class Dishes extends \yii\db\ActiveRecord
{
    public $file;
    public $ingridients;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dishes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name', 'image'], 'string', 'max' => 255],
            [['file'], 'safe'],
            [['file'], 'file', 'extensions' => 'jpg,gif,png'],
            [['file'], 'file', 'maxSize' => '20971520'],
            [['ingridients'], 'safe'],

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
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishesIngridients()
    {
        return $this->hasMany(DishesIngridients::className(), ['dish_id' => 'id']);
    }


}

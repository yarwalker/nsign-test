<?php

namespace frontend\models;

use common\models\Ingridients;
use Yii;
use yii\base\Model;

class ChooseDishForm extends Model
{
    public $ingridients;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ingridients'], 'in', 'range' => Ingridients::find()->select('id')->asArray()->column()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ingridients' => 'Ингридиенты',
        ];
    }
}
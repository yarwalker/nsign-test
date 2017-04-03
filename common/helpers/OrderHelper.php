<?php

namespace common\helpers;

use Yii;
use common\models\Goods;

class OrderHelper
{
    public static function getGoodsList()
    {
        $goods = Goods::find()->asArray()->all();
        $result = [];
        foreach($goods as $key => $good) {
            $result[$good['id']] = $good['name'];
        }

        return $result;
    }

    public static function getGoodNameByID($good_id)
    {
        return Goods::findOne($good_id)->name;
    }

}


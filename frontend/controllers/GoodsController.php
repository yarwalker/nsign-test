<?php

namespace frontend\controllers;

use Yii;
use common\models\Goods;
use yii\web\Controller;

class GoodsController extends Controller
{
    public function actionGetPrice($good_id)
    {
        return Goods::findOne($good_id)->price;
    }

}
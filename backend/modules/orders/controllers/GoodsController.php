<?php

namespace backend\modules\orders\controllers;

use Yii;
use yii\web\Controller;
use common\models\Goods;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class GoodsController extends Controller
{
    public function actionGetPrice($good_id)
    {
        return Goods::findOne($good_id)->price;
    }


}

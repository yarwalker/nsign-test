<?php

namespace frontend\controllers;

use Yii;
use common\models\Goods;
use common\models\Orders;
use yii\web\Controller;

class OrdersController extends Controller
{
    public function actionCreateOrder()
    {
        $model = new Orders();


        if( $model->load(Yii::$app->request->post()) && $model->save() ) {
            return $this->redirect(['site/index']);
        } else {
            $tmp_arr = Goods::find()->asArray()->all();
            $goods = [];

            foreach($tmp_arr as $good)
                $goods[$good['id']] = $good['name'];

            $model->name = $model->newname;

            return $this->render('create-order',
                [
                    'model' => $model,
                    'goods' => $goods,
                ]);
        }
    }


}

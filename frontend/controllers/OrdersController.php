<?php

namespace frontend\controllers;

class OrdersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}

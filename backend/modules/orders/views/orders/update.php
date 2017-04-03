<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */

$module = \Yii::$app->controller->module;
$this->title = $module->params['name'];
$this->title = 'Изменение заявки: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $module->params['name'], 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';

use backend\modules\orders\assets\OrdersAsset;
OrdersAsset::register($this);
?>
<div class="container-fluid">
    <div class="row">
        <div id="orders-update" class="col-lg-6">

            <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

            <?= $this->render('_form', [
                'model' => $model,
                'goods' => $goods,
            ]) ?>

        </div>
    </div>
</div>
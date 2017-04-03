<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */

$module = \Yii::$app->controller->module;
$this->title = 'Просмотр "' . $model->name . '"';
$this->params['breadcrumbs'][] = ['label' => $module->params['name'], 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'goodName',
            'price',
            'customer_fio',
            'customer_phone',
            'comments:ntext',
            'status',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
            ],
            'updaterName',
        ],
    ]) ?>

</div>
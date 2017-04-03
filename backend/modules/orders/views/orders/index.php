<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$module = \Yii::$app->controller->module;
$this->title = $module->params['name'];
$this->params['breadcrumbs'][] = $this->title;

$actions_template = !Yii::$app->user->can('editOrderPermition') ? '{view}' : '{view} {update}';
?>
<div class="orders-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?/*= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->
    <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'name',
                'goodName',
                'customer_fio',
                'customer_phone',
                'status',
                [
                    'attribute' => 'created_at',
                    'format' => ['date', 'php:d.m.Y H:i:s'],
                ],
                'comments:ntext',
                'price',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => $actions_template,
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                                'orders/view?id='.$model->id,
                                ['title' => 'Просмотр']);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                'orders/update?id='.$model->id,
                                ['title' => 'Редактировать']);
                        },
                    ],
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?></div>
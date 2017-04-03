<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\UserStatus;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$module = \Yii::$app->controller->module;
$this->title = $module->params['name'];
$this->params['breadcrumbs'][] = $this->title;

use backend\modules\users\assets\UsersAsset;
UsersAsset::register($this);

$actions_template = !Yii::$app->user->can('editUserPermition') ? '{view}' : '{view} {update} {delete}';
?>
<div id="user-index">
    <?php if( Yii::$app->user->can('editUserPermition') ): ?>
        <p><?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?></p>
    <?php endif; ?>

    <?php Pjax::begin(['id' => 'users']); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute' => 'id',
                    'headerOptions' => [ 'width' => '30' ]
                ],
                'username',
                'email:email',
                'stateName',
                [
                    'attribute' => 'created_at',
                    'format' => ['date', 'php:d.m.Y H:i:s'],
                ],
                [
                    'attribute' => 'updated_at',
                    'format' => ['date', 'php:d.m.Y H:i:s'],
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => $actions_template,
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                                'users/view?id='.$model->id,
                                ['title' => 'Просмотр']);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                'users/update?id='.$model->id,
                                ['title' => 'Редактировать']);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                                'users/delete?id='.$model->id,
                                [
                                    'title' => 'Удалить',
                                    'data-method' => 'post',
                                    'class' => 'del_item',
                                    'data-pjax' => '#users'
                                ]);
                        }
                    ],
                ],


            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UserStatus;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Просмотр "' . $model->username . '"';
$module = \Yii::$app->controller->module;
$this->params['breadcrumbs'][] = ['label' => $module->params['name'], 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="user-view col-lg-6">
            <?php if( Yii::$app->user->can('editUserPermition') ): ?>
                <p>
                    <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Вы уверены что хотите удалить этого пользователя?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            <?php endif; ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'email:email',
                    [
                        'label' => 'Роль',
                        'value' => $role,
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function($model){
                            $state = UserStatus::getStatusById($model->status);
                            return $state->title;
                        },
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'php:d.m.Y H:i:s'],
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => ['date', 'php:d.m.Y H:i:s'],
                    ],
                ],
            ]) ?>

        </div>
    </div>
</div>

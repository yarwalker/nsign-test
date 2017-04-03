<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$module = \Yii::$app->controller->module;
$this->title = 'Создание пользователя';
$this->params['breadcrumbs'][] = ['label' => $module->params['name'], 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="user-create">

            <?= $this->render('_form', [
                'model' => $model,
                'roles' => $roles,
                'states' => $states,
            ]) ?>

        </div>
    </div>
</div>
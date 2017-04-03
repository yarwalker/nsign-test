<?php

/* @var $this yii\web\View */
/* @var $model common\models\User */

$module = \Yii::$app->controller->module;
$this->title = 'Изменение пользователя: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => $module->params['name'], 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="container-fluid">
    <div class="row">
        <div class="user-update col-lg-6">
            <?= $this->render('_form', [
                'model' => $model,
                'roles' => $roles,
                'states' => $states,
            ]) ?>
        </div>
    </div>
</div>

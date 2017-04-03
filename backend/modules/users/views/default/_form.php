<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(['id' => 'user-form']); ?>
    <?= $form->field($model, 'email')->label('Email')->input('email') ?>
    <?= $form->field($model, 'pass')->label('Пароль')->textInput() ?>
    <?= $form->field($model, 'status')
             ->label('Статус')
             ->dropDownList($states, ['prompt' => 'Выберите один вариант']);
    ?>
    <?= $form->field($model, 'role')
             ->label('Роль')
             ->dropDownList($roles, ['prompt' => 'Выберите один вариант']);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>



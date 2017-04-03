<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'good_id')->dropDownList($goods) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'customer_fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Принята' => 'Принята', 'Отказана' => 'Отказана', 'Брак' => 'Брак', ], ['prompt' => 'Выберите статус']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
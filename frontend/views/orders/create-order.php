<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Оформление заказа';
$this->params['breadcrumbs'][] = $this->title;

use backend\modules\orders\assets\OrdersAsset;
OrdersAsset::register($this);
?>
<div class="container">
    <div class="row">
        <div class="create-order col-lg-6 col-lg-offset-3">
            <h1><?= Html::encode($this->title) ?></h1>

            <?php $form = ActiveForm::begin(['id' => 'create-order-form']); ?>

            <?= $form->field($model, 'customer_fio')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'customer_phone')->textInput() ?>

            <?= $form->field($model, 'good_id')
                     ->dropDownList($goods, ['prompt' => 'Выберите один товар']);
            ?>
            <?= $form->field($model, 'price')->textInput(['readonly' => true]) ?>

            <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'create-order-button']) ?>
            </div>

            <?= $form->field($model, 'name')->label('')->hiddenInput() ?>


            <?php ActiveForm::end(); ?>
    </div>
</div>




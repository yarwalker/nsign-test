<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\bootstrap\Modal;

?>
<h3>Выбор блюд по ингридиентам</h3>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <?php $form = ActiveForm::begin(['id' => 'order-form', 'enableAjaxValidation' => true]); ?>
            <div class="form-group">
                <?= Html::submitButton('Подобрать блюда', [
                        'class' => 'btn btn-primary',
                        'id' => 'choose-dish',
                ]) ?>
            </div>
            <div class="info">Выбрано <span>0</span> ингридиент(а/ов)</div>

            <div class="form-group ingridient-block">
                <?= ListView::widget([
                    'dataProvider' => $availableIngridientsProvider,
                    'itemView' => '_view',
                    'summary' => false,
                ]); ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-9">
            <div id="chosen-dish">

            </div>
        </div>
    </div>
</div>

<?php Modal::begin([
        'header' => '<h2>Сообщение</h2>',
        'headerOptions' => ['id' => 'modalMessageHeader'],
        'id' => 'modalMessage',
        'size' => 'modal-md',
        //keeps from closing modal with esc key or by clicking out of the modal.
        // user must click cancel or X to close
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE, ],
    ]
);

Modal::end();
?>


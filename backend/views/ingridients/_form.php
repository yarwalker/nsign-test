<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Ingridients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingridients-form">
    <?php Pjax::begin(['id' => 'ingridients-form-pjax']); ?>
        <?php $form = ActiveForm::begin(['options'=> ['enctype'=> 'multipart/form-data']]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?php if( !empty($model->image) ) { ?>
            <div class="form-group">
                <?= Html::img(Yii::$app->params['uploadWebPath'] . $model->image, ['alt' => $model->name, 'height' => '200']); ?>
                <a href="#" class="del-image" data-id="<?= $model->id; ?>"><span class="glyphicon glyphicon-remove del" aria-hidden="true" data-placement="top" title="Удалить"></span></a>
            </div>
        <?php } else { ?>
            <?= $form->field($model, 'file')->label($model->getAttributeLabel('image'))
                    ->widget(FileInput::classname(), [
                        'options' => ['accept' => 'image/*', 'multiple' => false ],
                        'pluginOptions' => [
                            'showPreview' => false,
                            'showCaption' => true,
                            'showRemove' => false,
                            'showUpload' => false,
                            'overwriteInitial' => true,
                            'allowedFileExtensions' => ['jpg','gif','png'],
                            'maxFileSize' => 20971520
                        ]
                    ]); ?>
        <?php } ?>


        <?= $form->field($model, 'state')->dropDownList([ 'Активен' => 'Активен', 'Скрыт' => 'Скрыт', ]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
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

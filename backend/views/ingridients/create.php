<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Ingridients */

$this->title = 'Создание ингридиента';
$this->params['breadcrumbs'][] = ['label' => 'Ингридиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="ingridients-create col-lg-6">
            <?php
            $errors = $model->getErrors();
            $str = '';

            if( !empty($errors) ):
                foreach ($errors as $value) {
                    foreach( $value as $v )
                        $str .= $v . '<br/>';
                }

                echo Alert::widget([
                    'options' => [
                        'class' => 'alert-danger'
                    ],
                    'body' => '<b>Ошибка!</b> ' . $str
                ]);
            endif;
            ?>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>

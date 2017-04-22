<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Dishes */

$this->title = 'Создание блюда';
$this->params['breadcrumbs'][] = ['label' => 'Блюда', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="dishes-create col-lg-6">

            <?= $this->render('_form', [
                'model' => $model,
                'availableIngridientsProvider' => $availableIngridientsProvider,
                'currentIngridientsProvider' => $currentIngridientsProvider,
            ]) ?>
        </div>
    </div>
</div>

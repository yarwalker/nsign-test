<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Dishes */

$this->title = 'Изменение блюда: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Блюда', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="container-fluid">
    <div class="row">
        <div class="dishes-update col-lg-6">
            <?= $this->render('_form', [
                'model' => $model,
                'availableIngridientsProvider' => $availableIngridientsProvider,
                'currentIngridientsProvider' => $currentIngridientsProvider,
            ]) ?>
        </div>
    </div>
</div>

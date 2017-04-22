<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Ingridients */

$this->title = 'Изменение ингридиента: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ингридиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'изменение';
?>
<div class="container-fluid">
    <div class="row">
        <div class="ingridients-update col-lg-6">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>

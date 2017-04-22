<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DishesIngridients */

$this->title = 'Create Dishes Ingridients';
$this->params['breadcrumbs'][] = ['label' => 'Dishes Ingridients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dishes-ingridients-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

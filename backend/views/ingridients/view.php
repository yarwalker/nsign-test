<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Ingridients */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ингридиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="ingridients-view col-lg-6">

            <p>
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены что хотите удалить этот ингридиент?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    //'image',
                    [
                        'attribute' => 'image',
                        'value' => ($model->image ? Yii::$app->params['uploadWebPath'] . $model->image : Yii::$app->params['uploadWebPath'] . 'noimage.png'),
                        'format' => ['image',['height'=>'200']],
                    ],
                    'state',
                ],
            ]) ?>
        </div>
    </div>
</div>

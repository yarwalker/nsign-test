<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\DishesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блюда';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dishes-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать блюдо', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            //'image',
            [
                'attribute'=>'image',
                'label'=>'Изображение',
                'format'=>'html',
                'value' => function ($data) {
                    $url = $data['image'] ? Yii::$app->params['uploadWebPath'] . $data['image'] : Yii::$app->params['uploadWebPath'] . 'noimage.png';
                    return Html::img($url, ['alt' => $data['name'], 'height' => '60']);
                },
                'contentOptions' => ['class' => 'text-center'],
            ],
            'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

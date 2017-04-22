<?php
use yii\widgets\ListView;

echo ListView::widget([
    'dataProvider' => $dishesProvider,
    'itemView' => '_single_dish',
    'summary' => false,
]);
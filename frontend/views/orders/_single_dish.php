<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$url = $model['image'] ? Yii::$app->params['uploadWebPath'] . $model['image'] : Yii::$app->params['uploadWebPath'] . 'noimage.png';
$name = Html::encode($model['name']);
?>

<div class="ingridient">
    <div class="row">
        <div class="col-lg-3">
            <h4><?= $name ?></h4>
            <?= Html::img($url, ['alt' => $name, 'height' => '60'])?>
        </div>
        <div class="col-lg-9">
            <p><strong>Описание:</strong></p>
            <p><?= HtmlPurifier::process($model['description']) ?></p>
        </div>
    </div>
</div>
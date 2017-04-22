<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$url = $model->image ? Yii::$app->params['uploadWebPath'] . $model->image : Yii::$app->params['uploadWebPath'] . 'noimage.png';
$name = Html::encode($model->name);
?>

<div class="ingridient" data-id="<?= $model->id; ?>">
    <h5><?= $name ?></h5>
    <?= Html::img($url, ['alt' => $name, 'height' => '60'])?>
</div>



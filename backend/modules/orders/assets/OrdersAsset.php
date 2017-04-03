<?php
namespace backend\modules\orders\assets;

use yii\web\AssetBundle;

class OrdersAsset extends AssetBundle
{
    public $sourcePath = '@backend/modules/orders/assets';
    public $css = [
        'css/orders_style.css',
    ];
    public $js = [
        'js/orders_script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
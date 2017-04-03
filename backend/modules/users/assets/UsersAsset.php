<?php
namespace backend\modules\users\assets;

use yii\web\AssetBundle;

class UsersAsset extends AssetBundle
{
    public $sourcePath = '@backend/modules/users/assets';
    public $css = [
        'css/users_style.css',
    ];
    public $js = [
        'js/users_script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
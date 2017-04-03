<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'datatables/dataTables.bootstrap.css',
        'css/site.css',
    ];
    public $js = [
        'datatables/dataTables.bootstrap.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'dmstr\web\AdminLteAsset',
    ];
}

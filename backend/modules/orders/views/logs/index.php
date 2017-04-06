<?php

//use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\orders\models\LogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Логи изменений';
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    'object',
    'object_name',
    'field',
    'old_value',
    'new_value',
    [
        'attribute' => 'updated_at',
        'format' => ['date', 'php:d.m.Y H:i:s'],
    ],
    'updaterName',
   // ['class' => 'kartik\grid\ActionColumn', 'urlCreator'=>function(){return '#';}]
];

$fullExportMenu = ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    'target' => ExportMenu::TARGET_BLANK,
    'fontAwesome' => true,
    'pjaxContainerId' => 'kv-pjax-container',
    'dropdownOptions' => [
        'label' => 'Full',
        'class' => 'btn btn-default',
        'itemsBefore' => [
            '<li class="dropdown-header">Export All Data</li>',
        ],
    ],
]);



?>
<div class="logs-index">
    <?php Pjax::begin(); ?>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            //'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Library</h3>',
        ],
        // set a label for default menu
        'export' => [
            'label' => 'Page',
            'fontAwesome' => true,
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            $fullExportMenu,
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['/logs'], [
                    'data-pjax'=>0,
                    'class' => 'btn btn-default',
                    'title'=>Yii::t('kvgrid', 'Reset Grid')
                ])
            ],
        ]
    ]);

    ?>
    <?php Pjax::end(); ?>

</div>
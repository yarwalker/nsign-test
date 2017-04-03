<?php

namespace backend\modules\orders;

class Orders extends \yii\base\Module
{
	public $controllerNamespace = 'backend\modules\orders\controllers';

    public function init()
    {
        parent::init();



        // инициализация модуля с помощью конфигурации, загруженной из config.php
    	\Yii::configure($this, require(__DIR__ . '/config/config.php'));

    	//$this->setAliases(['@orders-assets' => __DIR__ . '/assets']);
    }

}
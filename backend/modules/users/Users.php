<?php

namespace backend\modules\users;

class Users extends \yii\base\Module
{
	public $controllerNamespace = 'backend\modules\users\controllers';

    public function init()
    {
        parent::init();

        // инициализация модуля с помощью конфигурации, загруженной из config.php
    	\Yii::configure($this, require(__DIR__ . '/config/config.php'));

    	//$this->setAliases(['@users-assets' => __DIR__ . '/assets']);
    }

}
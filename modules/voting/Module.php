<?php

namespace app\modules\voting;


/**
 * voiting module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\voting\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
//        \Yii::configure($this, require  __DIR__ . 'config.php');

        // custom initialization code goes here
    }
}

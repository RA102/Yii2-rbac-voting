<?php

namespace app\modules\voting\controllers;

use app\models\Site,
    mdm\admin\models\form\Login,
    yii\helpers\ArrayHelper,
    yii\web\Controller,
    mdm\admin\models\form\PasswordResetRequest;
    mdm\admin\models\form\Signup;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

}

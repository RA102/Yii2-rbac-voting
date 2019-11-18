<?php

namespace app\modules\voting\controllers;

use Codeception\Module\Yii2;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

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
//        $getRolesByUser = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->getId());
//        $getUserIdentityRole = \Yii::$app->getUser()->identity->getId();
//        $getAssignments = \Yii::$app->authManager->getAssignment(\Yii::$app->user->getId());

//        $role = ArrayHelper::keyExists( 'manager' ,$getRolesByUser, false);
//        echo "<pre>";
//        var_dump($getRolesByUser, $role);


//        if (\Yii::$app->user->isGuest) {
//            return $this->redirect('/web/site/login');
//        } elseif ( ArrayHelper::keyExists( 'user' ,$getRolesByUser, false) || ArrayHelper::keyExists( 'manager', $getRolesByUser, false)) {
//            return $this->redirect('member');
//        } elseif (ArrayHelper::keyExists( 'counting' ,$getRolesByUser, false)) {
//            return $this->redirect('result');
//        }
        return $this->render('index');
    }
}

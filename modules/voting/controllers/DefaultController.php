<?php

namespace app\modules\voting\controllers;

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
        if (\Yii::$app->user->isGuest) {
            return $this->redirect('/web/site/login');
        } else if (\Yii::$app->authManager->getRole('user') || \Yii::$app->authManager->getRole('manager')) {
            return $this->redirect('member');
        } else if (\Yii::$app->authManager->getRole('counting commission')) {
            return $this->redirect('result');
        }
        #return $this->render('index');
    }
}

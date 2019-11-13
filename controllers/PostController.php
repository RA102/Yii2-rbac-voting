<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Post;

class PostController extends Controller
{

    function behaviors()
    {
        return [
            'access' => [
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $model = Post::find()->all();

        return $this->render('index', ['model' => $model]);
    }

}
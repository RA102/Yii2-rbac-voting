<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Result;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Results';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="result-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Result', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'member.name' => [
                'label' => 'Участники',
                'filter' => Html::activeDropDownList($searchModel, 'member_id', ArrayHelper::map(Result::find()->all(), 'member_id', 'member.name'), ['prompt' => '', 'class' => 'form-control form-control-sm']),
                'value' => function($data){
                    return $data->member->name;
                },
            ],
            'users.username' => [
                'label' => 'комиссия',
                'filter' => Html::activeDropDownList($searchModel, 'user_id', ArrayHelper::map(Result::find()->all(), 'user_id', 'users.username'), ['prompt' => '', 'class' => 'form-control form-control-sm']),
                'value' => function($data){
                    return $data->users->username;
                },
            ],
            'type.name' => [
                'label' => 'Как проголосовал',
                'filter' => Html::activeDropDownList($searchModel, 'type_id', ArrayHelper::map(Result::find()->all(), 'type_id', 'type.name'), ['prompt' => '', 'class' => 'form-control form-control-sm']),
                'value' => function($data){
                    return ($data->type == 0) ? ' ' : $data->type->name;
                },
            ],
            #'count',
            #['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

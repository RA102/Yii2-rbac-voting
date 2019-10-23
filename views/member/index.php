<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Member', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'faculty',
            'department',
            'specialty',
            #'theme',
            #'active',
            #'status_student_id',
            #'data',
            'Button' => [
                'label' => 'Кнопки',
                'format' => 'raw',
                'visible' => Yii::$app->user->can('accessMember'),
                'contentOptions' => ['class' => 'd-flex'],
                'value' => function($data){
                    return Html::a('За', ['index?type=2&memberid='.$data->id], ['class' => 'btn btn-success btn-sm  mr-1']) .
                        Html::a('Против', ['index?type=3&memberid='.$data->id], ['class' => 'btn btn-danger btn-sm  mr-1']) .
                        Html::a('Воздержался', ['index?type=1&memberid='.$data->id], ['class' => 'btn btn-warning  btn-sm']);
                },
            ],
            'Student' => [
                'label' => 'Назначить',
                'format' => 'raw',
                'visible' => Yii::$app->user->can('accessManager'),
                'contentOptions' => ['class' => 'd-flex'],
                'value' => function($data){
                    return Html::a('Защита', ['index?memberid='.$data->id], ['class' => 'btn btn-success btn-sm  mr-1'] );
                },

            ],


            #['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Member;
use app\models\Vote;



/* @var $this yii\web\View */
/* @var $searchModel app\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $vote yii\models\Vote */

$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <span>
        <?= Html::a('Create Member', ['create'], ['class' => 'btn btn-success']) ?>
    </span>
    <!--
    <span>
        <?/*= Html::a('All', ['class' => 'btn btn-success']) */?>
    </span>
    -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<?php //echo "<pre>"; print_r();die; ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'id' => 'container',
            'options' => ['style' => 'max-width: max-content;'],
            'tableOptions' => ['class' => 'table table-bordered'],
            #'emptyCell' => '-',
            'rowOptions' => function($model) {
                return ($model->active) ? ['class' => 'mark-row'] : false;
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                #'id',
                'name' => [
                    'label' => 'ФИО',
                    'filter'=> [
                        Html::activeDropDownList($searchModel, 'name', ArrayHelper::map(Member::find()->all(), 'name', 'name'), ['prompt' => '', 'class' => 'form-control form-control-sm']),

                    ],
                    'contentOptions' => ['style' => 'vertical-align: middle'],
                    'value' => function($data) {
                        return $data->name;
                    },
                ],
                'faculty' => [
                    'label' => 'Факультет',
                    'contentOptions' => ['style' => 'vertical-align: middle'],
                    'value' => function($data) {
                        return $data->faculty;
                    }
                ],
                'department' => [
                        'label' => 'Департамент',
                        'contentOptions' => ['style' => 'vertical-align: middle'],
                        'value' => function($data) {
                            return $data->department;
                        }
                ],
                'specialty' => [
                    'label' => 'Специальность',
                    'contentOptions' => ['style' => 'vertical-align: middle'],
                    'value' => function($data) {
                        return $data->specialty;
                    }
                ],
                 [
                     'label' => '',
                     'format' => 'raw',
                     'visible' => Yii::$app->user->can('accessVote'),
                     'contentOptions' => ['class' => 'd-table-cell', 'style' => 'vertical-align: middle;'],
                     'value' => function($data) {
                        return $data->result->type->name;
                     },

                ],
                #'theme',
                #'active',
//                'type.name' => [
//                    'label' => 'Статус',
////                    'filter' => Html::activeDropDownList($searchModel, 'type_id', ArrayHelper::map(Result::find()->all(), 'type_id', 'type.name'), ['prompt' => '', 'class' => 'form-control form-control-sm']),
//                    'value' => function($data){
////                        echo "<pre>";
////                        print_r($data);die;
//                        return $data->type->name;
////                        return $
////                        echo "<pre>"; print_r($data);die;
//                    },
//                ],
//                'status.status' => [
//                    'label' => 'Статус',
//                    'filter' => Html::activeDropDownList($searchModel, 'status_student_id', ArrayHelper::map(Member::find()->all(), 'status_student_id', 'status.status'), ['prompt' => '', 'class' => 'form-control form-control-sm']),
//                    'value' => function($data){
//                    return $data->status->status;
//                    },
//                ],

                'Button' => [
                    'label' => 'Кнопки',
                    'format' => 'raw',
                    'visible' => Yii::$app->user->can('accessVote'),
                    'contentOptions' => ['class' => 'd-table-cell', 'style' => 'vertical-align: middle;'],
                    'value' => function($data) {
                         if ($data->active == 2) {
                             return Html::a('За', ['index?type=3&memberid='.$data->id], ['class' => 'btn btn-success btn-sm  mr-1'] ) .
                            Html::a('Против', ['index?type=1&memberid='.$data->id], ['class' => 'btn btn-danger btn-sm  mr-1'] ) .
                            Html::a('Недействительный', ['index?type=2&memberid='.$data->id], ['class' => 'btn btn-warning  btn-sm']);
                        } else {
                             return Html::a('За', ['index?type=3&memberid=' . $data->id],['class' => 'btn btn-success btn-sm  mr-1 disabled']) .
                            Html::a('Против', ['index?type=1&memberid=' . $data->id], ['class' => 'btn btn-danger btn-sm  mr-1 disabled']) .
                            Html::a('Недействительный', ['index?type=2&memberid=' . $data->id], ['class' => 'btn btn-warning  btn-sm disabled']);
                        }
                    },
                ],
                'data' => [
                    'label' => 'Дата',
                    'format' => ['date', 'php:d.m.Y'],
                    'visible' => Yii::$app->user->can('accessAppoint'),
                    'filter' => Html::activeDropDownList($searchModel, 'data', ArrayHelper::map(Member::find()->all(), 'data', 'data'), ['prompt' => 'Все', 'class' => 'form-control form-control-sm']),
                    'value' => function($data){
                        return $data->data;
                    },
                ],
                'Student' => [
                    'label' => 'Назначить',
                    'format' => 'raw',
                    'visible' => Yii::$app->user->can('accessAppoint'),
                    'contentOptions' => ['class' => 'd-table-cell'],
                    'value' => function($data) {
    //                    return Html::a('Защита', ['index?status=2&memberid='.$data->id], ['class' => 'btn btn-success btn-sm  mr-1',  'id' => 'appoint'] );
                        return Html::a('Защита', ['index?active=2&memberid='.$data->id], ['class' => 'btn btn-success btn-sm  mr-1',  'id' => 'appoint'] );
                    },

                ],

                ['class' => 'yii\grid\ActionColumn', 'headerOptions' => ['width' => '40'], 'template' => '{view}{link}'],
            ],
        ]); ?>
</div>

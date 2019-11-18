<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\voting\models\Member;
use app\modules\voting\models\Vote;



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
        <?= Html::a('Create Member', ['create'], ['class' => 'btn btn-success'] ) ?>
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
            'options' => ['style' => 'max-width: max-content;', 'text-align: center;'],
            'tableOptions' => ['class' => 'table table-bordered'],
            'rowOptions' => function($model) {
                return ($model->active == 2) ? ['class' => 'mark-row'] : false;
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
                     'label' => 'Результат',
                     'format' => 'raw',
                     'visible' => Yii::$app->user->can('accessVote'),
                     'contentOptions' => ['class' => 'd-table-cell', 'style' => 'vertical-align: middle;'],
                     'value' => function($data) {
                        return ($data->result == 0) ? ' ' : $data->result->type->name;
                     },

                ],
               'Button' => [
                    'label' => 'Кнопки',
                    'format' => 'raw',
                    'visible' => Yii::$app->user->can('accessVote'),
                    'contentOptions' => ['class' => 'd-table-cell', 'style' => 'vertical-align: middle;'],
                    'value' => function($data) {
                         if ($data->active == 2) {
                             return Html::a('За', ['index?type=3&memberid='.$data->id], ['class' => 'btn btn-success btn-bg  mr-1'] ) .
                            Html::a('Против', ['index?type=1&memberid='.$data->id], ['class' => 'btn btn-danger btn-bg  mr-1'] );
                        } else {
                             return Html::a('За', ['index?type=3&memberid=' . $data->id],['class' => 'btn btn-success btn-bg  mr-1 disabled']) .
                            Html::a('Против', ['index?type=1&memberid=' . $data->id], ['class' => 'btn btn-danger btn-bg  mr-1 disabled']);
                        }
                    },
                ],
                'data' => [
                    'label' => 'Дата',
                    'format' => ['date', 'php:d.m.Y'],
                    'visible' => Yii::$app->user->can('accessAppoint'),
                    'filter' => Html::activeDropDownList($searchModel, 'data', ArrayHelper::map(Member::find()->all(), 'data', 'data'), ['prompt' => 'Все', 'class' => 'form-control form-control-sm']),
                    'value' => function($data){
                        return Yii::$app->formatter->asDate($data->data);
                    },
                ],
                'Student' => [
                    'label' => 'Назначить',
                    'format' => 'raw',
                    'visible' => Yii::$app->user->can('accessAppoint'),
                    'contentOptions' => ['class' => 'd-table-cell'],
                    'value' => function($data) {
                        if ($data->active == 1 || $data->active == 2)
                        {
                            return Html::a('Назначить', ['index?active=2&memberid='.$data->id], ['class' => 'btn btn-success btn-sm  mr-1 disabled',  'id' => 'appoint'] );
                        } else {
                            return Html::a('Назначить', ['index?active=2&memberid='.$data->id], ['class' => 'btn btn-success btn-sm  mr-1',  'id' => 'appoint'] );
                        }
                    },

                ],
                '' => [
                    'label' => 'Статус',
                    'visible' => Yii::$app->user->can('accessAppoint'),
                    'value' => function($data) {
                        if( !($data->active) ) {
                            return 'Не защищался';
                        } elseif ( $data->active == 1 ) {
                             return 'Защищался';
                        } elseif ( $data->active == 2) {
                            return 'На защите';
                        }
                    }
                ],

                #['class' => 'yii\grid\ActionColumn', 'headerOptions' => ['width' => '40'], 'template' => '{view}{link}'],
            ],
        ]); ?>
</div>

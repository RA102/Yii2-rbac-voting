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
        <?php if (Yii::$app->user->can('accessAppoint')) {
            echo Html::a('Create Member', ['create'], ['class' => 'btn btn-success']);
        }
        ?>
    </span>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'id' => 'container',
            'options' => ['style' => 'max-width: 100%; text-align: center;'],
            'tableOptions' => ['class' => 'table table_blur'],
            'rowOptions' => function($model) {
                return ($model->active == 2) ? ['class' => 'danger'] : ['class' => 'info'];
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
//                'id',
                'name' => [
                    'label' => 'ФИО',
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'filter'=> [
                        Html::activeDropDownList($searchModel, 'name', ArrayHelper::map(Member::find()->all(), 'name', 'name'), ['prompt' => '', 'class' => 'form-control form-control-sm']),

                    ],
                    'contentOptions' => ['style' => 'vertical-align: middle;'],
                    'value' => function($data) {
                        return $data->name;
                    },
                ],
                'faculty' => [
                    'label' => 'Факультет',
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'filter'=> [
                        Html::activeDropDownList($searchModel, 'faculty', ArrayHelper::map(Member::find()->all(), 'faculty', 'faculty'), ['prompt' => '', 'class' => 'form-control form-control-sm']),

                    ],
                    'contentOptions' => ['style' => 'vertical-align: middle'],
                    'value' => function($data) {
                        return $data->faculty;
                    }
                ],
                'department' => [
                    'label' => 'Департамент',
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'contentOptions' => ['style' => 'vertical-align: middle'],
                    'value' => function($data) {
                            return $data->department;
                    }
                ],
                'specialty' => [
                    'label' => 'Специальность',
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'contentOptions' => ['style' => 'vertical-align: middle'],
                    'value' => function($data) {
                        return $data->specialty;
                    }
                ],
                'theme' => [
                    'label' => 'Тема',
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'contentOptions' => ['style' => 'vertical-align: middle'],
                    'value' =>
                        function($data)
                    {
                        return $data->theme;
                    },
                ],
                [
                    'label' => 'Результат',
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'format' => 'raw',
                    'visible' => Yii::$app->user->can('accessVote'),
                    'contentOptions' => ['class' => 'd-table-cell', 'style' => 'vertical-align: middle;'],
                    'value' => function($data) {
                        return ($data->result == 0) ? ' ' : $data->result->type->name;
                    },

                ],
               'Button' => [
                   'label' => 'Кнопки',
                   'headerOptions' => ['style' => 'text-align: center;'],
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
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'format' => ['date', 'php:d.m.Y'],
                    'contentOptions' => ['style' => 'vertical-align: middle;'],
                    'visible' => Yii::$app->user->can('accessAppoint'),
                    'filter' => Html::activeDropDownList($searchModel, 'data', ArrayHelper::map(Member::find()->all(), 'data', 'data'), ['prompt' => 'Все', 'class' => 'form-control form-control-sm']),
                    'value' => function($data){
                        return Yii::$app->formatter->asDate($data->data);
                    },
                ],
                'Student' => [
                    'label' => 'Назначить',
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'format' => 'raw',
                    'visible' => Yii::$app->user->can('accessAppoint'),
                    'contentOptions' => ['class' => 'd-table-cell', 'style' => 'vertical-align: middle;'],
                    'value' => function($data) {
                        if ($data->active == 1 || $data->active == 2)
                        {
                            return Html::a('Назначить', ['index?active=2&memberid='.$data->id], ['class' => 'btn btn-success appoint btn-sm  mr-1 disabled',  'id' => "appoint"] );
                        } else {
                            return Html::a('Назначить', ['index?active=2&memberid='.$data->id], ['class' => 'btn btn-success appoint btn-sm  mr-1',  'id' => 'appoint'] );
                        }
                    },

                ],
                '' => [
                    'label' => 'Статус',
                    'headerOptions' => ['style' => 'text-align: center;'],
                    'visible' => Yii::$app->user->can('accessAppoint'),
                    'contentOptions' => ['style' => 'vertical-align: middle;'],
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

//                ['class' => 'yii\grid\ActionColumn', 'headerOptions' => ['width' => '40'], 'template' => '{view}{link}'],
            ],
        ]); ?>
</div>
<?php
$script = <<< JS

let obj = document.getElementsByClassName('appoint');
for (let i =0; i < obj.length; i++) {
    obj[i].addEventListener('click', function(event) {
        event.preventDefault();
        this.textContent = 'Закончить голосование';
        this.style.backgroundColor = "red";
                
        let href = this.getAttribute('href');
        let regExp = /active=\d/;
        let newHref = href.replace(regExp, "active=1");
        this.setAttribute('href', newHref);
        
        
    });
}


JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
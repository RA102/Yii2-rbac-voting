<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Member;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
        <?/*= Html::a('All', ['All'], ['class' => 'btn btn-success']) */?>
    </span>
    <span>
        <?/*= Html::a('Today', ['create'], ['class' => 'btn btn-success']) */?>
    </span>
    -->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'id' => 'container',
            'options' => ['style' => 'max-width: max-content'],
            'tableOptions' => ['class' => 'table table-bordered'],
            'rowOptions' => function($model) {
                return ($model->active) ? ['class' => 'mark-row'] : false;
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                #'id',
                'name',
                'faculty',
                'department',
                'specialty',
                #'theme',
                #'active',
                'status.status' => [
                    'label' => 'Статус',
                    'filter' => Html::activeDropDownList($searchModel, 'status_student_id', ArrayHelper::map(Member::find()->all(), 'status_student_id', 'status.status'), ['prompt' => '', 'class' => 'form-control form-control-sm']),
                    'value' => function($data){
                        return $data->status->status;
                    },
                ],

                'data' => [
                    'label' => 'Дата',
                    'visible' => Yii::$app->user->can('accessVote'),
                    'filter' => Html::activeDropDownList($searchModel, 'data', ArrayHelper::map(Member::find()->all(), 'data', 'data'), ['prompt' => '', 'class' => 'form-control form-control-sm']),
                    'value' => function($data){
                        return $data->data;
                    },
                ],
                'Button' => [
                    'label' => 'Кнопки',
                    'format' => 'raw',
                    'visible' => Yii::$app->user->can('accessVote'),
                    'contentOptions' => ['class' => 'd-table-cell'],
                    'value' => function($data) {
                         if ($data->active == 2) {
                             return Html::a('За', ['index?type=3&memberid='.$data->id], ['class' => 'btn btn-success btn-sm  mr-1'] ) .
                            Html::a('Против', ['index?type=1&memberid='.$data->id], ['class' => 'btn btn-danger btn-sm  mr-1'] ) .
                            Html::a('Воздержался', ['index?type=2&memberid='.$data->id], ['class' => 'btn btn-warning  btn-sm']);
                        } else {
                             return Html::a('За', ['index?type=3&memberid=' . $data->id],['class' => 'btn btn-success btn-sm  mr-1', 'disabled' => 'disable']) .
                            Html::a('Против', ['index?type=1&memberid=' . $data->id], ['class' => 'btn btn-danger btn-sm  mr-1', 'disabled' => 'disable']) .
                            Html::a('Воздержался', ['index?type=2&memberid=' . $data->id], ['class' => 'btn btn-warning  btn-sm', 'disabled' => 'disable']);
                        }
                    },
                ],
                'data' => [
                    'label' => 'Дата',
                    'visible' => Yii::$app->user->can('accessAppoint'),
                    'filter' => Html::activeDropDownList($searchModel, 'data', ArrayHelper::map(Member::find()->all(), 'data', 'data'), ['prompt' => '', 'class' => 'form-control form-control-sm']),
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

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
<?php


$this->registerJs('setInterval( function() {
    $.pjax.reload({container: "cintainer"})
}, 10000');

?>

</div>

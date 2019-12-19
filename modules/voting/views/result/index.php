<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\modules\voting\models\Result;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\voting\models\ResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $countMemberCommission app\modules\voting\controllers\ResultController */
/* @var $countVotesFor app\modules\voting\controllers\ResultController */
/* @var $countVotesAgainst app\modules\voting\controllers\ResultController */
/* @var $countVotesInvalid app\modules\voting\controllers\ResultController */

//$this->title = 'Results';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="result-index">

<!--    <h1 class="text-center">--><?//= Html::encode($this->title) ?><!--</h1>-->
    <h2 class="text-center">Результаты голосования</h2>

    <p class="text-right">
        <?= Html::a('Создать протокол голосования', ['create-protocol'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered table_dark'],
        'showFooter' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'member.name' => [
                'label' => 'Участники',
                'filter' => Html::activeDropDownList($searchModel, 'member_id', ArrayHelper::map(Result::find()->all(), 'member_id', 'member.name'), ['prompt' => 'Все', 'class' => 'form-control form-control-sm']),
                'value' => function($data){
                    return $data->member->name;
                },
            ],
            'type.name' => [
                'label' => '',
                'filter' => Html::activeDropDownList($searchModel, 'type_id', ArrayHelper::map(Result::find()->all(), 'type_id', 'type.name'), ['prompt' => 'Все', 'class' => 'form-control form-control-sm']),
                'value' => function($data) {
                    return ($data->type == 0) ? ' ' : $data->type->name;
                },
                'footer' => '',
            ],
            '' => [
                'label' => 'Время',
                'format' => 'raw',
                'value' => function($data)
                {
                    return $data->time_voted !== null ? Yii::$app->formatter->asDatetime($data->time_voted, 'php:H:i d-m-Y') : '-'; #date('d-m-Y H:m:s', $data->time_voted);
                    //return $data->time_voted !== null ? Yii::$app->getFormatter()->asDate($data->time_voted) : '-';
                }
            ],
            #'count',
            #['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

<?php if ($countMemberCommission != 0): ?>
    <div class="text-center">
        <h2 class="text-dark"><?php echo "Всего: " . $countMemberCommission?></h2>
        <h2 class="text-dark"><?php echo "ЗА: " . $countVotesFor ?></h2>
        <h2 class="text-dark"><?php echo "Против: " . $countVotesAgainst ?></h2>
        <h2 class="text-dark"><?php echo "Не действительных: " . $countVotesInvalid ?></h2>
    </div>
<?php endif; ?>

</div>

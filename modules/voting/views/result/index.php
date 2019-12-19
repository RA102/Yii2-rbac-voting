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

$this->title = 'Results';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="result-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

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

    <div class="row text-center">
        <h2>Протокол по итогам тайного голосования</h2>
        <h3>диссертационного совета</h3>
        <h3>по специальности <em>Специальность</em> </h3>
        <h3>Карагандинского государственного технического университета</h3>
    </div>
    <div class="container text-right">
        <p class="">от <?php date('d.M.Y') ?><em>Дата</em></p>
    </div>
    <div class="container text-left">
        <h4>Подсчет голосов при тайном голосовании по дисертации <em>ФИО</em>
<!--            --><?php //var_dump(ArrayHelper::getColumn($, 'member_id'));?><!-- -->
            на соискание степени доктора философии(PhD) по специальности <em>"Cпециальность"</em>.</h4>
        <h4>Тема докторской дессиртации <em>"Тема"</em></h4>
    </div>


</div>

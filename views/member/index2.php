<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Member */

//$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<!--<div class="member-view">-->
<!---->
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<?php ////echo "<pre>"; print_r($activeUser);die ?>
<!---->
<!--    --><?//= DetailView::widget([
//        'model' => $activeUser,
//        'attributes' => [
//            'name',
//            'faculty',
//            'department',
//            'specialty',
//            'theme',
//            [
//                'format' => 'raw',
//                'label' => '',
//                'value' => Html::a('За', ['index?type=3&memberid='.$data->id], ['class' => 'btn btn-success btn-sm  mr-1'] ) .
//                            Html::a('Против', ['index?type=1&memberid='.$data->id], ['class' => 'btn btn-danger btn-sm  mr-1'] ) .
//                            Html::a('Недействительный', ['index?type=2&memberid='.$data->id], ['class' => 'btn btn-warning  btn-sm']),
//            ],
//        ],
//    ]) ?>
<!--</div>-->

<?php var_dump($activeUser) ?>

<?php Html::tag("h4", Html::encode($model->name), ['class' => 'text-center']) ?>
<!--<h2 class="text-center">-->
<!--    --><?//= $activeUser->name ?>
<!--</h2>-->
<h3 class="text-center">
    <?= $activeUser->faculty ?>
</h3>
<h3 class="text-center">
    <?= $activeUser->department ?>
</h3>
<h3 class="text-center">
    <?= $activeUser->specialty ?>
</h3>
<h3 class="text-center">
    <?= $activeUser->theme ?>
</h3>



<?php
$js = "let wi = document.querySelectorAll('tbody tr th');
 for (let i=0; i < wi.length; i++) {
    wi[i].style.width = '162px';
}";
$this->registerJS($js, 5); ?>
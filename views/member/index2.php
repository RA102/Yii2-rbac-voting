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
<div class="member-view">

<!--    --><?//= DetailView::widget([
//        'model' => $activeUser,
//        'attributes' => [
//            [
//                'label' => 'ФИО',
//                'value' => $activeUser->name,
//            ],
//            [
//                'label' => 'Факультет',
//                'value' => $activeUser->faculty,
//            ],
//            [
//                'label' => 'Департамент',
//                'value' => $activeUser->department,
//            ],
//            [
//                'label' => 'Специальность',
//                'value' => $activeUser->specialty,
//            ],
//            [
//                'label' => 'Тема',
//                'contentOptions' => ['class' => ''],
//                'value' => $activeUser->theme,
//            ],
//
//            [
//                'format' => 'raw',
//                'label' => '',
//                'value' => Html::a('За', ['index?type=3&memberid='.$data->id], ['class' => 'btn btn-success btn-bg  mr-1'] ) .
//                            Html::a('Против', ['index?type=1&memberid='.$data->id], ['class' => 'btn btn-danger btn-bg  mr-1'] ) ,
////                            Html::a('Недействительный', ['index?type=2&memberid='.$data->id], ['class' => 'btn btn-warning  btn-bg']),
//            ],
//        ],
//    ])?>






<h2 class="text-center">
    <?= $activeUser->name ?>
</h2>
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

<?=
Html::a('За', ['index?type=3&memberid='.$data->id], ['class' => 'btn btn-success btn-bg  mr-1'] ) .
Html::a('Против', ['index?type=1&memberid='.$data->id], ['class' => 'btn btn-danger btn-bg  mr-1'] )
?>
</div>
<?php
$js = "let wi = document.querySelectorAll('tbody tr th');
 for (let i=0; i < wi.length; i++) {
    wi[i].style.width = '162px';
}";
$this->registerJS($js, 5); ?>
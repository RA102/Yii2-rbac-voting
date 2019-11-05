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

    <h1><?= Html::encode($this->title) ?></h1>
<?php //echo "<pre>"; print_r($activeUser);die ?>

    <?= DetailView::widget([
        'model' => $activeUser,
        'options' => ['style' => 'max-width: max-content'],
        'attributes' => [
            'name',
            'faculty',
            'department',
            'specialty',
            'theme',
        ],
    ]) ?>
</div>


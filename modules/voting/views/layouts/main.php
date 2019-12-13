<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label' => 'Счетная комиссия',
                'url' => '/web/voting/result?', //Url::toRoute(['web/voting/result', 'ResultSearch' => ['member_id' => \app\modules\voting\models\Member::getMemberIdByActive()]]),
                'visible' => Yii::$app->user->can('accessResult'),
            ],
            [
                'label' => 'Менеджер',
                'url' => '/web/voting/member',
                'visible' => Yii::$app->user->can('accessAppoint')
            ],
            [
                'label' => 'Комиссия',
                'url' => '/web/voting/member',
                'visible' => Yii::$app->user->can('accessVote')
            ],
//            [
//                'label' => 'Распечатать список комиссии',
//                'url' => 'print-list-commissions',
//                'linkOptions' => ['id' => 'printList'],
//                'visible' => Yii::$app->user->can('accessAppoint')
//            ],
            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выход (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php
$script = <<<JS
let linkDom = document.getElementById('printList');
linkDom.addEventListener('click', function(e) { 
    e.preventDefault();
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'print-list-commissions', false);
    xhr.send();
    if (xhr.status != 200) {
        alert ('Закройте файл списка');
    } else {
        alert('Файл сохранен в /web');
    }
});

JS;
$this->registerJs($script);
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


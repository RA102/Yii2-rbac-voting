<?php
use yii\bootstrap\Html;
use \yii\helpers\Url;
?>
<?php
//$url = Url::toRoute('printListCommissions');
//var_dump($url);$url = Url::toRoute('printListCommissions');
//var_dump($url);
?>
<div class="admin-default-index">
    <div class="container">
        <div class="row">
            <h3 class="text-center">
                После авторизации перейтите по ссылке в меню
            </h3>
        </div>

    </div>
</div>

<?php
$script = <<<JS



JS;
$this->registerJs($script);
?>

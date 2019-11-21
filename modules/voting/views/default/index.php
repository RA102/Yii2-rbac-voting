<?php
use yii\bootstrap\Html;
use \yii\helpers\Url;
?>
<?php
$url = Url::toRoute('printListCommissions');
var_dump($url);
?>
<div class="admin-default-index">
    <div class="container">
        <div class="row">
            <p>

            </p>
        </div>

    </div>
<!--    ['default/printListCommissions']-->
    <p>
        <?= (Yii::$app->user->can('accessManager')) ? Html::a('Распечатать', ['default/printListCommissions'], ['id' => 'printList', 'class' => 'btn btn-lg btn-success']) : '' ?>
    </p>

    <p>

    </p>
</div>

<?php
$script = <<<JS

let linkDom = document.getElementById('printList');
console.log(linkDom);
linkDom.addEventListener('click', (e) => { return false; });

JS;
$this->registerJs($script);
?>

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
                <div class="flex-center-children vh-1 padding-1">
                    <div id="sample-card" class="card" >
                        <div class="close-button">
                            X
                        </div>
                        <div id="sample-button" class="button" >
                            More info
                        </div>
                        <div id="sample-paragraph" class="muddle" > Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia voluptatum id at laborum inventore ex non, magnam fugiat, consequatur fugit, vero quisquam qui fuga soluta ullam iure voluptatibus. Ab, nihil.
                        </div>
                    </div>
                </div>

            </h3>
        </div>

    </div>
</div>

<?php
$script = <<<JS



JS;
$this->registerJs($script);
?>

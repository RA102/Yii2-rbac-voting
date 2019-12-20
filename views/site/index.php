<?php

/* @var $this yii\web\View */


$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать</h1>

        <p class="lead">Система онлайн голосования</p>
        <?php
            if (Yii::$app->user->isGuest) { ?>
                <p><a class="btn btn-lg btn-success" href="site/login">Войти</a></p>
            <?php
            } else {
                ?>
                <p><a class="btn btn-lg btn-success" href="site/login">Войти</a></p>
        <?php
            }  ?>


    </div>


</div>
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Login */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="site-login">-->
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!---->
<!--    <p>Please fill out the following fields to login:</p>-->
<!---->
<!--    <div class="row">-->
<!--        <div class="col-lg-5">-->
<!--            --><?php //$form = ActiveForm::begin(['id' => 'login-form']); ?>
<!--            --><?//= $form->field($model, 'username') ?>
<!--            --><?//= $form->field($model, 'password')->passwordInput() ?>
<!--            --><?//= $form->field($model, 'rememberMe')->checkbox() ?>
<!--            <div style="color:#999;margin:1em 0">-->
<!--                If you forgot your password you can --><?//= Html::a('reset it', ['site/request-password-reset']) ?><!--.-->
<!--                For new user you can --><?//= Html::a('signup', ['site/signup']) ?><!--.-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                --><?//= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
<!--            </div>-->
<!--            --><?php //ActiveForm::end(); ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="container">
    <div class="row">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'login-form']
    ]); ?>

        <h1>Login</h1>

        <div class="txtb">
            <input id="login-username" type="password" name="Login[username]" area-required="true" type="text">
            <span data-placeholder="Username"></span>
            <p class="help-block help-block-error"></p>
        </div>

        <div class="txtb">
            <input id="login-password" type="password" name="Login[password]" area-required="true">
            <span data-placeholder="Password"></span>
            <p class="help-block help-block-error"></p>
        </div>

        <div style="color:#999;margin:1em 0">
            If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
            For new user you can <?= Html::a('signup', ['site/signup'], ['class' => 'bottom-text']) ?>.
        </div>

        <input type="submit" class="logbtn" value="Login">
    <?php ActiveForm::end(); ?>

    </div>
</div>

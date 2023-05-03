<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\captcha\Captcha;

?>

<main class="main-container">
    <div class="login-wrapper">

    <div class="login-box">
    <div class="login-logo">
        <div class="left-container">
            <div class="header">
                <!-- <a class="arrow" href="#">←</a> -->
                <?= Html::a(
                    '<svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="24px" height="24px">    <path d="M 12 2 A 1 1 0 0 0 11.289062 2.296875 L 1.203125 11.097656 A 0.5 0.5 0 0 0 1 11.5 A 0.5 0.5 0 0 0 1.5 12 L 4 12 L 4 20 C 4 20.552 4.448 21 5 21 L 9 21 C 9.552 21 10 20.552 10 20 L 10 14 L 14 14 L 14 20 C 14 20.552 14.448 21 15 21 L 19 21 C 19.552 21 20 20.552 20 20 L 20 12 L 22.5 12 A 0.5 0.5 0 0 0 23 11.5 A 0.5 0.5 0 0 0 22.796875 11.097656 L 12.716797 2.3027344 A 1 1 0 0 0 12.710938 2.296875 A 1 1 0 0 0 12 2 z"/></svg>',
                    ['home/index'],
                    ['class' => 'arrow']
                ) ?>
                <?= Html::a(
                    'Login',
                    ['site/login'],
                    ['class' => 'register']
                ) ?>
            </div>
            <div class="main">
                <h2>Lupa Password</h2>
                <p>Silahkan masukkan email anda di form berikut.</p>
                <!-- display success message -->
                <?php if (Yii::$app->session->hasFlash('success')) : ?>
                    <p style="color:#00f">
                        <?= Yii::$app->session->getFlash('success') ?>
                    </p>
                <?php endif; ?>

                <!-- display error message -->
                <?php if (Yii::$app->session->hasFlash('error')) : ?>
                    <p style="color:#f00">
                        <?= Yii::$app->session->getFlash('error') ?>
                    </p>
                <?php endif; ?>
                <?php $form = ActiveForm::begin([
                    'id' => 'forgot-form',
                    'enableClientValidation' => false,
                ]); ?>

                <div class="row">
                    <label for="Email">Email</label>
                    <input class="form-control" name="Lupa[email]" id="ContactForm_email" type="email">

                    <div class="login-now">
                        <?= Html::submitButton('Submit', ['name' => 'login-button', 'id' => 'logIn']) ?>
                    </div>
                    <span class="line"></span>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="footer">
                
            </div>
        </div>
        <!--Right container(img) -->
        
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
    </div>
</main>
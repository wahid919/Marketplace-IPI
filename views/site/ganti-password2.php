<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\captcha\Captcha;

?>

<main class="main-container">
    <div class="login-wrapper">

        <div class="left-container">
            <div class="header">
            <?= Html::a(
                    '←',
                    ['site/login'],
                    ['class' => 'arrow']
                ) ?>
                <?= Html::a(
                    'Login',
                    ['site/login'],
                    ['class' => 'register']
                ) ?>
            </div>
            <div class="main">
                <h2>Ganti Password</h2>
                <p>Silahkan masukkan password baru anda di form berikut.</p>
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
                    'id' => 'Ganti-form',
                ]); ?>

                <div class="row">
                    <label for="Email">Password baru</label>
                    <input class="form-control" name="Ganti[password]" id="ContactForm_email" type="password">
                    <input name="Ganti[tokenhid]" id="ContactForm_email" type="hidden" value="<?php echo $model->secret_link ?>">
                    
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
</main>
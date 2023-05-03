<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */

$set = \app\models\Setting::find()->all();
$this->title = 'Masuk - ' . Yii::$app->name;

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">

        <?= Html::img(["uploads/setting/" . $set["0"]->logo], ["width" => "210px"]) ?>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Silakan masukkan username & password</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username'), 'type' => 'email']) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
        <?= $form->field($model, 'reCaptcha', ["template" => "{input}"])->widget(
            \himiklab\yii2\recaptcha\ReCaptcha3::className(),
            [
                'siteKey' => Yii::$app->params['recaptcha3.clientKey'], // unnecessary is reCaptcha component was set up
                'action' => 'login',
            ]
        ) ?>
        <div class="col-12">
            
        <?= Html::a('Lupa Password?', \yii\helpers\Url::to(['/site/lupa-password'])) ?>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <?= Html::submitButton('<i class="fa fa-lock"></i> Masuk', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
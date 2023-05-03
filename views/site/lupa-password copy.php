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
        <p class="login-box-msg">Silakan masukkan email anda disini</p>
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

        <div class="col-12">
        <label for="Email">Password baru</label>
                    <input class="form-control" name="Ganti[password]" id="ContactForm_email" type="password">
                    <input name="Ganti[tokenhid]" id="ContactForm_email" type="hidden" value="<?php echo $model->secret_link ?>">
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-8">
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                
            <?= Html::submitButton('<i class="fa fa-lock"></i> Submit', ['class' => 'btn btn-primary btn-block btn-flat','id'=>'logIn', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
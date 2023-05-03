<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */

$set = \app\models\Setting::find()->all();
$this->title = 'Lupa Password - ' . Yii::$app->name;

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<style>
    #forgot-form input {
        border-radius: 1.2rem;
        padding: .4rem 1rem;
        border: 1px solid #ccc;
    }

    #forgot-form .control-label {
        z-index: 9999;
        position: relative;
        bottom: -1.7rem;
        font-size: .8rem;
        left: 1.2rem;
        padding: .3rem;
        background: whitesmoke;
    }

    /* Change autocomplete styles in WebKit */
    #forgot-form input:-webkit-autofill,
    #forgot-form input:-webkit-autofill:hover,
    #forgot-form input:-webkit-autofill:focus,
    #forgot-form textarea:-webkit-autofill,
    #forgot-form textarea:-webkit-autofill:hover,
    #forgot-form textarea:-webkit-autofill:focus,
    #forgot-form select:-webkit-autofill,
    #forgot-form select:-webkit-autofill:hover,
    #forgot-form select:-webkit-autofill:focus {
        -webkit-box-shadow: 0 0 0px 1000px whitesmoke inset;
    }

    .btn-registrasi {
        width: 100%;
        border-radius: 1rem
    }
</style>

<?php $form = ActiveForm::begin([
    'id' => 'forgot-form',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-error'
]); ?>

<div class="col-row">
    <label for="Email">Email</label>
    <input class="form-control" name="Lupa[email]" id="ContactForm_email" type="email">
</div>
<hr>
<div class="col-md-12">
    <div class="col-md-12">
        <button class="btn btn-primary btn-xs btn-registrasi">
            <?= Yii::t("cruds", "Submit") ?>
        </button>
    </div>
</div>
<?php ActiveForm::end(); ?>
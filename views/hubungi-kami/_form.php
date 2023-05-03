<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var app\models\HubungiKami $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="box box-info">
    <div class="box-body">
        <?php $form = ActiveForm::begin([
        'id' => 'HubungiKami',
        'layout' => 'horizontal',
        'enableClientValidation' => true,
        'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
        );
        ?>
        
			<?= $form->field($model, 'id')->textInput() ?>
			<?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'nomor_hp')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'perusahaan')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'pesan')->textarea(['rows' => 6]) ?>
			<?= $form->field($model, 'flag')->textInput() ?>
			<?= $form->field($model, 'created_at')->textInput() ?>
			<?= $form->field($model, 'updated_at')->textInput() ?>        <hr/>
        <?php echo $form->errorSummary($model); ?>
        <div class="row">
            <div class="col-md-offset-3 col-md-10">
                <?=  Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn-success']); ?>
                <?=  Html::a('<i class="fa fa-chevron-left"></i> Kembali', ['index'], ['class' => 'btn btn-default']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
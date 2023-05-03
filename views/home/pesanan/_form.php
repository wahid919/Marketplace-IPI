<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var app\models\Pesanan $model
* @var yii\widgets\ActiveForm $form
*/

?>

<div class="box box-info">
    <div class="box-body">
        <?php $form = ActiveForm::begin([
        'id' => 'Pesanan',
        'layout' => 'horizontal',
        'enableClientValidation' => true,
        'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
        );
        ?>
        
			<?= $form->field($model, 'id')->textInput() ?>
			<?= $form->field($model, 'invoice')->textInput() ?>
			<?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'nominal')->textInput() ?>
			<?= $form->field($model, 'usrid')->textInput() ?>
			<?= $form->field($model, 'created_at')->textInput() ?>
			<?= $form->field($model, 'updated_at')->textInput() ?>
			<?= $form->field($model, 'status_id')->textInput() ?>        <hr/>
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
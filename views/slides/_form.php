<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use kartik\file\FileInput;

/**
 * @var yii\web\View $this
 * @var app\models\Slides $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="box box-info">
    <div class="box-body">
        <?php $form = ActiveForm::begin(
            [
                'id' => 'Slides',
                'layout' => 'horizontal',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error'
            ]
        );
        ?>
        <?= $form->field($model, 'judul')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'sub_judul')->textarea(['maxlength' => true]) ?>
        <?= $form->field($model, 'loc_text')->dropDownList(
            ['left' => 'Kiri', 'right' => 'Kanan', 'center' => 'Tengah']
    ); ?>
        <?= $form->field(
            $model,
            'gambar'
        )->widget(FileInput::classname(), [
            'options' => ['accept' => 'file/*'],
            'pluginOptions' => [
                'allowedFileExtensions' => ['png', 'jpg', 'jpeg'],
                'maxFileSize' => 6500,
                'dropZoneEnabled' => false,
                'showCaption' => true,
                'showRemove' => false,
                'showUpload' => false,
                'browseLabel' => 'Upload File',
            ],
        ]); ?>
        <?= $form->field($model, 'status')->dropDownList(
            ['1' => 'Aktif', '0' => 'Nonaktif']
        ); ?>
        <hr />
        <?php echo $form->errorSummary($model); ?>
        <div class="row">
            <div class="col-md-offset-3 col-md-10">
                <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn-success']); ?>
                <?= Html::a('<i class="fa fa-chevron-left"></i> Kembali', ['index'], ['class' => 'btn btn-default']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
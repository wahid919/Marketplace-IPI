<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var app\models\Keuntungan $model
* @var yii\widgets\ActiveForm $form
*/
$this->registerJsFile(Yii::getAlias("@web/tinymce/tinymce.min.js"));
// $uploadlink = Url::to(['site/upload-image']);
// $csrf = Yii::$app->request->csrfToken;

$this->registerJs("
      tinymce.init({
        selector: '.tinymce-form',
        height: '400',
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount',
        ],

        toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
      });
");
?>

<div class="box box-info">
    <div class="box-body">
        <?php $form = ActiveForm::begin([
        'id' => 'Keuntungan',
        'layout' => 'horizontal',
        'enableClientValidation' => true,
        'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
        );
        ?>
        
			<?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
			<?= $form->field($model, 'isi')->textarea(['class' => 'tinymce-form form-control']) ?>        <hr/>
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
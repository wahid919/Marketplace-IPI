<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use kartik\file\FileInput;

/**
* @var yii\web\View $this
* @var app\models\Setting $model
* @var yii\widgets\ActiveForm $form
*/

?>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#setting-tentang_kami',
        height : '400',
    });
    tinymce.init({
        selector: 'textarea#setting-visi',
        height : '400',
    });
    tinymce.init({
        selector: 'textarea#setting-misi',
        height : '400',
    });
    tinymce.init({
        selector: 'textarea#setting-deskripsi_video',
        height : '400',
    });tinymce.init({
        selector: 'textarea#setting-isi_motivasi',
        height : '400',
    });
</script>
<div class="box box-info">
    <div class="box-body">
        <?php $form = ActiveForm::begin([
        'id' => 'Setting',
        'layout' => 'horizontal',
        'enableClientValidation' => true,
        'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
        );
        ?>
         <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <?= $form->field($model, 'nama_web', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <?= $form->field($model, 'judul_web', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3">
                <?= $form->field($model, 'instagram', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <?= $form->field($model, 'facebook', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <?= $form->field($model, 'twitter', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <?= $form->field($model, 'telegram', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <?= $form->field($model, 'nama_motivasi', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <?= $form->field($model, 'jabatan_motivasi', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'isi_motivasi', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'visi', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'misi', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textarea(['rows' => 6]) ?>
            </div>
        </div>

        <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'alamat', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'slogan_web', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textarea(['rows' => 6]) ?>
            </div>
        </div>
         <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'judul_tentang_kami', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textInput(['maxlength' => true]) ?>
            </div>
         </div>
         <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'tentang_kami', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textarea(['rows' => 6]) ?>
            </div>
         </div>
         <div class="row">

         <div class="col-sm-12 col-md-6 col-lg-6">
                <?= $form->field($model, 'telepon', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <?= $form->field($model, 'email', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textInput(['maxlength' => true]) ?>
            </div>
         </div>
         <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'embed_ig', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->textarea(['rows' => 6]) ?>
            </div>
         </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <?= $form->field($model, 'logo', [
                    'template' => '
                                {label}
                                {input}
                                {error}
                            ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->widget(FileInput::classname(), [
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
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <?= $form->field($model, 'foto_tentang_kami', [
                    'template' => '
                                {label}
                                {input}
                                {error}
                            ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->widget(FileInput::classname(), [
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
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <?= $form->field($model, 'foto_member', [
                    'template' => '
                                {label}
                                {input}
                                {error}
                            ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->widget(FileInput::classname(), [
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
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'banner', [
                    'template' => '
                                {label}
                                {input}
                                {error}
                            ',
                    'inputOptions' => [
                        'class' => 'form-control'
                    ],
                    'labelOptions' => [
                        'class' => 'control-label'
                    ],
                    'options' => ['tag' => false]
                ])->widget(FileInput::classname(), [
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
            </div>
            
            <div class="clearfix"></div>
        </div>


        
			     <hr/>
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
<?php

use app\components\Constant;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var app\models\FotoProduk $model
 * @var yii\widgets\ActiveForm $form
 */

?>




<hr class="mt-0">
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <?= $this->render('../component/sidemenu-toko') ?>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section pb-20">
            <h3 class="text-isalam-1 font-weight-bold text-detail-program pl-20">
                <?= $model->isNewRecord ? 'Tambah' : 'Update' ?> Foto Produk</h3>
            <!-- <div class="row"> -->
            <!-- <div class="box box-info">
    <div class="box-body"> -->
            <?php $form = ActiveForm::begin(
                [
                    'id' => 'FotoProduk',
                    'layout' => 'horizontal',
                    'enableClientValidation' => true,
                    'errorSummaryCssClass' => 'error-summary alert alert-error'
                ]
            );
            ?>

            <?= $form->field($model, 'foto', Constant::COLUMN(1))->fileInput([
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'gif', 'bmp'],
                    'maxFileSize' => 250,
                ],
            ]) ?>
            <hr />
            <?php echo $form->errorSummary($model); ?>
            <div class="row">
                <div class="col-md-offset-3 col-md-10">
                    <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn-success']); ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

            <!-- </div>
</div> -->
        </div>
    </div>
</div>
<!-- </div> -->
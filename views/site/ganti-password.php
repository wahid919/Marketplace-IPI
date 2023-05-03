<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<hr class="mt-0">
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 profile-section mx-auto">
            <h3 class="text-isalam-1 font-weight-bold text-detail-program">Masukkan Password Baru Anda</h3>
            <?php $form = ActiveForm::begin([
                'id' => 'Ganti-form',
            ]); ?>

            <?php echo $form->errorSummary($model); ?>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <label for="Email">Password baru</label>
                    <input class="form-control mb-4" name="Ganti[password]" id="ContactForm_email" type="password">
                    <input name="Ganti[tokenhid]" id="ContactForm_email" type="hidden" value="<?php echo $model->secret_link ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?= Html::submitButton('Ganti Password', ['class' => 'btn btn-sm btn-program btn-block', 'style' => 'padding:10px!important;width:100%']); ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
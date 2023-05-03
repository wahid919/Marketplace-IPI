<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\search\ProdukSearch $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="produk-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'nama') ?>

		<?= $form->field($model, 'harga') ?>

		<?= $form->field($model, 'stok') ?>

		<?= $form->field($model, 'kategori_produk_id') ?>

		<?php // echo $form->field($model, 'toko_id') ?>

		<?php // echo $form->field($model, 'deskripsi_singkat') ?>

		<?php // echo $form->field($model, 'deksripsi_lengkap') ?>

		<?php // echo $form->field($model, 'status_online') ?>

		<?php // echo $form->field($model, 'foto_banner') ?>

		<?php // echo $form->field($model, 'flag') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'diskon_status') ?>

		<?php // echo $form->field($model, 'diskon') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

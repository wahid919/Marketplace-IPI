<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\search\ReviewProdukSearch $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="review-produk-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'produk_id') ?>

		<?= $form->field($model, 'nama') ?>

		<?= $form->field($model, 'email') ?>

		<?= $form->field($model, 'review') ?>

		<?php // echo $form->field($model, 'rating') ?>

		<?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

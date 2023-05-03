<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\search\HubungiKamiSearch $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="hubungi-kami-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'nama') ?>

		<?= $form->field($model, 'nomor_hp') ?>

		<?= $form->field($model, 'email') ?>

		<?= $form->field($model, 'perusahaan') ?>

		<?php // echo $form->field($model, 'pesan') ?>

		<?php // echo $form->field($model, 'flag') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

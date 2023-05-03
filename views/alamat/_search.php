<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\search\AlamatSearch $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="alamat-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'usrid') ?>

		<?= $form->field($model, 'status') ?>

		<?= $form->field($model, 'idkec') ?>

		<?= $form->field($model, 'kodepos') ?>

		<?php // echo $form->field($model, 'judul') ?>

		<?php // echo $form->field($model, 'alamat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

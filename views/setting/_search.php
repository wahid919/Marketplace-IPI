<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\search\SettingSearch $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="setting-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'logo') ?>

		<?= $form->field($model, 'judul_web') ?>

		<?= $form->field($model, 'tentang_kami') ?>

		<?= $form->field($model, 'judul_tentang_kami') ?>

		<?php // echo $form->field($model, 'foto_tentang_kami') ?>

		<?php // echo $form->field($model, 'foto_member') ?>

		<?php // echo $form->field($model, 'facebook') ?>

		<?php // echo $form->field($model, 'instagram') ?>

		<?php // echo $form->field($model, 'telepon') ?>

		<?php // echo $form->field($model, 'email') ?>

		<?php // echo $form->field($model, 'twitter') ?>

		<?php // echo $form->field($model, 'telegram') ?>

		<?php // echo $form->field($model, 'nama_web') ?>

		<?php // echo $form->field($model, 'alamat') ?>

		<?php // echo $form->field($model, 'visi') ?>

		<?php // echo $form->field($model, 'misi') ?>

		<?php // echo $form->field($model, 'slogan_web') ?>

		<?php // echo $form->field($model, 'banner') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

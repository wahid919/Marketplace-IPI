<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Alamat $model
 */

$this->title = 'Tambah Baru';
$this->params['breadcrumbs'][] = ['label' => 'Alamat', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?= $this->render('_form', [
    'model' => $model,
]); ?>

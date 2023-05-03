<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Keranjang $model
 */

$this->title = 'Tambah Baru';
$this->params['breadcrumbs'][] = ['label' => 'Keranjang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= Html::a('Kembali', \yii\helpers\Url::previous(), ['class' => 'btn btn-default']) ?>
</p>

<?= $this->render('_form', [
    'model' => $model,
    'modeldetail' => $modeldetail,
]); ?>
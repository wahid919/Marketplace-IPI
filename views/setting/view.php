<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var app\models\Setting $model
 */

$this->title = 'Setting ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Setting', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="giiant-crud setting-view">

    <!-- menu buttons -->
    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . 'Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <!-- <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'Tambah Baru', ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>
    <p class="pull-right">
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> ' . 'Daftar Setting', ['index'], ['class' => 'btn btn-default']) ?>
    </p>

    <div class="clearfix"></div>

    <!-- flash message -->
    <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
    <span class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <?= \Yii::$app->session->getFlash('deleteError') ?>
    </span>
    <?php endif; ?>

    <div class="box box-info">
        <div class="box-body">
            <?php $this->beginBlock('app\models\Setting'); ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'logo',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::img(\Yii::$app->request->BaseUrl . '/uploads/setting/' . $model->logo, ['width' => 100]);
                        },
                    ],
                    'judul_web',
                    [
                        'attribute' => 'tentang_kami',
                        'format' => 'html',
                    ],
                    'judul_tentang_kami',
                    'foto_tentang_kami',
                    'foto_member',
                    [
                        'attribute' => 'instagram',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a('Instagram', $model->instagram, ['target' => '_blank']);
                        },
                    ],
                    [
                        'attribute' => 'facebook',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a('Facebook', $model->facebook, ['target' => '_blank']);
                        },
                    ],
                    [
                        'attribute' => 'twitter',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a('Twitter', $model->twitter, ['target' => '_blank']);
                        },
                    ],
                    [
                        'attribute' => 'telegram',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a('Telegram', $model->telegram, ['target' => '_blank']);
                        },
                    ],
                    'telepon',
                    'email:email',
                    'nama_web',
                    'alamat:ntext',
                    [
                        'attribute' => 'visi',
                        'format' => 'html',
                    ],
                    [
                        'attribute' => 'misi',
                        'format' => 'html',
                    ],
                    'slogan_web:ntext',
                    [
                        'attribute' => 'banner',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::img(\Yii::$app->request->BaseUrl . '/uploads/setting/' . $model->banner, ['width' => 100]);
                        },
                    ],
                    [
                        'attribute' => 'embed_ig',
                        'format' => 'raw'
                    ],
                ],
            ]); ?>

            <hr />

            <!-- <?= Html::a(
                        '<span class="glyphicon glyphicon-trash"></span> ' . 'Delete',
                        ['delete', 'id' => $model->id],
                        [
                            'class' => 'btn btn-danger',
                            'data-confirm' => '' . 'Are you sure to delete this item?' . '',
                            'data-method' => 'post',
                        ]
                    ); ?> -->
            <?php $this->endBlock(); ?>



            <?= Tabs::widget(
                [
                    'id' => 'relation-tabs',
                    'encodeLabels' => false,
                    'items' => [[
                        'label'   => '<b class=""># ' . $model->id . '</b>',
                        'content' => $this->blocks['app\models\Setting'],
                        'active'  => true,
                    ],]
                ]
            );
            ?>
        </div>
    </div>
</div>
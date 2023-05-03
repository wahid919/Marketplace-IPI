<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var app\models\KategoriProduk $model
 */

$this->title = 'Kategori Produk ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kategori Produk', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="giiant-crud kategori-produk-view">

    <!-- menu buttons -->
    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . 'Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'Tambah Baru', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p class="pull-right">
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> ' . 'Daftar Kategori Produk', ['index'], ['class' => 'btn btn-default']) ?>
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
            <?php $this->beginBlock('app\models\KategoriProduk'); ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'nama',
                    'icon',
                    'icon2',
                ],
            ]); ?>

            <hr />

            <?= Html::a(
                '<span class="glyphicon glyphicon-trash"></span> ' . 'Delete',
                ['delete', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'data-confirm' => '' . 'Are you sure to delete this item?' . '',
                    'data-method' => 'post',
                ]
            ); ?>
            <?php $this->endBlock(); ?>



            <?php $this->beginBlock('Produks'); ?>
            <div style='position: relative'>
                <div style='position:absolute; right: 0px; top 0px;'>
                    <?= Html::a(
                        '<span class="glyphicon glyphicon-list"></span> ' . 'List All' . ' Produks',
                        ['produk/index'],
                        ['class' => 'btn text-muted btn-xs']
                    ) ?>
                    <?= Html::a(
                        '<span class="glyphicon glyphicon-plus"></span> ' . 'Tambah Baru' . ' Produk',
                        ['produk/create', 'Produk' => ['kategori_produk_id' => $model->id]],
                        ['class' => 'btn btn-success btn-xs']
                    ); ?>
                </div>
            </div><?php Pjax::begin(['id' => 'pjax-Produks', 'enableReplaceState' => false, 'linkSelector' => '#pjax-Produks ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
            <?= '<div class="table-responsive">'
                . \yii\grid\GridView::widget([
                    'layout' => '{summary}{pager}<br/>{items}{pager}',
                    'dataProvider' => new \yii\data\ActiveDataProvider([
                        'query' => $model->getProduks(),
                        'pagination' => [
                            'pageSize' => 20,
                            'pageParam' => 'page-produks',
                        ]
                    ]),
                    'pager'        => [
                        'class'          => yii\widgets\LinkPager::className(),
                        'firstPageLabel' => 'First',
                        'lastPageLabel'  => 'Last'
                    ],
                    'columns' => [
                        [
                            'class'      => 'yii\grid\ActionColumn',
                            'template'   => '{view} {update}',
                            'contentOptions' => ['nowrap' => 'nowrap'],
                            'urlCreator' => function ($action, $model, $key, $index) {
                                // using the column name as key, not mapping to 'id' like the standard generator
                                $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                                $params[0] = 'produk' . '/' . $action;
                                $params['Produk'] = ['kategori_produk_id' => $model->primaryKey()[0]];
                                return $params;
                            },
                            'buttons'    => [],
                            'controller' => 'produk'
                        ],
                        'id',
                        'nama',
                        'harga',
                        'stok',
                        // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::columnFormat
                        [
                            'class' => yii\grid\DataColumn::className(),
                            'attribute' => 'toko_id',
                            'value' => function ($model) {
                                if ($rel = $model->toko) {
                                    return Html::a($rel->id, ['toko/view', 'id' => $rel->id,], ['data-pjax' => 0]);
                                } else {
                                    return '';
                                }
                            },
                            'format' => 'raw',
                        ],
                        'deskripsi_singkat:ntext',
                        'deksripsi_lengkap:ntext',
                        'status_online',
                        'foto_banner',
                    ]
                ])
                . '</div>' ?>
            <?php Pjax::end() ?>
            <?php $this->endBlock() ?>


            <?= Tabs::widget(
                [
                    'id' => 'relation-tabs',
                    'encodeLabels' => false,
                    'items' => [[
                        'label'   => '<b class=""># ' . $model->id . '</b>',
                        'content' => $this->blocks['app\models\KategoriProduk'],
                        'active'  => true,
                    ], [
                        'content' => $this->blocks['Produks'],
                        'label'   => '<small>Produks <span class="badge badge-default">' . count($model->getProduks()->asArray()->all()) . '</span></small>',
                        'active'  => false,
                    ],]
                ]
            );
            ?>
        </div>
    </div>
</div>
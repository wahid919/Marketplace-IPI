<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\Alamat;
use yii\grid\GridView;
use dmstr\bootstrap\Tabs;
use yii\widgets\DetailView;
use app\models\ProductDetail;

/**
 * @var yii\web\View $this
 * @var app\models\Produk $model
 */
?>
<hr class="mt-0">
<div class="container pb-20">
    <div class="row pl-20 pr-20">
        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <?= $this->render('../component/sidemenu-toko') ?>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section">
            <div class="row">
                <div class="table-responsive">
                    <div class="giiant-crud produk-view">
                        <h3 class="text-isalam-1 font-weight-bold text-detail-program pull-left pl-20">Detail Produk :
                            <?= $model->nama ?></h3>

                        <p class="pull-right">
                            <?= Html::a('<span class="glyphicon glyphicon-list"></span> ' . 'List Produk', ['produk-saya'], ['class' => 'btn btn-default']) ?>
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

                        <!-- <div class="box box-info">
    <div class="box-body"> -->
                        <?php $this->beginBlock('app\models\Produk');
                        ?>

                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                // 'id',
                                'nama',
                                [
                                    'attribute' => 'harga',
                                    'label' => 'Harga',
                                    'format' => 'raw',
                                    'filter' => false,
                                    'value' => function ($model) {
                                        $averageprice = ProductDetail::find()->where(['id_product' => $model->id])->average('harga');
                                        return \app\components\Angka::toReadableHarga($averageprice);
                                    },
                                ],
                                [
                                    'attribute' => 'stok',
                                    'label' => 'Stok',
                                    'format' => 'raw',
                                    'filter' => false,
                                    'value' => function ($model) {
                                        $totalstok = ProductDetail::find()->where(['id_product' => $model->id])->sum('stok');
                                        return ($totalstok);
                                    },
                                ],
                                // 'stok',
                                [
                                    'attribute' => 'kategori_produk_id',
                                    'value' => function ($model) {
                                        return $model->kategoriProduk->nama;
                                    }
                                ],
                                // 'deskripsi_singkat:ntext',
                                // 'deksripsi_lengkap:ntext',
                                [
                                    'attribute' => 'deskripsi_singkat',
                                    'format' => 'html',
                                ],
                                [
                                    'attribute' => 'deksripsi_lengkap',
                                    'format' => 'html',
                                ],
                                // 'status_online',
                                [
                                    'attribute' => 'foto_banner',
                                    'format' => 'html',
                                    'value' => function ($model) {
                                        return Html::img(\Yii::$app->request->BaseUrl . '/uploads/banner_produk/' . $model->foto_banner, ['width' => 100]);
                                    },
                                ],
                                // 'flag',
                                [
                                    'attribute' => 'created_at',
                                    'label' => 'Tanggal Dibuat',
                                    'format' => 'raw',
                                    'filter' => false,
                                    'value' => function ($model) {

                                        return \app\components\Tanggal::toReadableDate($model->created_at);
                                    },
                                ],
                                // 'diskon_status',
                                // 'diskon',
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



                        <?php $this->beginBlock('FotoProduks'); ?>
                        <div style='position: relative'>
                            <div style='position:relative;margin-top:1%; right: 0px; top 0px;'>
                                <?= Html::a(
                                    '<span class="glyphicon glyphicon-plus"></span> ' . ' Foto Produk',
                                    ['foto-produk-baru', 'FotoProduk' => ['produk_id' => $model->id]],
                                    ['class' => 'btn btn-success btn-xs']
                                ); ?>
                            </div>
                        </div>
                        <?php Pjax::begin(['id' => 'pjax-FotoProduks', 'enableReplaceState' => false, 'linkSelector' => '#pjax-FotoProduks ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
                        <?= '<div class="table-responsive">'
                            . \yii\grid\GridView::widget([
                                'layout' => '{summary}{pager}<br/>{items}{pager}',
                                'dataProvider' => new \yii\data\ActiveDataProvider([
                                    'query' => $model->getFotoProduks(),
                                    'pagination' => [
                                        'pageSize' => 20,
                                        'pageParam' => 'page-fotoproduks',
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
                                        'template'   => '{update} {delete}',
                                        'contentOptions' => ['nowrap' => 'nowrap'],
                                        'urlCreator' => function ($action, $model, $key, $index) {
                                            // using the column name as key, not mapping to 'id' like the standard generator
                                            $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                                            $params[0] = 'home/foto-produk' . '-' . $action;
                                            $params['FotoProduk'] = ['produk_id' => $model->produk_id];
                                            return $params;
                                        },
                                        'buttons'    => [],
                                        'controller' => 'foto-produk'
                                    ],
                                    [
                                        'attribute' => 'foto',
                                        'format' => 'html',
                                        'value' => function ($model) {
                                            return Html::img(\Yii::$app->request->BaseUrl . '/uploads/foto_produk/' . $model->foto, ['width' => 100]);
                                        },
                                    ],
                                ]
                            ])
                            . '</div>' ?>
                        <?php Pjax::end() ?>
                        <?php $this->endBlock() ?>




                        <?php $this->beginBlock('ReviewProduks'); ?>
                        <div style='position: relative'>
                            <div style='position:absolute; right: 0px; top 0px;'>
                                <!-- <?= Html::a(
                                            '<span class="glyphicon glyphicon-list"></span> ' . 'List All' . ' Review Produks',
                                            ['review-produk/index'],
                                            ['class' => 'btn text-muted btn-xs']
                                        ) ?>
                                <?= Html::a(
                                    '<span class="glyphicon glyphicon-plus"></span> ' . 'Tambah Baru' . ' Review Produk',
                                    ['review-produk/create', 'ReviewProduk' => ['produk_id' => $model->id]],
                                    ['class' => 'btn btn-success btn-xs']
                                ); ?> -->
                            </div>
                        </div>
                        <?php Pjax::begin(['id' => 'pjax-ReviewProduks', 'enableReplaceState' => false, 'linkSelector' => '#pjax-ReviewProduks ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
                        <?= '<div class="table-responsive">'
                            . \yii\grid\GridView::widget([
                                'layout' => '{summary}{pager}<br/>{items}{pager}',
                                'dataProvider' => new \yii\data\ActiveDataProvider([
                                    'query' => $model->getReviewProduks(),
                                    'pagination' => [
                                        'pageSize' => 20,
                                        'pageParam' => 'page-reviewproduks',
                                    ]
                                ]),
                                'pager'        => [
                                    'class'          => yii\widgets\LinkPager::className(),
                                    'firstPageLabel' => 'First',
                                    'lastPageLabel'  => 'Last'
                                ],
                                'columns' => [
                                    'nama',
                                    'email:email',
                                    'review:ntext',
                                    'rating',
                                    [
                                        'attribute' => 'created_at',
                                        'label' => 'Tanggal Dibuat',
                                        'format' => 'raw',
                                        'filter' => false,
                                        'value' => function ($model) {

                                            return \app\components\Tanggal::toReadableDate($model->created_at);
                                        },
                                    ],
                                ]
                            ])
                            . '</div>' ?>
                        <?php Pjax::end() ?>
                        <?php $this->endBlock() ?>


                        <?= Tabs::widget(
                            [
                                'id' => 'relation-tabs',
                                'encodeLabels' => false,
                                'items' => [
                                    [
                                        'label'   => '<b class="">#</b>',
                                        'content' => $this->blocks['app\models\Produk'],
                                        'active'  => true,
                                    ], [
                                        'content' => $this->blocks['FotoProduks'],
                                        'label'   => '<small>Foto Produks <span class="badge badge-default">' . count($model->getFotoProduks()->asArray()->all()) . '</span></small>',
                                        'active'  => false,
                                    ],

                                    [
                                        'content' => $this->blocks['ReviewProduks'],
                                        'label'   => '<small>Review Produks <span class="badge badge-default">' . count($model->getReviewProduks()->asArray()->all()) . '</span></small>',
                                        'active'  => false,
                                    ],
                                ]
                            ]
                        );
                        ?>
                    </div>
                    <!-- </div>
</div> -->
                </div>
            </div>
        </div>
    </div>
</div>
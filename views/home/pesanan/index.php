<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Produk;
use yii\grid\GridView;
use app\models\Pesanan;
use yii\data\Pagination;
use app\models\Keranjang;



/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\PesananSearch $searchModel
 * * @var yii\web\View $this
 * @var app\models\Pesanan $model
 */

$this->title = 'Pesanan';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .pesanan-item {
        box-shadow: 0px 0px 18px #d0d1d4;
        border-radius: 12px;
        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        background-color: #ffffff;

    }

    .p-r-30,
    .p-lr-30,
    .p-all-30 {
        padding-right: 30px;
        padding-top: 30px;
        padding-bottom: 30px;
        padding-left: 30px;
    }

    .pesanan {
        margin-top: 30px;
    }

    .m-b-30 {
        padding-bottom: 30px;
    }

    .nav-tabs .nav-link {
        /* background-image: linear-gradient(91.9deg, #0D8BF2 0%, #409ED0 90%); */
        background-image: linear-gradient(91.9deg, #aa770a 0%, #e6af3a 90%);
        border: 0px solid transparent;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        border: 0px solid transparent;
        border-radius: 0.25rem;
        /* background-image: linear-gradient(90.9deg, #7fad39 0.5%, #4CAF50 99.7%); */
        background-image: linear-gradient(90.9deg, #039019 2.5%, #7fad39 100.7%);
        color: #fff;
        border-color: #1e7e34;
        box-shadow: none;
    }

    .btn:hover {
        color: #fff;
    }

    .btn {
        display: inline-block;
        font-weight: 400;
        color: white;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        /* background-color: transparent; */
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        margin-right: 1%;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .img-item {
        min-width: 20%;
        padding: 5%;
        display: block;
        margin: auto;
        min-height: 90px;
        max-width: 90px;
        background-size: cover;
        background-position: center center;
        -webkit-border-radius: 45px;
    }

    .p-b-30,
    .p-tb-30,
    .p-all-30 {
        padding-bottom: 30px;
    }

    .text-danger {
        margin-top: -45px;

    }

    .product__discount__title {
        text-align: left;
        margin-bottom: 15px;
        margin-top: 36px;
    }

    .section-title h2:after {
        position: fixed;
    }

    .section {
        padding-top: 2%;
        padding-bottom: 2%;
        margin-top: 30px;
        box-shadow: 0px 0px 14px #d0d1d4;
        border-radius: 12px;
        -webkit-border-radius: 12px;
        -moz-border-radius: 12px;
        background-color: #ffffff;
    }

    .fs-120 {
        font-size: 120px;
        -webkit-font-smoothing: antialiased;
        /* display: inline-block; */
        font-style: normal;
        font-variant: normal;
        line-height: 1;
    }
</style>


<hr>
<div class="m-t-30 p-b-140">
    <div class="container">
        <!-- <div class="product__discount"> -->
        <div class="section-title product__discount__title">
            <h2>Pesanan Saya</h2>
        </div>
        <!-- </div> -->
        <div class="tab">
            <div class="nav nav-tabs" role="tablist" style="border-bottom: none;">
                <button class="nav-link active btn info" data-toggle="tab" href="#belumbayar" role="tab" aria-selected="true"><i class="fa fa-money-check-alt"></i>Belum Bayar</button>
                <button class="nav-link btn" data-toggle="tab" href="#dikemas" role="tab" aria-selected="false"><i class="fa fa-box"></i> Dikemas</button>
                <button class="nav-link btn" data-toggle="tab" href="#dikirim" role="tab" aria-selected="false"><i class="fa fa-shipping-fast"></i> Dikirim</button>
                <button class="nav-link btn" data-toggle="tab" href="#selesai" role="tab" aria-selected="false"><i class="fa fa-clipboard-check"></i> Selesai</button>
                <button class="nav-link btn" data-toggle="tab" href="#dibatalkan" role="tab" aria-selected="false"><i class="fa fa-times"></i> Dibatalkan</button>
            </div>
            <div class="tab-content">
                <!-- BELUM BAYAR -->
                <div class="tab-pane active" id="belumbayar" role="tabpanel">
                    <?php
                    $query = Pesanan::find()->where(['usrid' => Yii::$app->user->identity->id, 'status_id' => 3]);
                    $count = $query->count();
                    $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
                    $belumbayar = $query->offset($pagination->offset)
                        ->where(['usrid' => Yii::$app->user->identity->id, 'status_id' => 3])
                        ->limit($pagination->limit)
                        ->orderBy(['id' => SORT_DESC])
                        ->all();
                    if ($belumbayar == !null) {
                    ?>
                        <div class="pesanan">
                            <?php
                            foreach ($belumbayar as $res) {
                            ?>

                                <div class="m-b-30">
                                    <div class="pesanan-item p-lr-30 p-tb-30 m-lr-0-xl">
                                        <div class="row p-b-30">
                                            <div class="col-8">
                                                <span class="text-dark font-medium fs-18">
                                                    Payment ID&nbsp; <span class="text-success">#<?php echo $res->invoice; ?></span>
                                                </span>
                                            </div>
                                            <div class="col-4 text-right">
                                                <!-- <a href="#" onclick="batalkan(<?php echo $res->id; ?>)" class="btn btn-danger btn-sm">
                                                    
                                                </a> -->
                                                <button id="cansel-<?= $res->id ?>" class="btn btn-sm btn-program btn-danger" style="margin-top:2px;"><i class="fa fa-times-circle"></i> batal<span class='hidesmall'>kan pesanan</span></button>
                                            </div>
                                        </div>
                                        <div class="row m-lr-0">
                                            <div class="col-md-8 p-lr-0 m-b-10">
                                                <?php
                                                // $this->db->where("idbayar", $res->id);
                                                // $trx = $this->db->get("transaksi");
                                                $trx = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => $res->id])->all();
                                                $totalharga = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => $res->id])->sum('harga*jumlah');
                                                $no = 1;
                                                foreach ($trx as $rx) {
                                                    $trp = Produk::find()->where(['id' => $rx->produk_id])->all();
                                                    foreach ($trp as $key) {
                                                        if ($no == 2) {
                                                ?>

                                                            <div class="m-b-30 show-product">
                                                            <?php

                                                        }
                                                            ?>
                                                            <div class="row p-b-30 m-lr-0 produk-item">
                                                                <div class="col-4 col-md-2">
                                                                    <img class="img-item" src="<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $key->foto_banner ?>" alt="">
                                                                </div>
                                                                <div class="col-8 col-md-10">
                                                                    <p class="font-medium text-dark btn-block"><?php if ($trp != null) { ?>
                                                                            <?= $key->nama ?>
                                                                        <?php } else { ?>
                                                                            Produk Dihapus
                                                                        <?php } ?></p>
                                                                    <small class="text-primary">Warna: <?= $rx->variant1 ?> Ukuran: <?= $rx->variant2 ?></small>
                                                                    <p><?= \app\components\Angka::toReadableHarga($rx->harga);  ?> <span style="font-size:11px">x<?= $rx->jumlah; ?></span></p>
                                                                </div>
                                                            </div>
                                                        <?php

                                                        $no++;
                                                    }
                                                }
                                                if ($no > 2) {
                                                        ?>
                                                            </div>
                                                            <div class="p-b-30 p-r-10">
                                                                <a href="javascript:void(0)" class="view-product text-info"><i class="fa fa-chevron-circle-down"></i> Lihat produk lainnya</a>
                                                                <a href="javascript:void(0)" class="view-product text-info" style="display:none;"><i class='fa fa-chevron-circle-up'></i> Sembunyikan produk</a>
                                                            </div>
                                                        <?php
                                                    }
                                                        ?>
                                            </div>
                                            <div class="row m-lr-0 p-lr-12 col-md-4">
                                                <div class="text-black fs-18 p-lr-0 col-6 col-md-12">Total<span class="hidesmall"> Pembayaran</span></div>
                                                <div class="text-danger fs-20 p-lr-0 col-6 col-md-12 font-bold"><?= \app\components\Angka::toReadableHarga($totalharga) ?></div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>Segera lakukan pembayaran dalam <b class="text-danger">1 x 24 jam</b>, atau pesanan Anda akan Otomatis Dibatalkan.</p>
                                                <div class="m-t-16 showsmall"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="view-pesanan/<?= $res->id ?>" onclick="<?= $klik ?>" class="btn btn-success btn-block m-b-10">
                                                            Bayar Pesanan
                                                        </a>
                                                        <!-- <button id="pay-button-<?= $res->id ?>" class="btn btn-success btn-block m-b-10 btn-program <?= $status ?>"> Bayar Pesanan</button> -->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="javascript:void(0)" onclick="konfirmasi(<?php echo $res->id; ?>)" class="btn btn-warning btn-block m-b-10">
                                                            Konfirmasi
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="bayarva_<?= $res->id ?>" class="bayarva" style="display:none;">
                                    <div class="nomerva m-lr-30 m-t-20 p-lr-20 p-tb-14 bg2 bold">

                                    </div>
                                    <div class="bank m-lr-30 m-t-10">

                                    </div>
                                    <div class="bank m-lr-30 m-t-10">

                                    </div>
                                </div>
                                <script>
                                    document.querySelector("#cansel-<?= $res->id ?>").addEventListener("click", () => {
                                        swal.fire({
                                                title: "Anda yakin?",
                                                text: "pesanan akan dibatalkan.",
                                                icon: "warning",
                                                showDenyButton: true,
                                                confirmButtonText: "Oke",
                                                denyButtonText: "Batal"
                                            })
                                            .then((willDelete) => {
                                                if (willDelete.isConfirmed) {
                                                    window.location.href = `<?= Url::to(['/home/cancel-transaksi', 'id' => $res->id]) ?>`;

                                                }
                                            });
                                    });
                                </script>
                            <?php
                            }
                            ?>
                            <div class='d-flex justify-content-center pt-4'>
                                <?php echo \yii\widgets\LinkPager::widget([
                                    'pagination' => $pagination,
                                ]); ?>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-center p-tb-40 section m-t-30">
                            <i class="fas fa-box-open fs-120 text-danger m-b-20" style="display: contents"></i>
                            <h5 class="text-dark font-bold">TIDAK ADA PESANAN</h5>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <!-- DIKEMAS -->
                <div class="tab-pane" id="dikemas" role="tabpanel">
                    <?php
                    $query = Pesanan::find()->where(['usrid' => Yii::$app->user->identity->id, 'status_id' => 2]);
                    $count = $query->count();
                    $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
                    $belumbayar = $query->offset($pagination->offset)
                        ->where(['usrid' => Yii::$app->user->identity->id, 'status_id' => 2])
                        ->limit($pagination->limit)
                        ->orderBy(['id' => SORT_DESC])
                        ->all();
                    if ($belumbayar == !null) {
                    ?>
                        <div class="pesanan">
                            <?php
                            foreach ($belumbayar as $res) {
                            ?>

                                <div class="m-b-30">
                                    <div class="pesanan-item p-lr-30 p-tb-30 m-lr-0-xl">
                                        <div class="row p-b-30">
                                            <div class="col-8">
                                                <span class="text-dark font-medium fs-18">
                                                    Payment ID&nbsp; <span class="text-success">#<?php echo $res->resi; ?></span>
                                                </span>
                                            </div>
                                            <div class="col-4 text-right">
                                                <a href="javascript:void(0)" onclick="batal(<?php echo $res->id; ?>)" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-angle-double-right"></i> Rincian<span class='hidesmall'>Pesanan</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row m-lr-0">
                                            <div class="col-md-8 p-lr-0 m-b-10">
                                                <?php
                                                $trx = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => $res->id])->all();
                                                $totalharga = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => $res->id])->sum('harga*jumlah');
                                                $no = 1;
                                                foreach ($trx as $rx) {
                                                    $trp = Produk::find()->where(['id' => $rx->produk_id])->all();
                                                    foreach ($trp as $key) {
                                                        if ($no == 2) {
                                                ?>
                                                            <div class="m-b-30 show-product">
                                                            <?php

                                                        }
                                                            ?>
                                                            <div class="row p-b-30 m-lr-0 produk-item">
                                                                <div class="col-4 col-md-2">
                                                                    <img class="img-item" src="<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $key->foto_banner ?>" alt="">
                                                                    <!-- <div class="u" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $key->foto_banner ?>);" alt="IMG"></div> -->
                                                                </div>
                                                                <div class="col-8 col-md-10">
                                                                    <p class="font-medium text-dark btn-block"><?php if ($trp != null) { ?>
                                                                            <?= $key->nama ?>
                                                                        <?php } else { ?>
                                                                            Produk Dihapus
                                                                        <?php } ?></p>
                                                                    <small class="text-primary">Warna: <?= $rx->variant1 ?> Ukuran: <?= $rx->variant2 ?></small>
                                                                    <p><?= \app\components\Angka::toReadableHarga($rx->harga);  ?> <span style="font-size:11px">x<?= $rx->jumlah; ?></span></p>
                                                                </div>
                                                            </div>
                                                        <?php

                                                        $no++;
                                                    }
                                                }
                                                if ($no > 2) {
                                                        ?>
                                                            </div>
                                                            <div class="p-b-30 p-r-10">
                                                                <a href="javascript:void(0)" class="view-product text-info"><i class="fa fa-chevron-circle-down"></i> Lihat produk lainnya</a>
                                                                <a href="javascript:void(0)" class="view-product text-info" style="display:none;"><i class='fa fa-chevron-circle-up'></i> Sembunyikan produk</a>
                                                            </div>
                                                        <?php
                                                    }
                                                        ?>
                                            </div>
                                            <div class="col-md-4">
                                                Waktu Pemesanan:<br /><i class="text-info p-r-8 font-medium"><?= \app\components\Tanggal::toReadableDate($res->selesai); ?> WIB</i>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <i class="text-warning">Menunggu konfirmasi admin</i>
                                                <div class="m-t-16 showsmall"></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="m-t-14 showsmall"></div>
                                                <h5 class="text-dark">Total Order &nbsp;<span class="text-success font-bold text-right"><?= \app\components\Angka::toReadableHarga($totalharga) ?></span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="bayarva_<?= $res->id ?>" class="bayarva" style="display:none;">
                                    <div class="nomerva m-lr-30 m-t-20 p-lr-20 p-tb-14 bg2 bold">

                                    </div>
                                    <div class="bank m-lr-30 m-t-10">

                                    </div>
                                    <div class="bank m-lr-30 m-t-10">

                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class='d-flex justify-content-center pt-4'>
                                <?php echo \yii\widgets\LinkPager::widget([
                                    'pagination' => $pagination,
                                ]); ?>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-center p-tb-40 section m-t-30">
                            <i class="fas fa-box-open fs-120 text-danger m-b-20" style="display: contents"></i>
                            <h5 class="text-dark font-bold">TIDAK ADA PESANAN</h5>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <!-- DIKIRIM -->
                <div class="tab-pane" id="dikirim" role="tabpanel">
                    <?php
                    $query = Pesanan::find()->where(['usrid' => Yii::$app->user->identity->id, 'status_id' => 10]);
                    $count = $query->count();
                    $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
                    $belumbayar = $query->offset($pagination->offset)
                        ->where(['usrid' => Yii::$app->user->identity->id, 'status_id' => 10])
                        ->limit($pagination->limit)
                        ->orderBy(['id' => SORT_DESC])
                        ->all();
                    if ($belumbayar == !null) {
                    ?>
                        <div class="pesanan">
                            <?php
                            foreach ($belumbayar as $res) {
                            ?>

                                <div class="m-b-30">
                                    <div class="pesanan-item p-lr-30 p-tb-30 m-lr-0-xl">
                                        <div class="row p-b-30">
                                            <div class="col-8">
                                                <span class="text-dark font-medium fs-18">
                                                    Payment ID&nbsp; <span class="text-success">#<?php echo $res->resi; ?></span>
                                                </span>
                                            </div>
                                            <div class="col-4 text-right">
                                                <a href="javascript:void(0)" onclick="batal(<?php echo $res->id; ?>)" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-angle-double-right"></i> Rincian<span class='hidesmall'>Pesanan</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row m-lr-0">
                                            <div class="col-md-8 p-lr-0 m-b-10">
                                                <?php
                                                $trx = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => $res->id])->all();
                                                $totalharga = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => $res->id])->sum('harga*jumlah');
                                                $no = 1;
                                                foreach ($trx as $rx) {
                                                    $trp = Produk::find()->where(['id' => $rx->produk_id])->all();
                                                    foreach ($trp as $key) {
                                                        if ($no == 2) {
                                                ?>
                                                            <div class="m-b-30 show-product">
                                                            <?php

                                                        }
                                                            ?>
                                                            <div class="row p-b-30 m-lr-0 produk-item">
                                                                <div class="col-4 col-md-2">
                                                                    <img class="img-item" src="<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $key->foto_banner ?>" alt="">
                                                                    <!-- <div class="u" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $key->foto_banner ?>);" alt="IMG"></div> -->
                                                                </div>
                                                                <div class="col-8 col-md-10">
                                                                    <p class="font-medium text-dark btn-block"><?php if ($trp != null) { ?>
                                                                            <?= $key->nama ?>
                                                                        <?php } else { ?>
                                                                            Produk Dihapus
                                                                        <?php } ?></p>
                                                                    <small class="text-primary">Warna: <?= $rx->variant1 ?> Ukuran: <?= $rx->variant2 ?></small>
                                                                    <p><?= \app\components\Angka::toReadableHarga($rx->harga);  ?> <span style="font-size:11px">x<?= $rx->jumlah; ?></span></p>
                                                                </div>
                                                            </div>
                                                        <?php

                                                        $no++;
                                                    }
                                                }
                                                if ($no > 2) {
                                                        ?>
                                                            </div>
                                                            <div class="p-b-30 p-r-10">
                                                                <a href="javascript:void(0)" class="view-product text-info"><i class="fa fa-chevron-circle-down"></i> Lihat produk lainnya</a>
                                                                <a href="javascript:void(0)" class="view-product text-info" style="display:none;"><i class='fa fa-chevron-circle-up'></i> Sembunyikan produk</a>
                                                            </div>
                                                        <?php
                                                    }
                                                        ?>
                                            </div>
                                            <div class="col-md-4">
                                                Waktu Pengiriman:<br /><i class="text-info p-r-8 font-medium"><?= \app\components\Tanggal::toReadableDate($res->selesai); ?> WIB</i>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <!-- <div class="col-md-6">
                                                        <a href="" class="btn btn-primary btn-block m-b-10">
                                                            LACAK KIRIMAN
                                                        </a>
                                                    </div> -->
                                                    <div class="col-md-6">
                                                        <a href="javascript:void(0)" onclick="terimaPesanan(55)" class="btn btn-success btn-block m-b-10">
                                                            TERIMA PESANAN
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 m-b-14"></div>
                                            <div class="col-md-4 text-right">
                                                <h5 class="text-dark">Total Order &nbsp;<span class="text-success font-bold text-right"><?= \app\components\Angka::toReadableHarga($totalharga) ?></span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="bayarva_<?= $res->id ?>" class="bayarva" style="display:none;">
                                    <div class="nomerva m-lr-30 m-t-20 p-lr-20 p-tb-14 bg2 bold">

                                    </div>
                                    <div class="bank m-lr-30 m-t-10">

                                    </div>
                                    <div class="bank m-lr-30 m-t-10">

                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class='d-flex justify-content-center pt-4'>
                                <?php echo \yii\widgets\LinkPager::widget([
                                    'pagination' => $pagination,
                                ]); ?>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-center p-tb-40 section m-t-30">
                            <i class="fas fa-box-open fs-120 text-danger m-b-20" style="display: contents"></i>
                            <h5 class="text-dark font-bold">TIDAK ADA PESANAN</h5>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <!-- SELESAI -->
                <div class="tab-pane" id="selesai" role="tabpanel">
                    <?php
                    $query = Pesanan::find()->where(['usrid' => Yii::$app->user->identity->id, 'status_id' => 11]);
                    $count = $query->count();
                    $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
                    $belumbayar = $query->offset($pagination->offset)
                        ->where(['usrid' => Yii::$app->user->identity->id, 'status_id' => 11])
                        ->limit($pagination->limit)
                        ->orderBy(['id' => SORT_DESC])
                        ->all();
                    if ($belumbayar == !null) {
                    ?>
                        <div class="pesanan">
                            <?php
                            foreach ($belumbayar as $res) {
                            ?>

                                <div class="m-b-30">
                                    <div class="pesanan-item p-lr-30 p-tb-30 m-lr-0-xl">
                                        <div class="row p-b-30">
                                            <div class="col-8">
                                                <span class="text-dark font-medium fs-18">
                                                    Payment ID&nbsp; <span class="text-success">#<?php echo $res->resi; ?></span>
                                                </span>
                                            </div>
                                            <div class="col-4 text-right">
                                                <a href="javascript:void(0)" onclick="batal(<?php echo $res->id; ?>)" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-angle-double-right"></i> Rincian<span class='hidesmall'>Pesanan</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row m-lr-0">
                                            <div class="col-md-8 p-lr-0 m-b-10">
                                                <?php
                                                $trx = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => $res->id])->all();
                                                $totalharga = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => $res->id])->sum('harga*jumlah');
                                                $no = 1;
                                                foreach ($trx as $rx) {
                                                    $trp = Produk::find()->where(['id' => $rx->produk_id])->all();
                                                    foreach ($trp as $key) {
                                                        if ($no == 2) {
                                                ?>
                                                            <div class="m-b-30 show-product">
                                                            <?php

                                                        }
                                                            ?>
                                                            <div class="row p-b-30 m-lr-0 produk-item">
                                                                <div class="col-4 col-md-2">
                                                                    <img class="img-item" src="<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $key->foto_banner ?>" alt="">
                                                                    <!-- <div class="u" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $key->foto_banner ?>);" alt="IMG"></div> -->
                                                                </div>
                                                                <div class="col-8 col-md-10">
                                                                    <p class="font-medium text-dark btn-block"><?php if ($trp != null) { ?>
                                                                            <?= $key->nama ?>
                                                                        <?php } else { ?>
                                                                            Produk Dihapus
                                                                        <?php } ?></p>
                                                                    <small class="text-primary">Warna: <?= $rx->variant1 ?> Ukuran: <?= $rx->variant2 ?></small>
                                                                    <p><?= \app\components\Angka::toReadableHarga($rx->harga);  ?> <span style="font-size:11px">x<?= $rx->jumlah; ?></span></p>
                                                                </div>
                                                            </div>
                                                        <?php

                                                        $no++;
                                                    }
                                                }
                                                if ($no > 2) {
                                                        ?>
                                                            </div>
                                                            <div class="p-b-30 p-r-10">
                                                                <a href="javascript:void(0)" class="view-product text-info"><i class="fa fa-chevron-circle-down"></i> Lihat produk lainnya</a>
                                                                <a href="javascript:void(0)" class="view-product text-info" style="display:none;"><i class='fa fa-chevron-circle-up'></i> Sembunyikan produk</a>
                                                            </div>
                                                        <?php
                                                    }
                                                        ?>
                                            </div>
                                            <div class="col-md-4">
                                                Waktu Pemesanan:<br /><i class="text-info p-r-8 font-medium"><?= \app\components\Tanggal::toReadableDate($res->selesai); ?> WIB</i>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="javascript:void(0)" onclick="terimaPesanan(55)" class="btn btn-warning btn-block m-b-10">
                                                            Berikan Ulasan
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 m-b-14"></div>
                                            <div class="col-md-4 text-right">
                                                <h5 class="text-dark">Total Order &nbsp;<span class="text-success font-bold text-right"><?= \app\components\Angka::toReadableHarga($totalharga) ?></span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="bayarva_<?= $res->id ?>" class="bayarva" style="display:none;">
                                    <div class="nomerva m-lr-30 m-t-20 p-lr-20 p-tb-14 bg2 bold">

                                    </div>
                                    <div class="bank m-lr-30 m-t-10">

                                    </div>
                                    <div class="bank m-lr-30 m-t-10">

                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class='d-flex justify-content-center pt-4'>
                                <?php echo \yii\widgets\LinkPager::widget([
                                    'pagination' => $pagination,
                                ]); ?>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-center p-tb-40 section m-t-30">
                            <i class="fas fa-box-open fs-120 text-danger m-b-20" style="display: contents"></i>
                            <h5 class="text-dark font-bold">TIDAK ADA PESANAN</h5>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <!-- BATAL -->
                <div class="tab-pane" id="dibatalkan" role="tabpanel">
                    <?php
                    $query = Pesanan::find()->where(['usrid' => Yii::$app->user->identity->id, 'status_id' => 5]);
                    $count = $query->count();
                    $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
                    $belumbayar = $query->offset($pagination->offset)
                        ->where(['usrid' => Yii::$app->user->identity->id, 'status_id' => [5, 6]])
                        ->limit($pagination->limit)
                        ->orderBy(['id' => SORT_DESC])
                        ->all();
                    if ($belumbayar == !null) {
                    ?>
                        <div class="pesanan">
                            <?php
                            foreach ($belumbayar as $res) {
                            ?>

                                <div class="m-b-30">
                                    <div class="pesanan-item p-lr-30 p-tb-30 m-lr-0-xl">
                                        <div class="row p-b-30">
                                            <div class="col-8">
                                                <span class="text-dark font-medium fs-18">
                                                    Payment ID&nbsp; <span class="text-success">#<?php echo $res->resi; ?></span>
                                                </span>
                                            </div>
                                            <div class="col-4 text-right">
                                                <a href="javascript:void(0)" onclick="batal(<?php echo $res->id; ?>)" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-angle-double-right"></i> Rincian<span class='hidesmall'>Pesanan</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row m-lr-0">
                                            <div class="col-md-8 p-lr-0 m-b-10">
                                                <?php
                                                $trx = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => $res->id])->all();
                                                $totalharga = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => $res->id])->sum('harga*jumlah');
                                                $no = 1;
                                                foreach ($trx as $rx) {
                                                    $trp = Produk::find()->where(['id' => $rx->produk_id])->all();
                                                    foreach ($trp as $key) {
                                                        if ($no == 2) {
                                                ?>
                                                            <div class="m-b-30 show-product">
                                                            <?php

                                                        }
                                                            ?>
                                                            <div class="row p-b-30 m-lr-0 produk-item">
                                                                <div class="col-4 col-md-2">
                                                                    <img class="img-item" src="<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $key->foto_banner ?>" alt="">
                                                                    <!-- <div class="u" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $key->foto_banner ?>);" alt="IMG"></div> -->
                                                                </div>
                                                                <div class="col-8 col-md-10">
                                                                    <p class="font-medium text-dark btn-block"><?php if ($trp != null) { ?>
                                                                            <?= $key->nama ?>
                                                                        <?php } else { ?>
                                                                            Produk Dihapus
                                                                        <?php } ?></p>
                                                                    <small class="text-primary">Warna: <?= $rx->variant1 ?> Ukuran: <?= $rx->variant2 ?></small>
                                                                    <p><?= \app\components\Angka::toReadableHarga($rx->harga);  ?> <span style="font-size:11px">x<?= $rx->jumlah; ?></span></p>
                                                                </div>
                                                            </div>
                                                        <?php

                                                        $no++;
                                                    }
                                                }
                                                if ($no > 2) {
                                                        ?>
                                                            </div>
                                                            <div class="p-b-30 p-r-10">
                                                                <a href="javascript:void(0)" class="view-product text-info"><i class="fa fa-chevron-circle-down"></i> Lihat produk lainnya</a>
                                                                <a href="javascript:void(0)" class="view-product text-info" style="display:none;"><i class='fa fa-chevron-circle-up'></i> Sembunyikan produk</a>
                                                            </div>
                                                        <?php
                                                    }
                                                        ?>
                                            </div>
                                            <div class="col-md-4">
                                                Waktu Pembatalan:<br /><i class="text-danger p-r-8 font-medium"><?= \app\components\Tanggal::toReadableDate($res->selesai); ?> WIB</i>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <b>Alasan Pembatalan:</b><br />
                                                <span class="text-danger"><?= $res->keterangan; ?></span>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="m-t-14 showsmall"></div>
                                                <h5 class="text-dark">Total Order &nbsp;<span class="text-success font-bold text-right"><?= \app\components\Angka::toReadableHarga($totalharga) ?></span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="bayarva_<?= $res->id ?>" class="bayarva" style="display:none;">
                                    <div class="nomerva m-lr-30 m-t-20 p-lr-20 p-tb-14 bg2 bold">

                                    </div>
                                    <div class="bank m-lr-30 m-t-10">

                                    </div>
                                    <div class="bank m-lr-30 m-t-10">

                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <div class='d-flex justify-content-center pt-4'>
                                <?php echo \yii\widgets\LinkPager::widget([
                                    'pagination' => $pagination,
                                ]); ?>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="text-center p-tb-40 section m-t-30">
                            <i class="fas fa-box-open fs-120 text-danger m-b-20" style="display: contents"></i>
                            <h5 class="text-dark font-bold">TIDAK ADA PESANAN</h5>
                        </div>
                    <?php
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".show-product").hide();
        $(".view-product").click(function() {
            $(this).parent().parent().find(".show-product").slideToggle();
            $(this).parent().parent().find(".view-product").toggle();
        });
    });

    function bayarVA(id, link) {
        $('#modalva').modal();
        $(".loadva").html($("#bayarva_" + id).html());
        $("#linkVA").attr("href", link);
    }

    function openLink(id) {
        window.location.href = id;
    }


    $(function() {
        // $("#belumbayar").load("pesanan-status?status=belumbayar");

        // $(".navlink").each(function() {
        //     var link = $(this);
        //     var tab = $(this).data("link");
        //     var res = tab.replace("#", "");

        //     $(this).click(function() {
        //         $(".navlink.btn-success").addClass("btn-info");
        //         $(".navlink.btn-success").removeClass("btn-success");
        //         link.removeClass("btn-info");
        //         link.addClass("btn-success");
        //         $(".tab-pane").hide();
        //         $(tab).show();
        //         $(tab).html("<div class='m-lr-auto text-center p-tb-40'><h4><i class='fas fa-spin fa-compact-disc text-success'></i> loading...</h4></div>");
        //         $(tab).load("pesanan-status?status=" + res);
        //     });
        // });

        $("#upload").on("submit", function(e) {
            $("#upload button").hide();
            $("#upload").append("<h5 class='text-success'><i class='fas fa-spin fa-compact-disc'></i> Mengunggah...</h5>");
        });
    });

    function cekMidtrans(bayar) {
        $('#statusmodal').modal();
        $("#status").load("http://localhost:8080/Blackexpo2/assync/cekmidtrans?bayar=" + bayar);
    }

    function bayarUlang(trx, invoice) {
        swal.fire({
                title: "Anda yakin?",
                text: "metode pembayaran sebelumnya akan dibatalkan.",
                icon: "warning",
                showDenyButton: true,
                confirmButtonText: "Oke",
                denyButtonText: "Batal"
            })
            .then((willDelete) => {
                if (willDelete.isConfirmed) {
                    //swal("Gagal!","Admin menggunakan server sandbox dari midtrans, jadi tidak dapat mengubah status transaksi di midtrans, tapi anda dapat mengganti metode pembayaran lain","error").then((res) =>{
                    window.location.href = "http://localhost:8080/Blackexpo2/home/invoice?revoke=true&inv=" + invoice;
                    //});
                }
            });
    }

    function konfirmasi(bayar) {
        $('#konfirmasimodal').modal();
        $("#bayar").val(bayar);
    }

    function terimaPesanan(trx) {
        swal.fire({
                title: "Anda yakin?",
                text: "pesanan akan di selesaikan dan dana akan diteruskan kepada penjual.",
                icon: "warning",
                showDenyButton: true,
                confirmButtonText: "Oke",
                denyButtonText: "Batal"
            })
            .then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.post("http://localhost:8080/Blackexpo2/assync/terimaPesanan", {
                        "pesanan": trx,
                        [$("#names").val()]: $("#tokens").val()
                    }, function(msg) {
                        var data = eval("(" + msg + ")");
                        updateToken(data.token);
                        if (data.success == true) {
                            refreshDikirim(1);
                            $(".selesai").trigger("click");
                        } else {
                            swal.fire("Gagal!", "Gagal menyelesaikan pesanan, coba ulangi beberapa saat lagi", "error");
                        }
                    });
                }
            });
    }

    function ajukanbatal(trx) {
        swal.fire({
                title: "Anda yakin?",
                text: "pesanan akan dibatalkan dan apabila penjual telah menyetujui maka pembayaran akan dikembalikan ke saldo Anda.",
                icon: "warning",
                showDenyButton: true,
                confirmButtonText: "Oke",
                denyButtonText: "Batal"
            })
            .then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.post("http://localhost:8080/Blackexpo2/assync/requestbatalkanPesanan", {
                        "pesanan": trx,
                        [$("#names").val()]: $("#tokens").val()
                    }, function(msg) {
                        var data = eval("(" + msg + ")");
                        updateToken(data.token);
                        if (data.success == true) {
                            refreshBatal(1);
                            $(".batal").trigger("click");
                        } else {
                            swal.fire("Gagal!", "Gagal mengajukan pembatalan pesanan, coba ulangi beberapa saat lagi", "error");
                        }
                    });
                }
            });
    }

    function batal(bayar) {
        swal.fire({
                title: "Anda yakin?",
                text: "pesanan akan dibatalkan.",
                icon: "warning",
                showDenyButton: true,
                confirmButtonText: "Oke",
                denyButtonText: "Batal"
            })
            .then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.post("http://localhost:8080/Blackexpo2/assync/batalkanPesanan", {
                        "pesanan": bayar,
                        [$("#names").val()]: $("#tokens").val()
                    }, function(msg) {
                        var data = eval("(" + msg + ")");
                        updateToken(data.token);
                        if (data.success == true) {
                            refreshBatal(1);
                            $(".batal").trigger("click");
                        } else {
                            swal.fire("Gagal!", "Gagal membatalkan pesanan, coba ulangi beberapa saat lagi", "error");
                        }
                    });
                }
            });
    }

    function perpanjang(bayar) {
        swal.fire({
                title: "Anda yakin?",
                text: "Batas waktu pengemasan penjual akan diperpanjang 2 hari.",
                icon: "warning",
                showDenyButton: true,
                confirmButtonText: "Oke",
                denyButtonText: "Batal"
            })
            .then((willDelete) => {
                if (willDelete.isConfirmed) {
                    $.post("http://localhost:8080/Blackexpo2/assync/perpanjangPesanan", {
                        "pesanan": bayar,
                        [$("#names").val()]: $("#tokens").val()
                    }, function(msg) {
                        var data = eval("(" + msg + ")");
                        updateToken(data.token);
                        if (data.success == true) {
                            refreshBatal(1);
                            $(".dikemas").trigger("click");
                        } else {
                            swal.fire("Gagal!", "Gagal membatalkan pesanan, doba ulangi beberapa saat lagi", "error");
                        }
                    });
                }
            });
    }

    function refreshBelumbayar(page) {
        $("#belumbayar").html("<div class='m-lr-auto text-center p-tb-40'><h4><i class='fas fa-spin fa-compact-disc text-success'></i> loading...</h4></div>");
        $("#belumbayar").load("pesanan-status?status=belumbayar&page=" + page);
    }

    function refreshBatal(page) {
        $("#batal").html("<div class='m-lr-auto txt-center p-tb-40'><h4><i class='fas fa-spin fa-compact-disc text-success'></i> loading...</h4></div>");
        $("#batal").load("http://localhost:8080/Blackexpo2/assync/pesanan?status=batal&page=" + page);
    }

    function refreshDikemas(page) {
        $("#dikemas").html("<div class='m-lr-auto txt-center p-tb-40'><h4><i class='fas fa-spin fa-compact-disc text-success'></i> loading...</h4></div>");
        $("#dikemas").load("http://localhost:8080/Blackexpo2/assync/pesanan?status=dikemas&page=" + page);
    }

    function refreshDikirim(page) {
        $("#dikirim").html("<div class='m-lr-auto txt-center p-tb-40'><h4><i class='fas fa-spin fa-compact-disc text-success'></i> loading...</h4></div>");
        $("#dikirim").load("http://localhost:8080/Blackexpo2/assync/pesanan?status=dikirim&page=" + page);
    }

    function refreshSelesai(page) {
        $("#selesai").html("<div class='m-lr-auto txt-center p-tb-40'><h4><i class='fas fa-spin fa-compact-disc text-success'></i> loading...</h4></div>");
        $("#selesai").load("http://localhost:8080/Blackexpo2/assync/pesanan?status=selesai&page=" + page);
    }

    function refreshPO(page) {
        $("#preorder").html("<div class='m-lr-auto txt-center p-tb-40'><h4><i class='fas fa-spin fa-compact-disc text-success'></i> loading...</h4></div>");
        $("#preorder").load("http://localhost:8080/Blackexpo2/assync/pesanan?status=po&page=" + page);
    }
</script>


<!-- Modal1 -->
<div class="modal fade" id="statusmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Status Pembayaran</h5>
                <button type="button" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times text-danger fs-24 p-all-2"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="status" class="col-12"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal1 -->
<div class="modal fade" id="konfirmasimodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                <button type="button" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times text-danger fs-24 p-all-2"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row m-lr-0 p-tb-20">
                    <div class="col-md-12 p-b-20">
                        Upload Bukti Transfer <span class="fs-14">(.jpg, .png, .pdf)</span>
                    </div>
                    <form id="upload" class="row p-lr-0 m-lr-0 w-full" method="POST" enctype="multipart/form-data" action="http://localhost:8080/Blackexpo2/manage/konfirmasi">
                        <input name="idbayar" type="hidden" id="bayar" value="0" />
                        <input type="hidden" class="tokens" name="mustbeel" value="aab0846a28ed2910656972f774e6fb25" />
                        <div class="col-md-12 p-b-20">
                            <input type="file" name="bukti" class="form-control" accept="image/*" />
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-chevron-circle-up"></i> Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
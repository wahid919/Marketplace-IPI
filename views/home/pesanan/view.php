<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use app\models\Produk;
use yii\grid\GridView;
use dmstr\helpers\Html;
use app\models\Keranjang;
use dmstr\bootstrap\Tabs;
use yii\widgets\DetailView;
use app\models\DetailPesanan;
use app\models\Toko;
use richardfan\widget\JSRegister;

/**
 * @var yii\web\View $this
 * @var app\models\DetailPesanan $model
 */


$this->title = 'DetailPesanan ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'DetailPesanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>



<style>

</style>
<!-- <link rel="stylesheet" type="text/css" href="../../../web/template/assets3/util.min.css">
<link rel="stylesheet" type="text/css" href="../../../web/template/assets3/main.css?v=1680204508"> -->

<!-- <link rel="stylesheet" type="text/css" href="http://localhost:8080/Blackexpo2/assets/css/bootstrap.min.css"> -->
<link rel="stylesheet" type="text/css" href="http://localhost:8080/Blackexpo2/assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="http://localhost:8080/Blackexpo2/assets/css/aos.css">
<link rel="stylesheet" type="text/css" href="http://localhost:8080/Blackexpo2/assets/vendor/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="http://localhost:8080/Blackexpo2/assets/vendor/select2/select2-bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="http://localhost:8080/Blackexpo2/assets/vendor/slick/slick.css">
<link rel="stylesheet" type="text/css" href="http://localhost:8080/Blackexpo2/assets/vendor/slick/slick-theme.css">
<link rel="stylesheet" type="text/css" href="http://localhost:8080/Blackexpo2/assets/vendor/swal/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="http://localhost:8080/Blackexpo2/assets/css/util.min.css">
<link rel="stylesheet" type="text/css" href="http://localhost:8080/Blackexpo2/assets/css/main.css?v=1680798149">
<link rel="stylesheet" type="text/css" href="http://localhost:8080/Blackexpo2/assets/css/responsive.css?v=1680798149">
<hr>
<div class="giiant-crud pesanan-view">
    <form class="p-t-0 p-b-0">

        <div class="row m-b-30">
            <div class="m-lr-auto">
                <div class="p-lr-40 p-t-30 p-b-40 m-l-0-xl m-r-0-xl p-r-15-sm p-l-15-sm">
                    <div class="row">
                        <div class="col-2">
                            <i class="fa fa-check-circle text-success fs-54"></i>
                        </div>
                        <div class="col-10">
                            <p class="fs-16">Order ID <?= $model->invoice ?></p>
                            <h4 class="text-primary font-medium">Terima Kasih Pelanggan</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container p-t-20 p-b-50">
            <div class="row">
                <div class="col-md-6 m-b-30">
                    <h4 class="text-primary font-bold p-b-20">
                        Pembayaran
                    </h4>
                    <div class="section p-all-30">

                        <div class="p-b-13">
                            <div class="row">
                                <div class="col-md-12 m-b-20">
                                    Mohon lakukan pembayaran sejumlah <br />
                                    <span class="fs-20 text-danger font-bold"><b><?= \app\components\Angka::toReadableHarga($model->nominal); ?></b></span>
                                </div>
                                <div class="col-md-12 m-b-20">
                                    <h5 class="text-black">Metode Pembayaran : </h5>
                                </div>
                                <div class="col-md-12 metode-bayar row m-b-20">
                                    <div class="col-md-6 m-b-12 p-lr-6">
                                        <div class="metode-item midtrans" onclick="bayarMidtrans()">
                                            <i class="cek fa fa-check-circle fs-24"></i>
                                            <img class="icon" src="http://localhost:8080/Blackexpo2/assets/images/midtrans.png" /><br />
                                            Virtual Account, E-Wallet, Minimarket, dll
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-t-5 m-t-30 bayarmanual" style="display:none;">
                                <div class="col-md-12 m-b-20">
                                    <h5 class="text-black">Silahkan transfer pembayaran ke rekening berikut:</h5>
                                </div>
                                <div class="col-md-12">
                                    <p></p>

                                    <h5 class="cl2 m-t-10 m-b-10 p-t-10 p-l-10 p-b-10" style="border-left: 8px solid #C0A230;">
                                        <b class="text-danger">Bank Bank BNI: </b><b class="text-success">0987654321</b><br />
                                        <span style="font-size: 90%">a/n MC Project<br />
                                            KCP Ulak karang</span>
                                    </h5>
                                    <p class="m-b-5 m-t-20">
                                        <b>PENTING: </b>
                                    </p>
                                    <ul style="margin-left: 15px;">
                                        <li style="list-style-type: disc;">Mohon lakukan pembayaran dalam <b>1x24 jam</b></li>
                                        <li style="list-style-type: disc;">Sistem akan otomatis mendeteksi apabila pembayaran sudah masuk</li>
                                        <li style="list-style-type: disc;">Apabila sudah transfer dan status pembayaran belum berubah, mohon konfirmasi pembayaran manual di bawah</li>
                                        <li style="list-style-type: disc;">DetailPesanan akan dibatalkan secara otomatis jika Anda tidak melakukan pembayaran.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" onclick="payMidtrans2()" class="btn btn-success btn-block btn-lg text-center bayarmidtrans m-t-30" style="display:none;"><i class="fa fa-chevron-circle-right"></i> &nbsp;<b>BAYAR SEKARANG</b></a>
                        <a href="<?= Yii::$app->request->baseUrl . "/home/pesanan" ?>" class="btn btn-danger btn-block btn-lg text-center bayarmidtrans" style="display:none;"><i class="fa fa-times"></i> &nbsp;<b>BAYAR NANTI SAJA</b></a>
                        <a href="http://localhost:8080/Blackexpo2/assync/bayaripaymu/53" style="display:none;" class="btn btn-success btn-block btn-lg text-center bayarotomatis m-t-30"><i class="fa fa-chevron-circle-right"></i> &nbsp;<b>BAYAR SEKARANG</b></a>
                        <a href="http://localhost:8080/Blackexpo2/manage/pesanan" style="display:none;" class="btn btn-danger btn-block btn-lg text-center bayarotomatis"><i class="fa fa-times"></i> &nbsp;<b>BAYAR NANTI SAJA</b></a>
                        <a href="http://localhost:8080/Blackexpo2/manage/pesanan?konfirmasi=53" style="display:none;" class="btn btn-warning btn-block btn-lg text-center bayarmanual m-t-30"><b>KONFIRMASI PEMBAYARAN</b> &nbsp;<i class="fa fa-chevron-circle-right"></i></a>

                    </div>
                </div>
                <div class="col-md-6 m-b-30">
                    <h4 class="text-primary font-bold p-b-20">
                        Informasi Pengiriman
                    </h4>
                    <div class="section p-r-40 p-l-40 p-t-30 p-b-40 m-l-0-xl p-l-15-sm m-r-0-xl p-r-15-sm">
                        <?php foreach ($detailpesanan as $pesan) {
                        ?>
                        <?php } ?>
                        <div class="p-b-13">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <h5 class="text-black p-b-10">Nama Penerima</h5>
                                    <p class="color1"><?= $pesan->nama ?></p>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-black p-b-10">No Telepon</h5>
                                    <p class="color1"><?= Yii::$app->user->identity->nomor_handphone ?></p>
                                </div>
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                    <h5 class="text-black p-b-10">Alamat Pengiriman</h5>
                                    <p class="color1"><?= $pesan->alamat_pembeli ?>
                                        KODEPOS () </p>
                                </div>
                                <!-- <div class="col-md-12">
                            <h5 class="text-black p-b-10">Alamat Pengiriman</h5>
                            <p class="color1"><?= $pesan->alamat_pembeli ?>
                                JL SUMEKAR INDAH NO 31 LN 456<BR />KEDURANG ILIR, BENGKULU SELATAN<BR />KODEPOS </p>
                        </div> -->
                            </div>

                        </div>
                    </div>
                    <h4 class="text-primary font-bold p-b-20 m-t-30">
                        Produk Pesanan
                    </h4>
                    <div class="produk p-b-40 m-l-0 m-r-0">
                        <?php foreach ($detailpesanan as $listpesanan) {
                            $keranjang = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => $listpesanan->id])->all();
                            $toko =  Toko::find()->where(['id' => $listpesanan->toko_id])->one();
                        ?>
                            <div class="produk-item row m-b-30 m-lr-0">

                                <div class="col-12">
                                    <h4 class="text-primary font-bold p-b-20 m-t-30">
                                        TOKO : <?= $toko->nama ?>
                                    </h4>
                                </div>
                                <?php
                                foreach ($keranjang as $kersan) {
                                    $produk_pesan = Produk::find()->where(['id' => $kersan->produk_id])->all();
                                    // var_dump($produk_pesan);
                                    // die;
                                ?>
                                    <?php foreach ($produk_pesan as $prosan) { ?>
                                        <!-- <div class="row pb-5"> -->
                                        <!-- <div class="col-md-12"> -->
                                        <div class="col-md-2 row m-lr-0 p-lr-0 ">
                                            <div class="img" style="background-image:url('<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $prosan->foto_banner ?>'); padding: 2%"></div>
                                        </div>
                                        <div class="col-md-6 hidesmall">
                                            <div class="p-l-10 font-medium" style="font-size: medium;"><?= $prosan->nama ?><br /><small class='text-danger'>Warna: <?= $kersan->variant1 ?> Ukuran: <?= $kersan->variant2 ?></small></div>
                                        </div>
                                        <div class="col-4 font-medium text-info">
                                            <p><?= $kersan->jumlah ?> x <?= \app\components\Angka::toReadableHarga($kersan->harga); ?></p>
                                        </div>
                                        <!-- </div> -->
                                        <!-- </div> -->
                                    <?php } ?>
                                <?php } ?>
                                <div class="col-4 font-medium text-info pt-5">
                                    <h5>Ongkir</h5>
                                </div>
                                <div class="col-4 font-medium text-info">
                                </div>
                                <div class="col-4 font-medium text-info pt-5">
                                    <p> <?= \app\components\Angka::toReadableHarga($listpesanan->ongkir); ?></p>
                                </div>
                                <div class="col-4 font-medium text-info" style="margin-top: -3%;">
                                    <h5>SubTotal</h5>
                                </div>
                                <div class="col-4 font-medium text-info">
                                </div>
                                <div class="col-4 font-medium text-info" style="margin-top: -3%;">

                                    <p> <?= \app\components\Angka::toReadableHarga($kersan->jumlah * $kersan->harga); ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row" style="margin-top: -10%">
                        <div class="col-2 font-medium text-info ">
                            <h5>TOTAL</h5>
                        </div>
                        <div class="col-6 font-medium text-info">

                        </div>
                        <div class="col-4 font-medium text-info ">
                            <p> <?= \app\components\Angka::toReadableHarga($model->nominal); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-amF49lud9vDG8ujr"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

    <script>
        function payMidtrans2() {
            window.snap.pay('<?= $model->token_midtrans ?>', {
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    Swal.fire("Peringatan!", "pesanan Berhasil", "success").then((result) => {
                        window.location = "<?= Yii::$app->request->baseUrl . "/home/pesanan" ?>";
                    });
                    // alert("payment success!"); console.log(result);
                },
                // Optional
                onPending: function(result) {
                    Swal.fire("Peringatan!", "Transaksi Menunggu Pembayaran", "warning").then((result) => {
                        window.location = "<?= Yii::$app->request->baseUrl . "/home/pesanan" ?>";
                    });
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    Swal.fire("Peringatan!", "pesanan Gagal", "error").then((result) => {

                    });
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    Swal.fire("Peringatan!", "Anda Belum Menyelesaikan pesanan", "error").then((result) => {
                        // window.location = "<?= Yii::$app->request->baseUrl . "/home/pesanan?" ?>";
                    });
                }
            })
        }

        function bayarMidtrans() {
            $(".metode-item").removeClass("active");
            $(".metode-item.midtrans").addClass("active");
            $(".bayarmanual").hide();
            $(".bayarotomatis").hide();
            $(".bayarmidtrans").show();
        }
    </script>
    <!-- menu buttons -->


    <!-- <div class="box box-info">
        <div class="box-body">
            <?php $this->beginBlock('app\models\Pesanan'); ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'invoice',
                    // 'nama',
                    'nominal',
                    // 'usrid',
                    'created_at',
                    // 'updated_at',
                    // 'status_id',
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



            <?= Tabs::widget(
                [
                    'id' => 'relation-tabs',
                    'encodeLabels' => false,
                    'items' => [[
                        'label'   => '<b class=""># ' . $model->id . '</b>',
                        'content' => $this->blocks['app\models\Pesanan'],
                        'active'  => true,
                    ],]
                ]
            );
            ?>
        </div>
    </div> -->
</div>
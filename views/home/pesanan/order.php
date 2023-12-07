<?php

use app\models\Toko;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Produk;
use yii\grid\GridView;
use app\models\ProductDetail;
use app\models\ProductDetailVariant;

?>



<!-- Checkout Section Begin -->
<hr class="mt-0">
<section class="checkout" style="padding-top: 30px;">
    <div class="container">
        <!-- <div class="row">
            <div class="col-lg-12">
                <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                </h6>
            </div>
        </div> -->
        <div class="checkout__form">
            <h4>Billing Details</h4>
            <!-- <form action="#"> -->
            <div class="container">

                <div class="program1-wrap">
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" value="<?= Yii::$app->user->identity->name ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="section p-lr-32 p-t-30 p-b-40 m-l-0-xl m-r-0-xl p-l-15 p-r-25">
                                <div class="p-b-13">
                                    <input type="hidden" id="tujuan" value="" name="tujuan" />
                                    <div class="m-b-12 alamatform">
                                        <div class="checkout__input">
                                            <p>Alamat Pengiriman<span>*</span></p>
                                        </div>
                                    </div>
                                    <div class="rs1-select2 rs2-select2 m-b-12 alamatform">
                                        <select class="js-select2 form-control" name="alamat" id="idalamat">
                                            <option value="">- Pilih Alamat Tujuan -</option>
                                            <option value="99999999999999999">+ Tambah Alamat Baru</option>
                                            <?php
                                            foreach ($useralamats as $useralamat) { ?>
                                                <option value="<?= $useralamat->id ?>" distrik="<?= $useralamat->idkec ?>" lengkap="<?= $useralamat->alamat ?>" postcode="<?= $useralamat->kodepos ?>" data-tujuan="255"><?= $useralamat->judul ?> - <?= YII::$app->user->identity->name ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                    <div class="m-b-12">
                                        <br>
                                        <br>
                                        <?php foreach ($useralamats as $useralamat) { ?>
                                            <div class='alamat section bg-medium p-tb-20 p-lr-24 m-t-20 ' id='alamat_<?= $useralamat->id ?>' style='display:none;'>
                                                <!-- <b class='text-info'>Nama Penerima:</b><br /><?= YII::$app->user->identity->name ?><br />
                                                        <b class='text-info'>No HP:</b><br /><?= YII::$app->user->identity->nomor_handphone ?><br />
                                                        <b class='text-info'>Alamat Lengkap:</b><br /><?= $useralamat->judul ?><BR /><?= $useralamat->alamat ?><br />KODEPOS <?= $useralamat->kodepos ?> -->
                                                <div class="checkout__input">
                                                    <br>
                                                    <p>Alamat Lengkap<span>*</span></p>
                                                    <input name="customeraddress" type="text" placeholder="Street Address" class="checkout__input__add" value="<?= $useralamat->alamat ?>">
                                                    <input type="text" placeholder="Apartment, rumah, hotel, dll (optinal)" value="<?= $useralamat->judul ?>">
                                                </div>
                                                <div class="checkout__input">
                                                    <p>Postcode / ZIP<span>*</span></p>
                                                    <input name="pos" type="text" value="<?= $useralamat->kodepos ?>">
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="checkout__input">
                                                            <p>Phone<span>*</span></p>
                                                            <input name="customerphone" type="text" value="<?= Yii::$app->user->identity->nomor_handphone ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="checkout__input">
                                                            <p>Email<span>*</span></p>
                                                            <input type="text" value="<?= Yii::$app->user->identity->username ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class='alamat section bg-medium p-tb-20 p-lr-24 m-t-20' id='alamat_99999999999999999' data-tujuan='272' style='display:none;'>
                                            <div class="m-b-12 ">
                                                <b>Tambah Alamat Pengiriman</b>
                                            </div>
                                            <div class="">
                                                <div class="checkout__input">
                                                    <br>
                                                    <p>Alamat Lengkap<span>*</span></p>
                                                    <input type="text" placeholder="Street Address" class="checkout__input__add">
                                                    <input type="text" placeholder="Apartment, rumah, hotel, dll (optinal)">
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="checkout__input">
                                                            <p>Provinsi<span>*</span></p>
                                                            <select class="form-control" id="nama_provinsi" name="nama_provinsi" style="font-size: 16px;color: #b2b2b2;">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="checkout__input">
                                                            <p>Distrik<span>*</span></p>
                                                            <select class="form-control" id="nama_city" name="nama_city" style="font-size: 16px;color: #b2b2b2;">
                                                                <option value="">--Pilih Provinsi Terlebih Dulu</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="checkout__input">
                                                    <br>
                                                    <p>Postcode / ZIP<span>*</span></p>
                                                    <input name="pos" type="text">
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="checkout__input">
                                                            <p>Phone<span>*</span></p>
                                                            <input type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="checkout__input">
                                                            <p>Email<span>*</span></p>
                                                            <input type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <br>
                                    <div class="checkout__input">
                                        <p>Order notes<span>*</span></p>
                                        <input type="text" placeholder="Notes about your order, e.g. special notes for delivery.">
                                    </div>
                                </div>
                                <!-- <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Ekspedisi<span>*</span></p>
                                        <select class="form-control" id="ekspedisi" name="ekspedisi" style="font-size: 16px;color: #b2b2b2;">
                                            <option value="">--Pilih Ekspedisi--</option>
                                            <option value="jne">JNE</option>
                                            <option value="pos">POS Indonesia</option>
                                            <option value="tiki">TIKI</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Paket<span>*</span></p>
                                        <select class="form-control" id="paket" name="paket" style="font-size: 16px;color: #b2b2b2;">
                                            <option value="">Ekspedisi !!!</option>
                                        </select>
                                    </div>
                                </div> -->
                            </div>
                            <br>
                            <!-- <div class="checkout__input">
                                        <p>Country<span>*</span></p>
                                        <input type="text">
                                    </div> -->
                        </div>
                        <div class="program__info col-lg-5 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <?php
                                $tokos = Toko::find()->all();
                                $totalBerat = 0;
                                foreach ($tokos as $toko) {
                                    $tokoHasProduk = false; // Menandakan apakah toko memiliki produk dalam keranjang atau tidak
                                    foreach ($keranjang as $ker) {
                                        $produkkeranjang = Produk::find()->where(['id' => $ker->produk_id])->one();
                                        $total = $ker->harga * $ker->jumlah;
                                        if ($produkkeranjang->toko_id == $toko->id) {
                                            $weight = ProductDetailVariant::find()
                                                ->select('*')
                                                ->innerJoin('product_detail', "product_detail_id = product_detail.id")
                                                ->where(['product_variant_id' => [$ker->intv1, $ker->intv2]])
                                                ->groupBy('product_detail_id')
                                                ->having('count(*) = 2')
                                                ->asArray()
                                                ->one();

                                            $weightone = $weight["berat"] ?? 0;
                                            // var_dump($weightone);
                                            // die;
                                            $totalBerat += $weightone;
                                            // // $output = rtrim($output1, '0');
                                            // $output = number_format($output1, 1) . ' gram';
                                            if (!$tokoHasProduk) { // Tampilkan informasi toko hanya jika toko memiliki produk dalam keranjang dan belum ditampilkan sebelumnya
                                ?>
                                                <div class="checkout__order__products" style="text-transform: uppercase;"><?= $toko->nama ?></div>
                                                <div class="checkout__order__products" style="
                                                font-size: 15px;
                                                color: #1c1c1c;
                                                font-weight: 700;
                                                margin-bottom: 0%;
                                                ">Products<span>Total</span></div>
                                                <!-- <div class="checkout__order__products">
                                                    <p>Nama Toko: <?= $toko->nama ?></p>
                                                    <p>Alamat: <?= $toko->alamat ?></p>
                                                    <p>idkec: <?= $toko->idkec ?></p>
                                                </div> -->
                                            <?php
                                                $tokoHasProduk = true; // Mengubah status menjadi true karena toko memiliki produk dalam keranjang
                                            }
                                            ?>
                                            <ul>
                                                <li><?= $produkkeranjang->nama ?> <span><?= \app\components\Angka::toReadableHarga($total); ?></span></li>
                                                <li style="line-height: 0px;font-size: 12px;">Warna: <?= $ker->variant1 ?>, Ukuran: <?= $ker->variant2 ?></li>
                                            </ul>
                                            <ul>
                                                <li class="produk__berat" style="line-height: 0px;font-size: 12px; padding-top: 1%">Berat: <?= $weightone ?></li>
                                            </ul>
                                        <?php
                                        }
                                    }
                                    if ($tokoHasProduk) { // Tampilkan bagian Ekspedisi dan Paket hanya jika toko memiliki produk dalam keranjang
                                        ?>
                                        <style>
                                            .checkout__input p {
                                                color: #1c1c1c;
                                                margin-bottom: 2px;
                                            }
                                        </style>
                                        <div class="row checkout__order__tokoi" style="padding-bottom:3%; padding-top: 5%;">
                                            <div class="col-lg-6">
                                                <div class="checkout__input">
                                                    <p>Ekspedisi<span>*</span></p>
                                                    <select class="form-control ekspedisi" data-toko="<?= $toko->idkec ?>" data-berat="<?= $totalBerat ?>" data-toko-id="<?= $toko->id ?>" style="font-size: 16px;color: #b2b2b2;">
                                                        <option value="">--Pilih Ekspedisi--</option>
                                                        <option value="jne" tokokec="<?= $toko->idkec ?>">JNE</option>
                                                        <option value="pos" tokokec="<?= $toko->idkec ?>">POS Indonesia</option>
                                                        <option value="tiki" tokokec="<?= $toko->idkec ?>">TIKI</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="checkout__input">
                                                    <p>Paket<span>*</span></p>
                                                    <select class="form-control paket" data-toko-id="<?= $toko->id ?>" id="paket" style="font-size: 16px;color: #b2b2b2;">
                                                        <option value="">Ekspedisi !!!</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="checkout__order__subtotal">
                                            Subtotal <span><?= \app\components\Angka::toReadableHarga($totalharga); ?></span>
                                        </div> -->
                                <?php
                                    }
                                }
                                ?>
                                <br>
                                <!-- <div class="checkout__order__subtotal">
                                    Subtotal <span><?= \app\components\Angka::toReadableHarga($totalharga); ?></span>
                                </div> -->
                                <div class="program__text">
                                    <div class="checkout__order__total" value="<?= $totalharga ?>">
                                        Total <span><?= \app\components\Angka::toReadableHarga($totalharga); ?></span>
                                    </div>
                                </div>
                                <div class="aa" style="display: none">
                                    <div class="checkout__input">
                                        <br>
                                        <p>Harga<span style="text-align: right;">*</span></p>
                                        <input name="har" type="text" value="<?= $total ?>">
                                    </div>
                                    <div class="checkout__order__total" value="<?= $totalharga ?>">
                                        <input name="tot" type="text" value="<?= $totalharga ?>">
                                        <!-- Total <span><?= \app\components\Angka::toReadableHarga($totalharga); ?></span> -->
                                    </div>
                                </div>
                                <button type="button" class="site-btn btn-program" id="bayarkan">PAY ORDER</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js">
</script>

<script>
    var pilihankurir = {};

    $(document).ready(function() {
        // query and ajax sleect provinsi
        console.log('aaaa');
        $.ajax({
            type: 'post',
            url: '<?= Yii::$app->request->baseUrl . "/home/ajax-select-provinsi" ?>',
            success: function(htmlresponse) {
                $("#nama_provinsi").html(htmlresponse);
                $("#nama_provinsi").niceSelect('update');
            }
        })

        // query and ajax sleect Distrik
        $("#nama_provinsi").on("change", function() {
            var id_provinsi_terpilih = $('option:selected', '#nama_provinsi').attr('id_provinsi');
            $.ajax({
                type: 'post',
                url: '<?= Yii::$app->request->baseUrl . "/home/ajax-select-city" ?>',
                data: 'id_provinsi=' + id_provinsi_terpilih,
                success: function(htmlresponse) {
                    $("#nama_city").html(htmlresponse);
                    $("#nama_city").niceSelect('update');
                }
            });
        });

        // query and ajax kodepos
        $('#nama_city').on("change", function() {
            var pos = $('option:selected', '#nama_city').attr('kodepos');
            $("input[name=pos]").val(pos);
        });
        // query and ajax get ongkir
        $('#paket').on("change", function() {
            var ongkir = $('option:selected', '#paket').attr('ongkir');

            $("text[name=ongkirpay]").val(ongkir);
        });

        // query and ajax select alamat
        $('#idalamat').niceSelect('update')
        $("#idalamat").change(function() {
            var idalamat = $(this).val();
            var tujuan = $("#alamat_" + idalamat).data(' tujuan');
            $("#tujuan").val(tujuan);
            $(".alamat").hide();
            if ($(this).val() == "") {
                resetOngkir();
                $(".tambahalamat").hide();
                $(".tambahalamat input,.tambahalamat textarea").prop("required", false);
            } else if ($(this).val() == 0) {
                resetOngkir();
                $(".tambahalamat").show();
                $(".tambahalamat input,.tambahalamat textarea").prop("required", true);
                if ($("#kab").val() != "") {
                    $("#tujuan").val($("#kab").val());
                    hitungOngkir();
                } else {
                    resetOngkir();
                }
            } else if ($(this).val() > 0) {
                $("#alamat_" + idalamat).show();
                $(".tambahalamat").hide();
                $(".tambahalamat input,.tambahalamat textarea").prop("required", false);

                hitungOngkir();
            }

        });


        $('#nama_city').on('change', onChangeDropdown);
        $('#ekspedisi').on('change', onChangeDropdown);
        $('#idalamat').on('change', onChangeDropdown);
        $("#nama_city").niceSelect('update');
        $("#ekspedisi").niceSelect('update');
        $("#idalamat").niceSelect('update');
    });

    // query and ajax get paket
    $(document).ready(function() {
        var totalBerat = 0; // Initialize totalBerat as 0
        const tokoId = $(this).attr('data-toko-id')
        $('.checkout__order__tokoi').each(function() {
            var tokoContainer = $(this);
            var ekspedisiSelect = tokoContainer.find('.ekspedisi');
            var paketSelect = tokoContainer.find('.paket');
            var totalBayarContainer = $('.checkout__order__total');
            var totalBayar = parseInt(totalBayarContainer.attr('value')); // Total harga awal dari semua toko

            var tokoBerat = 0; // Initialize tokoBerat as 0 for each store

            // Calculate totalBerat by summing up tokoBerat for each store
            $('.produk__berat').each(function() {
                var beratText = $(this).text().replace('Berat: ', ''); // Menghapus teks "Berat: " dari nilai teks
                var berat = parseFloat(beratText);
                if (!isNaN(berat)) {
                    tokoBerat += berat;
                    // totalBerat += berat;
                }
            });

            console.log(totalBerat);

            ekspedisiSelect.change(function() {

                var selectedOption = $(this).find('option:selected');
                var ekspedisi = selectedOption.val();
                var tokoKecamatan = $(this).data('toko');
                var kecamatanPembeli = $('#idalamat option:selected').attr('distrik');

                const tokoId = $(this).attr('data-toko-id')
                pilihankurir[tokoId] = {
                    'ekspedisi': ekspedisi
                };

                console.log(pilihankurir);
                // console.log(totalBerat);


                $.ajax({
                    url: '<?= Yii::$app->request->baseUrl . "/home/ajax-select-paket" ?>',
                    method: 'POST',
                    data: {
                        tokoKecamatan: tokoKecamatan,
                        kecamatanPembeli: kecamatanPembeli,
                        ekspedisi: ekspedisi,
                        berat: parseInt(tokoBerat)
                    },
                    success: function(response) {
                        var options = '<option value="">Pilih Paket</option>';
                        response = JSON.parse(response);

                        for (var i = 0; i < response.length; i++) {
                            var service = response[i].service;
                            var value = response[i].value;
                            var etd = response[i].etd;

                            options += '<option value="' + value + '">' + service + ' - Rp.' + value + ' - ' + etd + ' Hari</option>';
                        }

                        paketSelect.html(options);
                        paketSelect.niceSelect('update');

                        // Hitung totalBayar ulang dari semua toko
                        var totalBayarUpdated = 0;
                        $('.paket option:selected').each(function() {
                            var hargaPaket = parseInt($(this).attr('value'));
                            totalBayarUpdated += hargaPaket;
                        });

                        // Update totalBayar dengan totalBayarUpdated
                        totalBayar = totalBayarUpdated;
                        totalBayarContainer.attr('value', totalBayar);
                        $('.checkout__order__total span').text(totalBayar);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            paketSelect.change(function() {
                const tokoId = $(this).attr('data-toko-id')
                pilihankurir[tokoId]['harga_paket'] = $(this).val();
                // pilihankurir[tokoId]['service'] = $(this).val('service');
                console.log(pilihankurir);

                var totalBayarUpdated = 0;
                $('.paket option:selected').each(function() {
                    var hargaPaket = parseInt($(this).attr('value'));
                    totalBayarUpdated += hargaPaket;
                });
                var totalbayarawal = $('input[name=tot]').val();

                totalBayar = totalBayarUpdated + parseInt(totalbayarawal);
                totalBayarContainer.attr('value', totalBayar);
                $('.checkout__order__total span').text(toReadableHarga(totalBayar));
            });
        });
    });

    function toReadableHarga(value) {
        return value.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
    }




    // function onChangeDropdown() {
    //     // var city = $('option:selected', '#nama_city').attr('id_city');
    //     var city = $('option:selected', '#idalamat').attr('distrik');
    //     var ekspedisi = $('#ekspedisi').val();
    //     var berat = 5000;
    //     // var size = $('select').selectsize('update');
    //     // var warna = $('select').selectwarna('update');
    //     console.log('ascaca')
    //     $.ajax({
    //         type: 'POST',
    //         url: '<?= Yii::$app->request->baseUrl . "/home/ajax-select-paket" ?>',
    //         data: {
    //             city: '' + city + '',
    //             ekspedisi: '' + ekspedisi + '',
    //             berat: '' + berat + '',
    //         },
    //         success: function(htmlresponse) {
    //             $('#paket').html(htmlresponse);
    //             $('#paket').niceSelect('update');
    //             console.log(htmlresponse);
    //         }
    //     });
    // }
    document.querySelector("#bayarkan").addEventListener("click", () => {
        // var totalbayar = 0;
        var totalbayar = $('.checkout__order__total').attr('value');
        console.log(totalbayar);
        var tujuan = $('option:selected', '#idalamat').attr('distrik');
        var alamatpembeli = $('option:selected', '#idalamat').attr('lengkap');
        var kodepospembeli = $('option:selected', '#idalamat').attr('postcode');
        var berat = 5000;
        var paket = 'oke';


        console.log(pilihankurir);
        <?php if (Yii::$app->user->identity->id == !null) { ?>
            if (!(tujuan == null)) {
                if (!(pilihankurir == null)) {
                    $.ajax({
                        method: 'post',
                        url: '<?= Yii::$app->request->baseUrl . "/home/pembayaran" ?>',
                        data: {
                            'totalbayar': totalbayar,
                            'tujuan': tujuan,
                            'kurir': pilihankurir,
                            'alamatpembeli': alamatpembeli,
                            'kodepospembeli': kodepospembeli,
                            'berat': berat,
                            'paket': paket,
                        },
                        success: function(response) {
                            // Redirect to pesanan page
                            window.location.href = `<?= Url::to(['home/pesanan']) ?>`;
                        }
                    })
                } else {
                    swal.fire({
                        title: "Ongkir Tidak terdeteksi !",
                        text: "Pilih Ongkir Terlebih Dahulu.",
                        icon: "error",
                        showDenyButton: false,
                        confirmButtonText: "Oke",
                        denyButtonText: "Batal"
                    })
                }
            } else {
                swal.fire({
                    title: "Alamat Belum Dipilih !",
                    text: "Silahkan Pilih Alamat Penerima Terlebih dahulu.",
                    icon: "warning",
                    showDenyButton: false,
                    confirmButtonText: "Oke",
                    denyButtonText: "Batal"
                })
            }
        <?php } else { ?>
            $.ajax({
                success: (response) => {
                    alert("Silahkan Login Terlebih dahulu");
                    window.location = "<?= Yii::$app->request->baseUrl . "/home/login" ?>";
                }
            })
        <?php } ?>
        // $.ajax({
        //     method: 'post',
        //     url: '<?= Yii::$app->request->baseUrl . "/home/pembayaran" ?>',
        //     data: {
        //         'totalbayar': totalbayar,
        //         'tujuan': tujuan,
        //         'kurir': pilihankurir,
        //         'alamatpembeli': alamatpembeli,
        //         'kodepospembeli': kodepospembeli,
        //         'berat': berat,
        //         'paket': paket,
        //     },
        //     success: function(response) {
        //         // Redirect to pesanan page
        //         window.location.href = `<?= Url::to(['home/pesanan']) ?>`;
        //     }
        // })

        // window.location.href = `<?= Url::to(['pesanan']) ?>`;
    });



    // document.querySelector("#bayarkan").addEventListener("click", () => {
    //     console.log('haloooooooo')
    //     var totalbayar = $('input[name=har]').val();
    //     var tujuan = $('option:selected', '#idalamat').attr('distrik');
    //     var alamatpembeli = $('option:selected', '#idalamat').attr('lengkap');
    //     var kodepospembeli = $('option:selected', '#idalamat').attr('postcode');
    //     var berat = 5000;
    //     // var ongkir = $('option:selected', '#paket').attr('ongkir');
    //     // var kurir = $('option:selected', '#ekspedisii').val();
    //     var paket = $('option:selected', '#paket').attr('paket');
    //     var ongkir = 50000;
    //     var kurir = 'jne';
    //     // var paket = 'reg';
    //     $('.checkout__order__products').each(function() {
    //         var subtotal = $(this).next('ul').find('span').text();
    //         subtotal = parseFloat(subtotal.replace(/[^0-9.-]+/g, '')); // Mengambil nilai angka dari subtotal dengan menghapus karakter non-numerik
    //         totalbayar += subtotal; // Menambahkan subtotal ke totalbayar
    //     });

    //     var selectedPaket = $('option:selected', '#paket');
    //     if (selectedPaket.length) {
    //         ongkir = parseInt(selectedPaket.attr('ongkir')); // Mendapatkan nilai ongkir dari atribut ongkir pada opsi paket terpilih
    //         kurir = selectedPaket.attr('kurir');
    //         paket = selectedPaket.val();
    //     }

    //     var total = totalbayar + ongkir;

    //     // console.log(alamatpembeli);
    //     console.log(kodepospembeli);

    //     window.location.href =
    //         `<?= Url::to(['/home/pembayaran']) ?>?total=${total}&tujuan=${tujuan}&kodepospembeli=${kodepospembeli}&berat=${berat}&ongkir=${ongkir}&kurir=${kurir}&paket=${paket}&alamatpembeli=${alamatpembeli}`;

    //     // $.ajax({
    //     //     url: '<?= Url::to(['home/pembayaran']) ?>',
    //     //     data: {
    //     //     },
    //     //     success: (response) => {
    //     //         if (response.success) {
    //     //             window.open(response.url)
    //     //         }
    //     //     }
    //     // })
    // });
</script>
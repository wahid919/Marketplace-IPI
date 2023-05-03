<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Produk;
use yii\grid\GridView;

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
                                <div class="col-lg-6">
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
                                </div>
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
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <?php foreach ($keranjang as $ker) {
                                    $produkkeranjang = Produk::find()->where(['id' => $ker->produk_id])->one();
                                    $total = $ker->harga * $ker->jumlah;
                                ?>
                                    <ul>
                                        <li><?= $produkkeranjang->nama ?> <span><?= \app\components\Angka::toReadableHarga($total); ?></span></li>
                                        <li style="line-height: 0px;font-size: 12px;">Warna: <?= $ker->variant1 ?>, Ukuran: <?= $ker->variant2 ?></li>
                                    </ul>
                                <?php } ?>
                                <br>
                                <div class="checkout__order__subtotal">Subtotal <span><?= \app\components\Angka::toReadableHarga($totalharga); ?></span></div>
                                <!-- <div class="checkout__order__subtotal">Ongkir <span><input id="ongkirpay" name="ongkirpay" type="text"></span></div> -->
                                <div class="program__text">
                                    <div class="checkout__order__total" value="<?= $totalharga ?>">Total <span><?= \app\components\Angka::toReadableHarga($totalharga); ?></span></div>
                                </div>
                                <div class="aa" style="display: none">
                                    <div class="checkout__input">
                                        <br>
                                        <p>harga<span>*</span></p>
                                        <input name="har" type="text" value="<?= $totalharga ?>">
                                    </div>
                                </div>
                                <!-- <div class="checkout__input__checkbox">
                                            <label for="acc-or">
                                                Create an account?
                                                <input type="checkbox" id="acc-or">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                            ut labore et dolore magna aliqua.</p>
                                        <div class="checkout__input__checkbox">
                                            <label for="payment">
                                                Check Payment
                                                <input type="checkbox" id="payment">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="checkout__input__checkbox">
                                            <label for="paypal">
                                                Paypal
                                                <input type="checkbox" id="paypal">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div> -->
                                <button type="button" class="site-btn btn-program" id="bayarkan">PAY ORDER</button>
                                <!-- <button type="button" class="btn btn-sm btn-program" style="padding: 10px !important;background-color:green" id="bayarkan">Bayar</button> -->
                                <!-- <button type="button" class="btn btn-sm btn-program" style="padding: 10px !important;background-color:green" id="bayarkan">Bayar</button> -->
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
    console.log('bbbb');
    $(document).ready(function() {
        // query and ajax sleect provinsi
        console.log('aaaa');
        $.ajax({
            type: 'post',
            url: 'http://localhost:8080/ipi4/web/home/ajax-select-provinsi',
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
                url: 'http://localhost:8080/ipi4/web/home/ajax-select-city',
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
    });

    // query and ajax get paket
    function onChangeDropdown() {
        // var city = $('option:selected', '#nama_city').attr('id_city');
        var city = $('option:selected', '#idalamat').attr('distrik');
        var ekspedisi = $('#ekspedisi').val();
        var berat = 5000;
        // var size = $('select').selectsize('update');
        // var warna = $('select').selectwarna('update');
        console.log('ascaca')
        $.ajax({
            type: 'POST',
            url: 'http://localhost:8080/ipi4/web/home/ajax-select-paket',
            data: {
                city: '' + city + '',
                ekspedisi: '' + ekspedisi + '',
                berat: '' + berat + '',
            },
            success: function(htmlresponse) {
                $('#paket').html(htmlresponse);
                $('#paket').niceSelect('update');
                console.log(htmlresponse);
            }
        });
    }

    document.querySelector("#bayarkan").addEventListener("click", () => {
        console.log('haloooooooo')
        var totalbayar = $('input[name=har]').val();
        var tujuan = $('option:selected', '#idalamat').attr('distrik');
        var alamatpembeli = $('option:selected', '#idalamat').attr('lengkap');
        var kodepospembeli = $('option:selected', '#idalamat').attr('postcode');
        var berat = 5000;
        // var ongkir = $('option:selected', '#paket').attr('ongkir');
        // var kurir = $('option:selected', '#ekspedisii').val();
        var paket = $('option:selected', '#paket').attr('paket');
        var ongkir = 50000;
        var kurir = 'jne';
        // var paket = 'reg';

        // console.log(alamatpembeli);
        console.log(kodepospembeli);

        window.location.href =
            `<?= Url::to(['/home/pembayaran']) ?>?totalbayar=${totalbayar}&tujuan=${tujuan}&kodepospembeli=${kodepospembeli}&berat=${berat}&ongkir=${ongkir}&kurir=${kurir}&paket=${paket}&alamatpembeli=${alamatpembeli}`;

        // $.ajax({
        //     url: '<?= Url::to(['home/pembayaran']) ?>',
        //     data: {
        //     },
        //     success: (response) => {
        //         if (response.success) {
        //             window.open(response.url)
        //         }
        //     }
        // })
    });
</script>
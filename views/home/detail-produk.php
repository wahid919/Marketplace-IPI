<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

// namespace Midtrans;

use app\components\Angka;
use app\components\Constant;
use app\models\ProductDetailVariant;
use app\models\ProdukStok;
use app\models\Toko;
use Mpdf\Tag\Div;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var app\models\ProdukStok $mod
 * @var yii\widgets\ActiveForm $form
 */

$toko = Toko::findOne(['id' => $produk->toko_id]);
$wa_toko = Constant::purifyPhone($toko->no_whatsapp);
$isi = "Saya tertarik dengan produk ini,apakah stok produk " . $produk->nama . " masih tersedia?";
$hsl_isi = rawurlencode($isi);
$url_wa = "https://wa.me/$wa_toko?text=$hsl_isi";
?>
<style>
    .rate {
        display: inline;
    }

    .rate * {
        float: right;
    }

    .rate label {
        font-size: 30px;
    }

    .rate_display {
        display: -webkit-inline-box;
    }

    .rate_display * {
        float: right;
    }

    .rate_display label {
        font-size: 20px;
    }

    input {
        display: none;
    }

    input:checked~label {
        color: red;
    }
</style>
<hr class="mt-0">
<?php if (Yii::$app->session->hasFlash('success')) : ?>
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <p><i class="icon fa fa-check"></i>Saved!</p>
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-close"></i>Not Saved!</h4>
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="program1-wrap">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $produk->foto_banner ?>" style="" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">

                            <?php if ($fotos_produk != null) {
                                foreach ($fotos_produk as $foto_produk) {
                            ?>
                                    <img data-imgbigurl="<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $produk->foto_banner ?>" src="<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $produk->foto_banner ?>" alt="#">
                                    <img data-imgbigurl="<?= \Yii::$app->request->baseUrl . "/uploads/foto_produk/" . $foto_produk->foto ?>" src="<?= \Yii::$app->request->baseUrl . "/uploads/foto_produk/" . $foto_produk->foto ?> " alt="#">

                                <?php }
                            } else { ?>
                                Tidak Terdapat Galeri Foto Produk
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="program__info col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>
                            <p style="    margin-bottom: -7px;">Product > <?= $produk->kategoriProduk->nama ?></p><?= $produk->nama ?>
                        </h3>

                        <div class="product__details__rating">
                            <?= $round_jml ?>.0&nbsp;&nbsp;
                            <!-- &#11088;&#11088;&#11088;&#11088;&#11088; -->
                            <?php
                            $cfg_min_stars = 1;
                            $cfg_max_stars = 5;
                            $temp_stars = $round_jml;
                            if ($round_jml == 0) {
                                for ($i = $cfg_min_stars; $i <= $cfg_max_stars; $i++) {
                                    echo '<label for="star1" style="font-size:20px;" title="text"><i class="fa fa-star-o"></i></label>';
                                }
                            } else {
                                for ($i = $cfg_min_stars; $i <= $cfg_max_stars; $i++) {
                                    //echo $temp_stars;
                                    if ($temp_stars >= 1) {
                                        echo '<label for="star1" style="font-size:18px;" title="text"><i class="fa fa-star"></i></label>';
                                        $temp_stars--;
                                    } else {
                                        echo '<label for="star1" style="font-size:20px;" title="text"><i class="fa fa-star-o"></i></label>';
                                    }
                                }
                            }
                            ?>
                            <!-- <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-half-o"></i> -->
                            <span>(<?= $count_review ?> reviews)</span>
                        </div>
                        <div class="program__text">
                            <h4 class="product__details__price" id="outputharga"><?= \app\components\Angka::toReadableHarga($minimumprice); ?> - <?= \app\components\Angka::toReadableHarga($maximumprice); ?></h4>
                        </div>
                        <div class="program__text" style="display: none">
                            <h4 class="product__details__price" id="outputintharga"><?= \app\components\Angka::toReadableHarga($produk->harga); ?></h4>
                        </div>
                        <p><?= $produk->deskripsi_singkat ?></p>
                        <div class="row">
                            <style>
                                .nice-select {
                                    height: 43px;
                                    line-height: 30px;
                                }
                            </style>
                            <div class="col-sm-2 col-md-2 col-lg-2">
                                <div class="div">
                                    <select class="form-control" id="selectwarna" name="selectwarna" style="  ">
                                        <option class="font-weight-bold " style="" value="<?= \Yii::$app->request->baseUrl ?>">
                                            Pilih Warna</option>
                                        <?php
                                        foreach ($getwarnas as $getwarna) {
                                        ?>

                                            <option class="font-weight-bold" id="selectwarna" value="<?= $getwarna->id ?>" warnastring="<?= $getwarna->value ?>" <?php
                                                                                                                                                                    if ($_GET['warna'] == $getwarna->value) {
                                                                                                                                                                        echo "selected";
                                                                                                                                                                    }
                                                                                                                                                                    ?>>
                                                <?= $getwarna->value ?></option>
                                        <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-1 col-md-1 col-lg-1"></div>
                            <div class="col-sm-2 col-md-2 col-lg-2">
                                <div class="div">
                                    <select class="form-control" id="selectsize" name="selectsize" style=" height: 43px;line-height: 30px; ">
                                        <option class="font-weight-bold " style="margin: 10%;" value="<?= \Yii::$app->request->baseUrl ?>">
                                            Pilih Size</option>
                                        <?php
                                        foreach ($getsizes as $getsize) {  ?>
                                            <option class="font-weight-bold" value="<?= $getsize->id ?>" sizestring="<?= $getsize->value ?>" <?php
                                                                                                                                                if ($_GET['size'] == $getsize->value) {
                                                                                                                                                    echo "selected";
                                                                                                                                                }
                                                                                                                                                ?>>
                                                <?= $getsize->value ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-7 col-md-7 col-lg-7"></div>
                        </div>
                        <br>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input id="jumlah" name="jumlah" style="display: -webkit-inline-box;" type="text" value="1">
                                </div>
                            </div>
                        </div>
                        <a class="primary-btn btn-program" id="keranjang" style="cursor:pointer; color: white">Add to Cart</a>
                        <!-- <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a> -->
                        <ul>
                            <li>
                                <b>Availability</b> <span id="stokones">
                                    <?= $stokones ?>
                                </span>
                            </li>

                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Weight</b> <span>0.5 kg</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<URL>"><i class="fa fa-facebook"></i></a>
                                    <a href="https://twitter.com/share?url=<URL>&text=<TEXT>via=<USERNAME>"><i class="fa fa-twitter"></i></a>
                                    <a href=""><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">Location</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Reviews <span><?= $count_review ?></span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p><?= $produk->deksripsi_lengkap ?></p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Location Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Review Infomation</h6>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 pt-70">

                                            <?php if ($review_produks == null) { ?>
                                                <p class="update-program">
                                                    Belum Ada Review.
                                                </p>
                                            <?php } else { ?>
                                                <table class="table table-hover">
                                                    <thead>
                                                        <?php foreach ($review_produks as $review_produk) { ?>
                                                            <tr>
                                                                <td class="border-top-0 donatur-program-img" rowspan="2" style="width: 3%;">
                                                                    <a href="<?= \Yii::$app->request->BaseUrl ?>/uploads/default.png" data-lightbox="update">
                                                                        <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->BaseUrl ?>/uploads/default.png" width="75px">
                                                                    </a>
                                                                </td>
                                                                <td class="border-top-0 donatur-program-nama" colspan="2">
                                                                    <?= $review_produk->nama ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-top-0 pt-0 text-isalam-1" colspan="2">
                                                                    <?= $review_produk->rating ?>.0
                                                                    <!-- </td> -->
                                                                    <!-- <td class="border-top-0"> -->

                                                                    <div id="rating" class="rate_display" style="padding-left: 5px;padding-right:5px;">
                                                                        <?php
                                                                        $cfg_min_stars = 1;
                                                                        $cfg_max_stars = 5;
                                                                        $temp_stars = $review_produk->rating;
                                                                        for ($i = $cfg_min_stars; $i <= $cfg_max_stars; $i++) {
                                                                            //echo $temp_stars;
                                                                            if ($temp_stars >= 1) {
                                                                                echo '<label for="star1" title="text" style="color:red">&#11089;</label>';
                                                                                $temp_stars--;
                                                                            } else {
                                                                                echo '<label for="star1" title="text">&#10025;</label>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <?= \app\components\Tanggal::facebook_time_ago($review_produk->created_at); ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="border-top-0 pt-0 text-isalam-1" colspan="3">
                                                                    <?= $review_produk->review ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </thead>
                                                </table>
                                                </p>
                                            <?php }  ?>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 pt-70">
                                            <h5>Tambah Ulasan Produk Ini</h5>
                                            <p class="desc-programs">
                                                <!-- Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. -->
                                            </p>


                                            <form action="<?= \Yii::$app->request->baseUrl . "/home/review/" . $produk->id ?>" method="post" class="footer__newsletter-form d-flex flex-wrap" onsubmit="return confirm('Apakah Anda Sudah Yakin Mengisi Ulasan Produk Ini?');">
                                                <div class="form-row">
                                                    <!-- <input type="text" id="perusahaan" name="perusahaan" class="form-control" placeholder="Perusahaan" style="margin-left:2px;border: 1px solid #343a40;" required>
                  <input type="email" id="email" name="email" class="form-control" placeholder="Email" style="margin-left:2px;border: 1px solid #343a40;" required>
                  <textarea name="pesan" id="pesan" cols="5" rows="5" placeholder="Pesan" class="form-control" style="margin-left:2px;border: 1px solid #343a40;" required></textarea> -->
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-group">


                                                            <label class="text-black" for="nama">Nama</label>
                                                            <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama" aria-required="true" style="border: 2.5px solid #343a40; color: #343a40;max-width: 100%;" required>
                                                            <p class="help-block help-block-error "></p>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-group">


                                                            <label class="text-black" for="email">Email</label>
                                                            <input type="email" id="email" class="form-control" name="email" maxlength="255" placeholder="Email" aria-required="true" style="border: 2.5px solid #343a40; color: #343a40;max-width: 100%;" required>
                                                            <p class="help-block help-block-error "></p>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-12">
                                                        <div class="form-group">


                                                            <label class="text-black" for="review">Review</label>
                                                            <textarea id="review" class="form-control" name="review" rows="12" aria-required="true" placeholder="Review" style="border: 2.5px solid #343a40; color: #343a40;max-width: 100%;" required></textarea>
                                                            <p class="help-block help-block-error "></p>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-12">
                                                        <div class="form-group">


                                                            <label class="text-black" for="review">Rating</label>
                                                            <div id="rating" class="rate">
                                                                <input type="radio" id="star5" name="rate" value="5" required />
                                                                <label for="star5" title="text">&#11089;</label>
                                                                <input type="radio" id="star4" name="rate" value="4" />
                                                                <label for="star4" title="text">&#11089;</label>
                                                                <input type="radio" id="star3" name="rate" value="3" />
                                                                <label for="star3" title="text">&#11089;</label>
                                                                <input type="radio" id="star2" name="rate" value="2" />
                                                                <label for="star2" title="text">&#11089;</label>
                                                                <input type="radio" id="star1" name="rate" value="1" />
                                                                <label for="star1" title="text">&#11089;</label>
                                                            </div>
                                                            <p class="help-block help-block-error "></p>

                                                        </div>
                                                    </div>
                                                    <div class="col-12 text-center">
                                                        <button class="btn btn-danger btn__hover3 mb-20" type="submit"><i class="fa fa-save"></i>
                                                            Simpan</button>
                                                    </div>
                                                    <!-- <textarea type="email" id="email" name="email" class="form-control" placeholder="Email" required> -->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-lg-12">
                                        <div class="product__pagination blog__pagination">
                                            <?php
                                            echo \yii\widgets\LinkPager::widget([
                                                'pagination' => $pagination,
                                            ]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js">
            </script>

            <script>
                console.log('lolll');

                // jQuery(document).ready(function($) {
                function onChangeDropdown() {
                    var size = $('#selectsize').val();
                    var warna = $('#selectwarna').val();
                    // var size = $('select').selectsize('update');
                    // var warna = $('select').selectwarna('update');
                    console.log('aaaaaaaaaaa')
                    if (size && warna) {
                        $.ajax({
                            type: 'POST',
                            url: 'http://localhost:8080/ipi4/web/home/ajax-select-variant',
                            data: {
                                size: '' + size + '',
                                warna: '' + warna + '',
                            },
                            success: function(htmlresponse) {
                                $('#stokones').html(htmlresponse);
                                console.log(htmlresponse);
                            }
                        });
                    }
                }

                function onChangeDropdownHarga() {
                    var size = $('#selectsize').val();
                    var warna = $('#selectwarna').val();
                    var siz = $('#selectsize').val();
                    var war = $('#selectwarna').val();
                    // var size = $('select').selectsize('update');
                    // var warna = $('select').selectwarna('update');
                    console.log('aaaaaaaaaaa')
                    if (size && warna) {
                        $.ajax({
                            type: 'POST',
                            url: 'http://localhost:8080/ipi4/web/home/ajax-select-harga',
                            data: {
                                size: '' + size + '',
                                warna: '' + warna + '',
                            },
                            success: function(htmlresponse) {

                                $('#outputharga').html(htmlresponse);
                                console.log(htmlresponse);
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: 'http://localhost:8080/ipi4/web/home/ajax-select-intharga',
                            data: {
                                siz: '' + siz + '',
                                war: '' + war + '',
                            },
                            success: function(htmlresponse) {

                                $('#outputintharga').html(htmlresponse);
                                console.log(htmlresponse);
                            }
                        });
                    }
                }
                // onChangeDropdown()
                // $("#selectsize").change(() => {
                //     console.log('lolll');
                // });
                // $("#selectwarna").on('change', onChangeDropdown);
                $(document).ready(function() {
                    $('#selectsize').on('change', onChangeDropdown);
                    $('#selectwarna').on('change', onChangeDropdown);
                    $('#selectsize').on('change', onChangeDropdownHarga);
                    $('#selectwarna').on('change', onChangeDropdownHarga);
                })

                //save to keranjang
                document.querySelector("#keranjang").addEventListener("click", () => {
                    var harga = document.querySelector("#outputintharga").textContent;
                    let jumlah = document.querySelector("#jumlah").value;
                    let selectwarna = $('option:selected', '#selectwarna').attr('warnastring');
                    let selectsize = $('option:selected', '#selectsize').attr('sizestring');
                    var stok = document.querySelector("#stokones").textContent;
                    <?php if (Yii::$app->user->identity->id == !null) { ?>
                        if (!(selectwarna == null || selectsize == null)) {
                            console.log(stok);
                            if (!(stok == 0)) {
                                $.ajax({
                                    url: `<?= Url::to(['add-keranjang', 'id' => $produk->id]) ?>?jumlah=${jumlah}&variant2=${selectsize}&variant1=${selectwarna}&harga=${harga}`,
                                    success: (response) => {
                                        swal.fire({
                                                title: "<?= $produk->nama ?>",
                                                text: "Berhasil Ditambahkan Ke Keranjang.",
                                                icon: "success",
                                                showDenyButton: false,
                                                confirmButtonText: "Oke",
                                                denyButtonText: "Batal"

                                            })
                                            .then((willAdd) => {
                                                if (willAdd.isConfirmed) {
                                                    window.location = "<?= Yii::$app->request->baseUrl . "/home/keranjang" ?>";
                                                } else {
                                                    window.location = "<?= Yii::$app->request->baseUrl . "/home/keranjang" ?>";
                                                }
                                            });
                                    }
                                })
                            } else {
                                swal.fire({
                                    title: "Stok Kosong !",
                                    text: "Pilih produk atau variasi lainnya.",
                                    icon: "error",
                                    showDenyButton: false,
                                    confirmButtonText: "Oke",
                                    denyButtonText: "Batal"
                                })
                            }
                        } else {
                            swal.fire({
                                title: "Warna Atau Ukuran Belom Dipilih !",
                                text: "Silahkan Isi Warna Dan Ukuran Terlebih Dahulu.",
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

                });
            </script>

            <script type="text/javascript">
                var global = "Global Variable"; //Define global variable outside of function


                function setGlobal() {
                    global = "Hello World!";
                };
                setGlobal();
                var data = 0;
                var coba;
                theFunction(data);
                var produk = "<?php echo $produk->id; ?>";
                document.querySelector("#bayarkan").addEventListener("click", () => {
                    console.log("test")
                    let nominal = document.querySelector("#nominal").getAttribute("value");
                    // $selectwarna = $('select[name=selectwarna] option').filter(':selected').val()
                    // $selectsize = $('select[name=selectsize] option').filter(':selected').val()
                    // $selectalamat = $('select[name=selectalamat] option').filter(':selected').val()
                    // let ele = document.querySelector("#amanah").getAttribute("value");
                    let ele = document.getElementsByName("amanah");
                    let amanah_pendanaan;
                    for (i = 0; i < ele.length; i++) {

                        if (ele[i].type = "radio") {

                            if (ele[i].checked)
                                amanah_pendanaan = ele[i].value;
                        }
                    }
                    if (nominal == null || nominal == "0" || nominal == 0) {
                        alert("Anda Belum Mengisi Nominal Wakaf");
                    } else if (nominal < 0) {
                        alert("Silahkan Isi Nominal Dengan Benar");
                    } else {
                        if (produk == null) {
                            alert("Pendanaan Tidak Diketahui");
                        } else {
                            if (nominal < 10000) {
                                alert("Minimal Rp 10.000");

                            } else {
                                $.ajax({
                                    url: '<?= Url::to(['home/pembayaran/', 'id' => $produk->id]) ?>',
                                    success: (response) => {
                                        if (response.success) {
                                            window.open(response.url)
                                        }
                                    }
                                })
                            }
                        }
                    }
                });
                document.querySelector("#bayarkan2").addEventListener("click", () => {
                    let nominal2 = document.querySelector("#nominal2").getAttribute("value");
                    let ele2 = document.getElementsByName("amanah2");
                    let amanah_pendanaan2;
                    for (ii = 0; ii < ele2.length; ii++) {

                        if (ele2[ii].type = "radio") {

                            if (ele2[ii].checked)
                                amanah_pendanaan2 = ele2[ii].value;
                        }
                    }
                    if (nominal2 == null) {
                        alert("Anda Belum Mengisi Nominal Wakaf");
                    } else {
                        if (produk == null) {
                            alert("Pendanaan Tidak Diketahui");
                        } else {
                            window.location.href =
                                `<?= Url::to(['/home/pembayaran', 'id' => $pendanaan->id]) ?>?nominal=${nominal2}&amanah_pendanaan=${amanah_pendanaan2}&ket=lembar`;
                        }
                    }
                });

                function theFunction(i) {

                    var rupiah;
                    var php_var = "<?php $php_var; ?>";
                    document.querySelector("#nominal").setAttribute("value", i);
                    var a = document.getElementById("nominal").value = i;
                    let num = 15;
                    let n = num.toString();
                    coba = i;
                    php_var += a;
                    var number_string = i.toString(),
                        sisa = number_string.length % 3,
                        rupiah = number_string.substr(0, sisa),
                        ribuan = number_string.substr(sisa).match(/\d{3}/g);

                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }
                    // var b = document.getElementById("nom").innerHTML = "Rp. " + rupiah;
                    // coba = "Rp. " + rupiah;
                    // var p1 = document.getElementById("nom").value;
                    // console.log(php_var);
                    return i;
                    // console.log(a);
                    // data = a;
                    // return true or false, depending on whether you want to allow the `href` property to follow through or not
                }
                var duit = document.getElementById("nominal");
                duit.addEventListener('keyup', function(e) {
                    // console.log(this.value);
                    duit.setAttribute("value", this.value);
                });
                var duit2 = document.getElementById("nominal2");
                duit2.addEventListener('keyup', function(e) {
                    // console.log(this.value);
                    duit2.setAttribute("value", this.value);
                });

                // console.log(data);
            </script>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-1.jpg">
                        <ul class="product__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-2.jpg">
                        <ul class="product__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-3.jpg">
                        <ul class="product__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="img/product/product-7.jpg">
                        <ul class="product__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Crab Pool Security</a></h6>
                        <h5>$30.00</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Related Product Section End -->
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
            <div class="col-lg-6 col-md-6">
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
                    <div class="product__details__price"><?= \app\components\Angka::toReadableHarga($produk->harga); ?></div>
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

                                        <option class="font-weight-bold" id="selectwarna" value="<?= $getwarna->id ?>" <?php
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
                                        <option class="font-weight-bold" value="<?= $getsize->id ?>" <?php
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
                                <input style="display: -webkit-inline-box;" type="text" value="1">
                            </div>
                        </div>
                    </div>
                    <a href="#" class="primary-btn">Add to Cart</a>
                    <button type="button" class="btn btn-sm btn-program" style="padding: 10px !important;background-color:green" id="keranjang">Keranjang</button>
                    <a href="#" class="btn btn-sm btn-program btn-block" data-toggle="modal" data-target="#mulaiwakaf" style="padding: 10px !important;">bayar </a>
                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                    <ul>
                        <li>

                            <!-- <div id="stokones"> -->
                            <b>Availability</b> <span id="stokones">
                                <?= $stokones ?>
                            </span>
                            <!-- </div> -->
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
                                                        <!-- <div id="rating"class="rate">
    <input type="radio" id="star5" name="rate" value="5" />
    <label for="star5" title="text">5 stars</label>
    <input type="radio" id="star4" name="rate" value="4" />
    <label for="star4" title="text">4 stars</label>
    <input type="radio" id="star3" name="rate" value="3" />
    <label for="star3" title="text">3 stars</label>
    <input type="radio" id="star2" name="rate" value="2" />
    <label for="star2" title="text">2 stars</label>
    <input type="radio" id="star1" name="rate" value="1" />
    <label for="star1" title="text">1 star</label>
            
  </div>      -->
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


<section id="blogSingle" class="blog blog-single pt-50 pb-50">
    <div class="container">
        <div class="program1-wrap">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12" style="padding-right: 7%;">
                    <div class="program1__big-img">
                        <img class="border-r10" alt="program 1" src="<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $produk->foto_banner ?>" style="max-height: 500px;">
                    </div>
                    <div class="program1__img-wrap ">
                        <div class="carousel owl-carousel carousel-arrows" data-slide="3" data-slide-md="2" data-slide-sm="1" data-autoplay="true" data-nav="true" data-dots="false" data-space="20" data-loop="true" data-speed="800">
                            <?php if ($fotos_produk != null) {
                                foreach ($fotos_produk as $foto_produk) {
                            ?>
                                    <div class="fancybox-item">
                                        <div class="fancybox__content">
                                            <div class="col-12 mx-auto">
                                                <div class="service-item">
                                                    <div class="team-img" style="background-image: url('<?= \Yii::$app->request->baseUrl . "/uploads/foto_produk/" . $foto_produk->foto ?>')">
                                                        <a href="<?= \Yii::$app->request->baseUrl . "/uploads/foto_produk/" . $foto_produk->foto ?>" data-lightbox="program">
                                                            <h3 align="center" style="position: absolute;top: 45%;left: 45%;display: block;width: 20px;height: 20px">
                                                                +</h3>
                                                            <!-- <img alt="program Small 1" src="<?= \Yii::$app->request->baseUrl . "/uploads/foto_produk/" . $foto_produk->foto ?>" class="img-project"> -->
                                                        </a>
                                                    </div>
                                                    <div class="service__content">
                                                    </div>
                                                </div><!-- /.service-item -->
                                            </div><!-- /.col-lg-4 -->
                                        </div><!-- /.fancybox-content -->
                                    </div><!-- /.fancybox-item -->
                                    <!-- <div class="program1-img">
                                    <a href="<?= \Yii::$app->request->baseUrl . "/uploads/foto_produk/" . $foto_produk->foto ?>" data-lightbox="program">
                                        <img alt="program Small 1" src="<?= \Yii::$app->request->baseUrl . "/uploads/foto_produk/" . $foto_produk->foto ?>" class="img-project">
                                    </a>
                                </div> -->
                            <?php }
                            } ?>

                        </div>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-6 text-left pt-4 font-weight-bold font-size-08">
                            <p>Product > <?= $produk->kategoriProduk->nama ?></p>
                            <p><?= $round_jml ?>.0&nbsp;&nbsp;
                                <!-- &#11088;&#11088;&#11088;&#11088;&#11088; -->
                                <?php
                                $cfg_min_stars = 1;
                                $cfg_max_stars = 5;
                                $temp_stars = $round_jml;
                                if ($round_jml == 0) {

                                    for ($i = $cfg_min_stars; $i <= $cfg_max_stars; $i++) {
                                        echo '<label for="star1" style="font-size:20px;" title="text">&#9734;</label>';
                                    }
                                } else {
                                    for ($i = $cfg_min_stars; $i <= $cfg_max_stars; $i++) {
                                        //echo $temp_stars;
                                        if ($temp_stars >= 1) {
                                            echo '<label for="star1" style="font-size:18px;" title="text">&#11088;</label>';
                                            $temp_stars--;
                                        } else {
                                            echo '<label for="star1" style="font-size:20px;" title="text">&#9734;</label>';
                                        }
                                    }
                                }
                                ?>
                                &nbsp;&nbsp;Review(<?= $count_review ?>)
                            </p>
                        </div>
                    </div>
                    <div class="program__text">
                        <h3 class="font-weight-bold text-detail-program"><?= $produk->nama ?></h3>
                        <h4><?= \app\components\Angka::toReadableHarga($produk->harga); ?></h4>
                        <div class="table-responsive d-none d-lg-block">

                        </div>

                    </div>
                    <div class="program__info">
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12 text-left font-weight-bold font-size-08">
                                <h6>Deskripsi Produk</h6>
                                <p><?= $produk->deskripsi_singkat ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-6 text-left font-weight-bold progress-dana pb-2">
                                <!-- <?= \app\components\Angka::toReadableHarga($dana); ?><br> -->
                            </div>
                            <div class="col-lg-4 col-md-6 col-6 text-right font-weight-bold progress-dana pb-2">
                                <!-- <?= \app\components\Angka::toReadableHarga($pendanaan->nominal); ?> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8 col-md-8 col-lg-8">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="div">
                                            <select class="form-control" id="selectwarna" name="selectwarna" style=" height: 40px; ">
                                                <option class="font-weight-bold " style="margin: 50%;" value="<?= \Yii::$app->request->baseUrl ?>">
                                                    pilih warna</option>
                                                <?php
                                                foreach ($getwarnas as $getwarna) {
                                                ?>

                                                    <option class="font-weight-bold" id="selectwarna" value="<?= $getwarna->id ?>" <?php
                                                                                                                                    if ($_GET['warna'] == $getwarna->value) {
                                                                                                                                        echo "selected";
                                                                                                                                    }
                                                                                                                                    ?>>
                                                        <?= $getwarna->value ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="div">
                                            <select class="form-control" id="selectsize" name="selectsize" style=" height: 40px; ">
                                                <option class="font-weight-bold " style="margin: 10%;" value="<?= \Yii::$app->request->baseUrl ?>">
                                                    Pilih Size</option>
                                                <?php
                                                foreach ($getsizes as $getsize) {  ?>
                                                    <option class="font-weight-bold" value="<?= $getsize->id ?>" <?php
                                                                                                                    if ($_GET['size'] == $getsize->value) {
                                                                                                                        echo "selected";
                                                                                                                    }
                                                                                                                    ?>>
                                                        <?= $getsize->value ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <?php {
                                ?>
                                    <div id="stokones" style="text-align: right; padding-top:1%">
                                        Stok = <?= $stokones ?>
                                    </div>
                                <?php } ?>
                                <div class="m-b-10 col-12 row p-lr-0 m-lr-0 align-items-center">
                                    <div class="product__details__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input id="jumlah" name="jumlah" style="display: -webkit-inline-box;" type="text" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="stokrefresh" class="col-6 p-lr-20"></div>
                                </div>

                            </div>
                            <!-- <div class="input-group mb-2">
                                <div class="input-group-prepend mr-2" style="height:calc(1.5em + .75rem + 2px);">
                                    <div class="input-group-text bg-white border-r5 font-weight-bold" style="color: #afafaf;border-color: #787878;">Rp</div>
                                </div>
                                <input type="number" class="form-control select-wakaf" id="nominal" name="nominal" onkeyup="myFunction()" onkeydown="myFunction()" style="border-color: #787878;" placeholder="Minimal Wakaf Rp. 10.000" required>
                                <button id="clear" class="btn btn-danger btn-sm" type="button" style="height: calc(1.5em + 0.75rem + 2px);
                          line-height: 34px;
                          width: 60px;background-color:firebrick;color:white;border-radius:0px;">
                                    X</button>
                            </div> -->
                            <div class="col-sm-4 col-md-4 col-lg-4">
                            </div>
                        </div>
                        <!-- <br> -->
                        <!-- <div class="row">
                            <div class="col-sm-8 col-md-8 col-lg-8">
                                <a href="#" class="btn btn-sm btn-program btn-block" data-toggle="modal" data-target="#mulaiwakaf" style="padding: 10px !important;">Mulai Wakaf</a>
                                <a href="<?= $url_wa ?>" class="btn btn-sm btn-program btn-block" style="padding: 10px !important;" target="_blank">Hubungi Penjual Lewat
                                    WhatsApp</a>
                            </div>
                        </div>
                        <br> -->
                        <div class="row">
                            <div class="col-sm-8 col-md-8 col-lg-8">
                                <!-- <a href="<?= Url::to(["keranjang"]) ?>" id="keranjang" class="btn btn-sm btn-program btn-block" style="padding: 10px !important;">Tambahkan ke keranjang </a> -->
                                <!-- <a href="#" class="btn btn-sm btn-program btn-block" data-toggle="modal" data-target="#mulaiwakaf" style="padding: 10px !important;">bayar </a> -->
                                <!-- <button type="button" class="btn btn-sm btn-program" style="padding: 10px !important;background-color:green" id="keranjang">Keranjang</button> -->
                            </div>
                        </div>
                        <!-- End program Info -->
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
                // onChangeDropdown()
                // $("#selectsize").change(() => {
                //     console.log('lolll');
                // });
                // $("#selectwarna").on('change', onChangeDropdown);
                $(document).ready(function() {
                    $('#selectsize').on('change', onChangeDropdown);
                    $('#selectwarna').on('change', onChangeDropdown);
                })

                //save to keranjang
                document.querySelector("#keranjang").addEventListener("click", () => {
                    let jumlah = document.querySelector("#jumlah").value;
                    let selectsize = document.querySelector("#selectsize").value;
                    let selectwarna = document.querySelector("#selectwarna").value;

                    // console.log(jumlah)
                    // return;
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
                    $.ajax({
                        url: `<?= Url::to(['add-keranjang', 'id' => $produk->id]) ?>?jumlah=${jumlah}&selectsize=${selectsize}&selectwarna=${selectwarna}`,
                        success: (response) => {
                            alert("Sukses menambahkan keranjang");
                            window.location = "<?= Yii::$app->request->baseUrl . "/home/keranjang" ?>";
                            // console.log(response);
                            // if (response.success) {
                            //     window.open(response.url)
                            // }
                        }
                    })
                });
            </script>
            <!-- Modal -->
            <div class="modal fade" id="mulaiwakaf" tabindex="-1" role="dialog" aria-labelledby="mulaiwakaf" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mulaiwakaf">Ikatan Pesantren Indonesia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs pb-4" id="isalam" role="tablist">
                                <li class="nav-item text-center" style="width: 100%;">
                                    <a class="nav-link font-weight-bold active" id="Wakaf-tab" data-toggle="tab" href="#pembayaran" role="tab" aria-controls="pembayaran" aria-selected="true"><i class="fas fa-hand-holding-usd"></i> Payment </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="pembayaran" role="tabpanel" aria-labelledby="pembayaran-tab">
                                    <div class="row">
                                        <div class="col-4">
                                            <!-- <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->BaseUrl ?>/uploads/detail-program.jpeg" width="200px"> -->
                                            <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $produk->foto_banner ?>" width="150px" height="140px">
                                        </div>
                                        <div class="col-8 ">
                                            <h5 style="color: #404040;"><?= $produk->nama ?></h5>
                                            <div class="row">
                                                <div class="col-4" style="  color: red;text-decoration: line-through; ">
                                                    Rp. 1.000.000
                                                </div>
                                                <div class="div">
                                                    <select class="form-control" id="selectwarna" name="selectwarna" style=" height: 50px; ">
                                                        <option class="font-weight-bold " style="margin: 50%;" value="<?= \Yii::$app->request->baseUrl ?>">
                                                            pilih warna</option>
                                                        <?php
                                                        foreach ($getwarnas as $getwarna) {
                                                        ?>

                                                            <option class="font-weight-bold" value="<?= $getwarna->id ?>" <?php
                                                                                                                            if ($_GET['warna'] == $getwarna->value) {
                                                                                                                                echo "selected";
                                                                                                                            }
                                                                                                                            ?>>
                                                                <?= $getwarna->value ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-7 pr-4" style="  text-align: end; color: green; font-weight: bold; ">
                                                    <?= \app\components\Angka::toReadableHarga($produk->harga); ?>
                                                    <div class="stok pt-2 " style=" color: grey; font-weight: normal; ">

                                                    </div>
                                                    <div class="div">
                                                        <select class="form-control" id="selectsize" name="selectsize" style=" height: 50px; ">
                                                            <option class="font-weight-bold " style="margin: 50%;" value="<?= \Yii::$app->request->baseUrl ?>">
                                                                Pilih Size</option>
                                                            <?php
                                                            foreach ($getsizes as $getsize) {  ?>
                                                                <option class="font-weight-bold" value="<?= $getsize->id ?>" <?php
                                                                                                                                if ($_GET['size'] == $getsize->value) {
                                                                                                                                    echo "selected";
                                                                                                                                }
                                                                                                                                ?>>
                                                                    <?= $getsize->value ?></option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>
                                                    <?php {
                                                    ?>
                                                        <div id="stokones">
                                                            <?= $stokones ?>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="card-action">
                                                        <button class="btn">+</button>
                                                        <input type="text" id="counter" class="counter" value="1">
                                                        <button class="btn">-</button>
                                                    </div>
                                                    <div class="col-12 p-lr-0">
                                                        Jumlah
                                                    </div>
                                                    <div class="m-b-10 col-12 row p-lr-0 m-lr-0 align-items-center">
                                                        <div id="stokrefresh" class="col-6 p-lr-20"></div>
                                                    </div>
                                                    <div class="div">
                                                        <select class="form-control" id="select-alamat" style=" height: 50px; ">
                                                            <option class="font-weight-bold " style="margin: 50%;" value="<?= \Yii::$app->request->baseUrl ?>">
                                                                alamat pengiriman</option>
                                                            <?php
                                                            foreach ($alamats as $alamat) {  ?>
                                                                <option class="font-weight-bold" value="<?= \Yii::$app->request->baseUrl . $alamat->alamat ?>" <?php
                                                                                                                                                                if ($_GET['alamat'] == $alamat->alamat) {
                                                                                                                                                                    echo "selected";
                                                                                                                                                                }
                                                                                                                                                                ?>>
                                                                    <?= $alamat->alamat ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="stok pt-2 " style=" color: grey; font-weight: normal; ">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-3">
                                            <div class="col-12 mt-2">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend mr-2" style="height:calc(1.5em + .75rem + 2px);">
                                                        <div class="input-group-text bg-white border-r5 font-weight-bold" style="color: #afafaf;border-color: #787878;">Rp</div>
                                                    </div>
                                                    <input type="number" class="form-control select-wakaf" id="nominal" name="nominal" onkeyup="myFunction()" onkeydown="myFunction()" style="border-color: #787878;" placeholder="Minimal Wakaf Rp. 10.000" required>
                                                    <button id="clear" class="btn btn-danger btn-sm" type="button" style="height: calc(1.5em + 0.75rem + 2px);
                          line-height: 34px;
                          width: 60px;background-color:firebrick;color:white;border-radius:0px;">
                                                        X</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function myFunction() {
                                        let x = document.getElementById("nominal");
                                        x.value = x.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
                                    }
                                    let hasils = document.querySelector('#nominal');
                                    window.addEventListener('load', () => {
                                        const button = document.querySelector('#clear');
                                        button.addEventListener('click', () => {

                                            hasils.setAttribute("value", 0);
                                            hasils.value = "";
                                        });
                                    });
                                </script>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-batal" style="background-color:firebrick;color:white" data-dismiss="modal">Batal</button>
                                    <!-- <button type="button" class="btn btn-sm btn-program" data-toggle="modal" data-target="#exampleModalScrollable" id="bayarkan">Bayar</button> -->
                                    <button type="button" class="btn btn-sm btn-program" style="padding: 10px !important;background-color:green" id="bayarkan">Bayar</button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="lembaran" role="tabpanel" aria-labelledby="lembaran-tab">
                                <div class="row">
                                    <div class="col-6">
                                        <!-- <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->BaseUrl ?>/uploads/detail-program.jpeg" width="200px"> -->
                                        <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->baseUrl . "/uploads/" . $pendanaan->poster ?>" width="150px" height="150px">
                                    </div>
                                    <div class="col-6">
                                        <p class="font-size-08">Anda akan berwakaf untuk project :</p>
                                        <p class="font-weight-bold"><?= $pendanaan->nama_pendanaan ?></p>
                                    </div>
                                    <div class="col-12 pt-3">
                                        <h3 style="color: #404040;">Lembar Wakaf</h3>
                                        <p class="font-size-08">Beban Biaya Setiap Transaksi :</p>
                                        <table style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 50%;">
                                                        <p class="font-size-08">Bank Transfer :
                                                            <?php $hrg = 4000;
                                                            echo Angka::toReadableHarga($hrg, false) ?></p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <?php

                                        if ($pendanaan->kategori_pendanaan_id == 5) {
                                        ?>
                                            <p class="font-size-08">Amanah Wakaf :</p>
                                            <div class="row">
                                                <?php $i = 0;
                                                foreach ($amanah_pendanaan as $value) { ?>
                                                    <div class="col-6">
                                                        <input type="radio" id="amanah2" name="amanah2" value="<?= $value->amanah ?>" <?= $i == 0 ? "checked" : "" ?>>
                                                        <label for="amanah2"><?= $value->amanah ?></label><br>
                                                    </div>
                                                <?php $i++;
                                                } ?>
                                            </div>
                                        <?php } else { ?>
                                            <input type="hidden" id="amanah2" name="amanah2" value="undefined">
                                        <?php } ?>
                                        <p class="font-size-08">Anda akan berwakaf dengan nominal sebesar
                                            :<br />*Perlembar
                                            <?= \app\components\Angka::toReadableHarga($pendanaan->nominal_lembaran); ?>
                                        </p>
                                        <div class="row">

                                            <div class="col-12 mt-2">
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend mr-2" style="height:calc(1.5em + .75rem + 2px);">
                                                        <div class="input-group-text bg-white border-r5 font-weight-bold" style="color: #afafaf;border-color: #787878;">Lembar
                                                        </div>
                                                    </div>
                                                    <input type="number" class="form-control select-wakaf" id="nominal2" name="nominal2" style="border-color: #787878;" placeholder="Minimal Wakaf 1 Lembar" required>
                                                    <button id="clear2" class="btn btn-danger btn-sm" type="button" style="height: calc(1.5em + 0.75rem + 2px);
                          line-height: 34px;
                          width: 60px;background-color:firebrick;color:white;border-radius:0px;">
                                                        X</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-batal" style="background-color:firebrick;color:white" data-dismiss="modal">Batal</button>
                                    <!-- <button type="button" class="btn btn-sm btn-program" data-toggle="modal" data-target="#exampleModalScrollable" id="bayarkan">Bayar</button> -->
                                    <button type="button" class="btn btn-sm btn-program" style="padding: 10px !important;background-color:green" id="bayarkan2">Bayar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        let hasils2 = document.querySelector('#nominal2');
                        window.addEventListener('load', () => {
                            const button = document.querySelector('#clear2');
                            button.addEventListener('click', () => {

                                hasils2.setAttribute("value", 0);
                                hasils2.value = "";
                            });
                        });
                    </script>
                </div>
            </div>
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


        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 pt-60">
                <div class="header-panel-wrap">
                    <ul class="nav nav-tabs pb-0 border-d-program" id="isalam" role="tablist">
                        <li class="nav-item text-center">
                            <a class="nav-link font-weight-bold font-size-1 font-grey-78 active" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="home" aria-selected="true">Deskripsi</a>
                        </li>
                        <li class="nav-item text-center">
                            <a class="nav-link font-weight-bold font-size-1 font-grey-78" id="uptade-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">Review(<?= $count_review ?>)</a>
                        </li>
                        <!-- <li class="nav-item text-center">
              <a class="nav-link font-weight-bold font-size-1 font-grey-78" id="donatur-tab" data-toggle="tab" href="#donatur" role="tab" aria-controls="donatur" aria-selected="false">Donatur</a>
            </li> -->
                    </ul>
                    <div class="tab-content pt-4" id="myTabContent">
                        <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                            <p class="desc-program">
                                <?= $produk->deksripsi_lengkap ?>
                            </p>
                        </div>
                        <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
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
                            <div class="d-flex justify-content-center">
                                <?php
                                echo \yii\widgets\LinkPager::widget([
                                    'pagination' => $pagination,
                                ]);
                                ?>
                            </div>
                            <!-- <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->BaseUrl ?>/uploads/azhar.jpg"> -->

                        </div>
                        <!-- <div class="tab-pane fade" id="donatur" role="tabpanel" aria-labelledby="donatur-tab">
              <div class="table-responsive">
                  <p class="update-program">
                    Belum Ada Donatur untuk Program Wakaf Ini.
                  </p>
                
              </div>
            </div> -->
                    </div>
                </div>
            </div><!-- /.col-lg-12 -->

            <!-- <div class="col-lg-1 col-md-1 col-sm-12 pt-60" style="border-right: 3px solid black;">
      </div> -->
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
                                <!-- <div id="rating"class="rate">
    <input type="radio" id="star5" name="rate" value="5" />
    <label for="star5" title="text">5 stars</label>
    <input type="radio" id="star4" name="rate" value="4" />
    <label for="star4" title="text">4 stars</label>
    <input type="radio" id="star3" name="rate" value="3" />
    <label for="star3" title="text">3 stars</label>
    <input type="radio" id="star2" name="rate" value="2" />
    <label for="star2" title="text">2 stars</label>
    <input type="radio" id="star1" name="rate" value="1" />
    <label for="star1" title="text">1 star</label>
            
  </div>      -->
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
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.blog Single -->
<!-- <script>
    jQuery(document).ready(function($) {
        $("#selectsize").on('change', function() {
            var level = $(this).val();
            if (level) {
                $.ajax({
                    type: 'POST',
                    url: 'http://localhost:8080/ipi4/web/home/AjaxSelect',
                    data: {
                        hps_level: '' + level + ''
                    },
                    success: function(htmlresponse) {
                        $('#stokones').html(htmlresponse);
                        console.log(htmlresponse);
                    }
                });
            }
        });
    });
</script> -->
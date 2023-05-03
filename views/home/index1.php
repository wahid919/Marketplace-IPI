<?php

use app\models\Berita;
use richardfan\widget\JSRegister;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<style>
    #grad1 {
        height: 270px;
    }

    @media screen and (min-width: 1200px) {

        #grad1 {
            height: 375px;
        }

        .card {
            height: 429.69px;
        }
    }

    @media screen and (max-width: 540px) {

        .slide__content {
            margin-top: 4%;
        }
    }

    .img-fluid {
        -moz-box-shadow: 10px 10px 5px #ccc;
        -webkit-box-shadow: 10px 10px 5px #ccc;
        box-shadow: 10px 10px 5px #ccc;
        -moz-border-radius: 25px;
        -webkit-border-radius: 25px;
        border-radius: 25px;
    }

    .card_beritas {
        box-shadow: 0 0 3px 0px #dedede;
    }

    .gmbr {
        background-size: cover;
        height: 175px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-top: 10%;
        width: 60%;
        border-radius: 10%;
    }
</style>
<?php /*
<section id="slider3" class="slider slider-3">
  <div class="carousel owl-carousel carousel-arrows carousel-dots" data-slide="1" data-slide-md="1" data-slide-sm="1" data-autoplay="true" data-nav="true" data-dots="false" data-space="0" data-loop="true" data-speed="3000" data-transition="fade" data-animate-out="fadeOut" data-animate-in="fadeIn">
    <?php foreach($slider as $slides){ ?>
<div class="slide-item align-v-h bg-overlay">
    <!-- <div class="bg-img"><img src="assets/images/sliders/3.jpg" alt="slide img"></div> -->
    <div class="bg-img"><img src="<?= Yii::$app->request->baseUrl . '/uploads/slides/' . $slides->gambar ?>"
            alt="background"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-6">
                <div class="slide__content">
                    <h2 class="slide__title">Affordable Price, Certified experts &</h2>
                    <p class="slide__desc">Through integrated supply chain solutions, our drives sustainable competitive
                        advantages to some of the largest companies allover the world.</p>
                    <a href="#" class="btn btn__white mr-30">Get Started</a>
                    <a href="#" class="btn btn__primary btn__hover2">Our Services</a>
                </div><!-- /.slide-content -->
            </div><!-- /.col-xl-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.slide-item -->
<?php } ?>
</div><!-- /.carousel -->
</section><!-- /.slider -->
*/ ?>

<section id="slider1" class="slider slider-1">
    <div class="owl-carousel thumbs-carousel carousel-arrows" data-slider-id="slider1" data-dots="false" data-autoplay="true" data-nav="true" data-transition="fade" data-animate-out="fadeOut" data-animate-in="fadeIn">
        <?php foreach ($slider as $slides) { ?>
            <div class="slide-item align-v-h bg-overlay">
                <div class="bg-img" style="linear-gradient(to left, rgba(245, 246, 252, 0.52), rgba(159, 8, 7,1));"><img src="<?= Yii::$app->request->baseUrl . '/uploads/slides/' . $slides->gambar ?>" alt="slide img">
                </div>
                <div class="container">
                    <div class="row">
                        <?php if ($slides->loc_text == "left") { ?>
                            <div class="col-sm-12 col-md-12 col-lg-8">
                                <div class="slide__content">
                                    <h2 class="slide__title"><?= $slides->judul ?></h2>
                                    <p class="slide__desc"><?= $slides->sub_judul ?></p>
                                </div><!-- /.slide-content -->
                            </div><!-- /.col-lg-8 -->
                        <?php } elseif ($slides->loc_text == "right") { ?>
                            <div class="col-sm-12 col-md-12 col-lg-4">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-8" style="text-align: right;">
                                <div class="slide__content">
                                    <h2 class="slide__title"><?= $slides->judul ?></h2>
                                    <p class="slide__desc"><?= $slides->sub_judul ?></p>
                                </div><!-- /.slide-content -->
                            </div><!-- /.col-lg-8 -->
                        <?php } elseif ($slides->loc_text == "center") { ?>
                            <div class="col-sm-12 col-md-12 col-lg-2">
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-8" style="text-align: center;">
                                <div class="slide__content">
                                    <h2 class="slide__title"><?= $slides->judul ?></h2>
                                    <p class="slide__desc"><?= $slides->sub_judul ?></p>
                                </div><!-- /.slide-content -->
                            </div><!-- /.col-lg-8 -->
                            <div class="col-sm-12 col-md-12 col-lg-2">
                            </div>
                        <?php } ?>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.slide-item -->
        <?php } ?>



    </div><!-- /.carousel -->

</section><!-- /.slider -->
<section id="about2" class="about about-2" style="margin-bottom: 5%;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-9 col-lg-6 pt-60">
                <div class="about__img">
                    <div class="counter-item-wrapper">
                        <!-- <div class="counter-item">
                  <div class="counter__icon">
                    <i class="icon-box"></i>
                  </div>
                  <h4><span class="counter">6,1541</span></h4>
                  <p class="counter__desc">Delivered Goods</p>
                </div> -->
                    </div><!-- /.counter-item-wrapper-->
                    <img src="<?= Yii::$app->request->baseUrl . '/uploads/slides/' . $slides->gambar ?>" alt="about img" class="img-fluid" style="border-radius: 20px;max-width:83%;">
                    <!-- <div id="grad1" style="margin: auto;"></div> -->
                </div><!-- /.about-img -->
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="heading heading-3 mb-20 pt-60">
                    <h2 class="heading__title">About Us</h2>
                    <p style="color: #121c45;font-weight:550"><?= $setting->getDescription() ?></p>
                </div><!-- /.heading -->
                <!-- <a href="#" class="btn btn__primary mr-30 mb-20"></a> -->

                <a href="<?= Url::to(['home/about']) ?>">
                    <button class="btn btn__primary btn__hover3 mb-20" style="background-color: #cb1d08;border-radius:10px;border:#cb1d08">Selengkapnya</button>
                    <a href="#" class="btn btn__secondary btn__link btn__underlined mb-20"></a>
            </div><!-- /.col-lg-6 -->
            </a>

        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.About 2 -->
<hr style="width:50%; margin-left:25% !important; margin-right:25% !important;border:1px solid #cb1d08;" />
<!-- <hr style="width:50%;text-align:center;color:#cb1d08;"> -->

<div class="container text-center pt-20 pb-20">
    <h2>Pendaftaran Merek & Unit Usaha</h2>
    <p>Daftarkan Merek atar unit saha UMKM anda untuk mempermudah promosi Produk anda</p>
    <div class="row mt-2">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 mt-3">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 mt-3">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 mt-3">
        </div>
        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 mt-3">
            <div class="card h-100 card_berita">
                <div class="card-body">
                    <center>

                        <div class="card pb-50" style="background-color: #f6d8d5;width:3.6rem;height:3.6rem;">
                            <div class="card-body">
                                <i class="fa fa-book fa-2x" style="color:red;margin-top:-1rem;margin-right:1.5rem;" aria-hidden="true"></i>
                            </div>
                        </div>
                    </center>
                    <h6 class="card-title" style="margin-top:1rem">Daftar Merek Produk UMKM</h6>
                    <div class="content-berita__info pt-20">
                        <button class="btn btn__primary btn__hover3 mb-20" style="width:6rem;height:2.8rem;background-color: #cb1d08;border-radius:10px;border:#cb1d08">Daftar</button>
                    </div>
                </div>
            </div>
            <!-- </a> -->
        </div>
        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 mt-3">
            <div class="card h-100 card_berita">
                <div class="card-body">
                    <center>

                        <div class="card pb-50" style="background-color: #f6d8d5;width:3.6rem;height:3.6rem;">
                            <div class="card-body">
                                <i class="fa fa-book fa-2x" style="color:red;margin-top:-1rem;margin-right:1.5rem;" aria-hidden="true"></i>
                            </div>
                        </div>
                    </center>
                    <h6 class="card-title" style="margin-top:1rem">Daftar Halal Produk UMKM</h6>
                    <div class="content-berita__info pt-20">

                        <button class="btn btn__primary btn__hover3 mb-20" style="width:6rem;height:2.8rem;background-color: #cb1d08;border-radius:10px;border:#cb1d08">Daftar</button>
                    </div>
                </div>
            </div>
            <!-- </a> -->
        </div>
        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 mt-3">
            <div class="card h-100 card_berita">
                <div class="card-body">
                    <center>

                        <div class="card pb-50" style="background-color: #f6d8d5;width:3.6rem;height:3.6rem;">
                            <div class="card-body">
                                <i class="fa fa-book fa-2x" style="color:red;margin-top:-1rem;margin-right:1.5rem;" aria-hidden="true"></i>
                            </div>
                        </div>
                    </center>
                    <h6 class="card-title" style="margin-top:1rem">Daftar Nib Produk UMKM</h6>
                    <div class="content-berita__info pt-20">
                        <button class="btn btn__primary btn__hover3 mb-20" style="width:6rem;height:2.8rem;background-color: #cb1d08;border-radius:10px;border:#cb1d08">Daftar</button>
                    </div>
                </div>
            </div>
            <!-- </a> -->
        </div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 mt-3">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 mt-3">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 mt-3">
        </div>
    </div>

    <!-- <section class="fancybox-layout4 pt-4 mt-4" style="padding-bottom:1rem">
        <div class="col-12">
          <div class="team-img bg-banner" style="background-image: url(<?= $bg_login ?>);">
            <div class="overlay-banner text-right p-5">
              <div class="row">
                <div class="col-4"></div>
                <div class="col-8 col-8 mt-5 mb-5 pr-1">
                  <p class="text-white text-banner">Mari Semarakkan Gerakan Wakaf Nasional Untuk Indonesia Lebih Baik </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> -->
</div>
<!-- <section id="slider1" class="slider slider-1"> -->

<div class="mt-4 mb-4 pt-60">
    <div class="container mt-4 mb-4">
        <div class="slide-item align-v-h">
            <div class="container">
                <div class="row" style="margin-top: -1rem;">
                    <div class="col-sm-12 col-md-12 col-lg-3 pb-20">
                        <div class="slide__content">
                            <div class="card" style="border-radius: 10px;">
                                <div class="card-body" style="background-color: #cb1d08;color:white;border-radius:10px;border:#cb1d08">

                                    <!-- <p style="padding-top: 10px;">Penawaran Promo Terbaik</p> -->
                                    <h3 style="padding-top: 30px;color:white;">Penawaran Promo Terbaik</h3>
                                    <p>Segera dapatkan Produk UMKM berkualitas dengan berbagai promo menarik</p>

                                </div>
                            </div>
                        </div><!-- /.slide-content -->
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-9 pt-10 nilai">
                        <h3>Daftar Penawaran Produk</h3>
                        <div class="row">


                            <?php foreach ($produks as $data) { ?>
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mt-3">
                                    <!-- <div class="card h-100 card_berita"> -->
                                    <div class="card h-100 card_beritas" align="center" style="background-color: #fafafa;border-bottom-left-radius:10px 10px;border-bottom-right-radius:10px 10px;">
                                        <div style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $data->foto_banner ?>);background-size: cover;height: 200px;">

                                        </div>
                                        <!-- <div class="card h-100 card_berita" align="center" style="background-color: #fafafa;"> -->
                                        <div class="card-body">
                                            <h6 class="card-title"><?= $data->nama ?></h6>
                                            <div class="content-berita__info">

                                            </div>
                                            <h6 class="card-title" style="color: red;" :hover="color: red">
                                                <?= \app\components\Angka::toReadableHarga($data->harga); ?>
                                            </h6>
                                            <a href="<?= Url::to(["detail-produk", "id" => $data->id]) ?>">
                                                <button class="btn btn__primary btn__hover3 mb-20" style="background-color: #cb1d08;border-radius:10px;border:#cb1d08">Beli
                                                    Sekarang</button>
                                            </a>
                                        </div>
                                        <!-- </div> -->

                                    </div>

                                    <!-- </a> -->
                                </div>
                            <?php } ?>
                        </div>

                        <!-- <div class="col-sm-12 col-md-12 col-lg-4">
              </div> -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.slide-item -->
        </div>
    </div>



</div><!-- /.carousel -->

<div class="mt-4 mb-4 pt-20 pb-20">
    <div class="container mt-4 mb-4">
        <div class="slide-item align-v-h">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-lg-6">

                                <h2 class="text-left font-weight-bold" style="color:#08150a">Produk Unggulan Kami</h2>
                            </div>
                            <div class="col-lg-3"></div>
                            <div class="col-lg-3" align="right">
                                <a href="<?= Yii::$app->request->baseUrl . "/home/list-produk" ?>" style="color: #cb1d08;">
                                    Lihat Semua
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <?php foreach ($produk as $data) { ?>


                                <div class="col-lg-3 col-md-3 mt-3">
                                    <!-- <div class="card h-100 card_berita"> -->
                                    <div class="card h-100 card_beritas" align="center">
                                        <div class="gmbr" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $data->foto_banner ?>);">

                                        </div>
                                        <!-- <div class="card h-100 card_berita" align="center" style="background-color: #fafafa;"> -->
                                        <div class="card-body">
                                            <h6 class="card-title"><?= $data->nama ?></h6>
                                            <div class="content-berita__info">

                                            </div>
                                            <h6 class="card-title" style="color: red;" :hover="color: red">
                                                <?= \app\components\Angka::toReadableHarga($data->harga); ?>
                                            </h6>
                                            <a href="<?= Url::to(["detail-produk", "id" => $data->id]) ?>">
                                                <button class="btn btn__primary btn__hover3 mb-20" style="background-color: #cb1d08;border-radius:10px;border:#cb1d08">Beli
                                                    Sekarang</button>
                                            </a>
                                        </div>
                                        <!-- </div> -->

                                    </div>

                                    <!-- </a> -->
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div><!-- /. -->
            </div><!-- /.slide-item -->
        </div>
    </div>



</div><!-- /.carousel -->
<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Berita;
use app\models\Produk;
use yii\db\Expression;
use yii\data\Pagination;
use app\models\ProdukSize;
use app\models\ProductDetail;
use yii\bootstrap\ActiveForm;
use app\models\KategoriProduk;
use richardfan\widget\JSRegister;
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

    .harga {
        pointer-events: none;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: black;
        background-color: white;
    }

    .featured__controls ul li:after {
        position: absolute;
        left: 0;
        bottom: 4px;
        width: 100%;
        height: 2px;
        background: #7fad39;
        content: "";
        opacity: 0;
    }

    .no h5:hover {
        color: #1c1c1c;
    }
</style>
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Semua Kategori</span>
                    </div>
                    <?php
                    foreach ($kategoris as $kategori) { ?>
                        <ul>
                            <li><a href="<?= \Yii::$app->request->baseUrl . "/home/produk?kategori=" . $kategori->nama ?>"> <?= $kategori->nama ?></a></li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                Lets
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text no">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
                <div class="hero__item set-bg" data-setbg="<?= Yii::$app->request->baseUrl . '/uploads/slides/' . $slides->gambar ?>" style="box-shadow: 10px 10px 5px #ccc;
    border-radius: 20px;    background-repeat: no-repeat;
    background-position: center;">
                    <div class="hero__text">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <!--  -->
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php
                foreach ($kategoris as $kategori) { ?>
                    <div class="col-lg-3">
                        <div class="categories__item" style=" background-color: #f3f6fb;">
                            <img class="center" style="min-width: 70%;
                padding: 5%;
                display: block;
                margin: auto;
                min-height: 76px;
                max-width: 76px;
                " src="<?= \Yii::$app->formatter->asMyImage("icon2/$kategori->icon2", false, "logo.png;") ?>">
                            <h5><a href="<?= \Yii::$app->request->baseUrl . "/home/produk?kategori=" . $kategori->nama ?>"> <?= $kategori->nama ?></a></h5>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!--  -->
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Produk Unggulan</h2>
                </div>
                <div class="text__block-3">
                    <div class="featured__controls" style="margin-right: 0px;" align="center">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="background-color: none; margin-right: 0px">
                            <li class="active" data-filter="#all">
                                <h6 style="background-color: none" class="nav-link" id="pills-<?= $data->id ?>-tab" data-toggle="pill" href="#pills-<?= $data->id ?>" role="tab" aria-controls="pills-<?= $data->id ?>" aria-selected="true">
                                    All
                                </h6>
                            </li>
                            <?php foreach ($kategoris as $data) {
                            ?>
                                <li class="nav-item" style="margin-right: none" data-filter="#prous">
                                    <h6 style="background-color: none" class="nav-link" id="pills-<?= $data->id ?>-tab" data-toggle="pill" href="#pills-<?= $data->id ?>" role="tab" aria-controls="pills-<?= $data->id ?>" aria-selected="true">
                                        <?= $data->nama; ?>
                                    </h6>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="row featured__filter">
                    <?php

                    foreach ($produk as $page) {
                        $minimumprice = ProductDetail::find()->where(['id_product' => $page->id])->min('harga');
                        $maximumprice = ProductDetail::find()->where(['id_product' => $page->id])->max('harga');
                        $averageprice = ProductDetail::find()->where(['id_product' => $page->id])->average('harga');
                    ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mix" id=all>
                            <div class="featured__item">
                                <div class="featured__item__pic" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $page->foto_banner ?>);    border-radius: 5%;background-position: center;background-repeat: no-repeat;background-size: cover;box-shadow: rgb(204 204 204) 12px 12px 9px;">
                                    <ul class="featured__item__pic__hover">
                                        <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                                        <li><a href="<?= Url::to(["detail-produk", "id" => $page->id]) ?>"><i class="fa fa-eye"></i></a></li>
                                        <!-- <a href="<?= Url::to(['add-keranjang', 'id' => $produk->id]) ?>?jumlah=<?= $jumlah ?>&variant2=<?= $selectsize ?>&variant1=<?= $selectwarna ?>&harga=<?= $harga ?>"><i class="fa fa-shopping-cart"></i></a> -->
                                        <li><a href="<?= Url::to(['add-keranjang', 'id' => $produk->id]) ?>?jumlah=${jumlah}&variant2=${selectsize}&variant1=${selectwarna}&harga=${harga}"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="#"><?= $page->nama ?></a></h6>
                                    <h5 class="harga"><?= \app\components\Angka::toReadableHarga($averageprice); ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-lg-12">
                    <div class="tab-content" id="pills-tabContent">
                        <?php foreach ($kategoris as $data) {
                            $detail_pages = Produk::find()->where(['kategori_produk_id' => $data->id])->orderBy(new Expression('rand()'))->all(); ?>
                            <div class="tab-pane fade" id="pills-<?= $data->id ?>" role="tabpanel" aria-labelledby="pills-<?= $data->id ?>">
                                <div class="row featured__filter">
                                    <?php foreach ($detail_pages as $page) {
                                    ?>
                                        <div class="col-lg-3 col-md-4 col-sm-6 mix" id=prous>
                                            <div class="featured__item">
                                                <div class="featured__item__pic" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $page->foto_banner ?>);    border-radius: 5%;background-position: center;background-repeat: no-repeat;background-size: cover;box-shadow: rgb(204 204 204) 12px 12px 9px;">
                                                    <ul class="featured__item__pic__hover">
                                                        <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                                                        <li><a href="<?= Url::to(["detail-produk", "id" => $page->id]) ?>"><i class="fa fa-eye"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="featured__item__text">
                                                    <h6><a href="#"><?= $page->nama ?></a></h6>
                                                    <h5 class="harga"><?= \app\components\Angka::toReadableHarga($page->harga); ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="img/banner/banner-1.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="img/banner/banner-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<style>
    .image-container {
        width: 90px;
        height: 90px;
        overflow: hidden;
        /* Menggunakan overflow: hidden untuk memastikan gambar tidak melebihi ukuran yang ditentukan */
    }

    .styled-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }
</style>
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Latest Products</h4>
                    <div class="latest-product__slider owl-carousel" data-items="3">
                        <?php
                        $counter = 0;
                        foreach ($latest as $pro) {
                            $minimumprice = ProductDetail::find()->where(['id_product' => $pro->id])->min('harga');
                            $maximumprice = ProductDetail::find()->where(['id_product' => $pro->id])->max('harga');
                            $averageprice = ProductDetail::find()->where(['id_product' => $pro->id])->average('harga');
                            if ($counter % 3 === 0) {
                                echo '<div class="latest-product__slider__item">';
                            }
                        ?>
                            <a href="<?= Url::to(["detail-produk", "id" => $pro->id]) ?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <div class="image-container">
                                        <img src="<?= \Yii::$app->formatter->asMyImage("banner_produk/$pro->foto_banner", false, "logo.png;") ?>" alt="">
                                    </div>
                                </div>
                                <div class="latest-product__item__text">
                                    <h6><?= $pro->nama ?></h6>
                                    <span><?= \app\components\Angka::toReadableHarga($averageprice); ?></span>
                                </div>
                            </a>
                        <?php
                            $counter++;
                            if ($counter % 3 === 0) {
                                echo '</div>';
                            }
                        }
                        if ($counter % 3 !== 0) {
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Top Rated Products</h4>
                    <div class="latest-product__slider owl-carousel" data-items="3">
                        <?php
                        $counter = 0;
                        foreach ($ratings as $pro) {
                            $minimumprice = ProductDetail::find()->where(['id_product' => $pro->id])->min('harga');
                            $maximumprice = ProductDetail::find()->where(['id_product' => $pro->id])->max('harga');
                            $averageprice = ProductDetail::find()->where(['id_product' => $pro->id])->average('harga');
                            if ($counter % 3 === 0) {
                                echo '<div class="latest-product__slider__item">';
                            }
                        ?>
                            <a href="<?= Url::to(["detail-produk", "id" => $pro->id]) ?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <div class="image-container">
                                        <img src="<?= \Yii::$app->formatter->asMyImage("banner_produk/$pro->foto_banner", false, "logo.png;") ?>" alt="">
                                    </div>
                                </div>
                                <div class="latest-product__item__text">
                                    <h6><?= $pro->nama ?></h6>
                                    <span><?= \app\components\Angka::toReadableHarga($averageprice); ?></span>
                                </div>
                            </a>
                        <?php
                            $counter++;
                            if ($counter % 3 === 0) {
                                echo '</div>';
                            }
                        }
                        if ($counter % 3 !== 0) {
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Popular Products</h4>
                    <div class="latest-product__slider owl-carousel" data-items="3">
                        <?php
                        $counter = 0;
                        foreach ($populers as $pro) {
                            $minimumprice = ProductDetail::find()->where(['id_product' => $pro->id])->min('harga');
                            $maximumprice = ProductDetail::find()->where(['id_product' => $pro->id])->max('harga');
                            $averageprice = ProductDetail::find()->where(['id_product' => $pro->id])->average('harga');
                            if ($counter % 3 === 0) {
                                echo '<div class="latest-product__slider__item">';
                            }
                        ?>
                            <a href="<?= Url::to(["detail-produk", "id" => $pro->id]) ?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <div class="image-container">
                                        <img src="<?= \Yii::$app->formatter->asMyImage("banner_produk/$pro->foto_banner", false, "logo.png;") ?>" alt="">
                                    </div>
                                </div>
                                <div class="latest-product__item__text">
                                    <h6><?= $pro->nama ?></h6>
                                    <span><?= \app\components\Angka::toReadableHarga($averageprice); ?></span>
                                </div>
                            </a>
                        <?php
                            $counter++;
                            if ($counter % 3 === 0) {
                                echo '</div>';
                            }
                        }
                        if ($counter % 3 !== 0) {
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
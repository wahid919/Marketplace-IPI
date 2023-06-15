<!-- <script>


var a =window.location.href;
console.log(a);

</script> -->
<?php

use app\models\Keranjang;
use app\models\Produk;
use app\models\Toko;
use yii\helpers\Url;

$setting = app\models\Setting::find()->one();
$icons = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;
// $relativeHomeUrl = "<script>document.write(a);</script>";
$relativeHomeUrl = $_SERVER['REQUEST_URI'];
$totalcard = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => 0])->count();
$totalharga = Keranjang::find()->where(['user_id' => Yii::$app->user->identity->id, 'id_transaksi' => 0])->sum('harga*jumlah');

// var_dump($relativeHomeUrl);die;
$toko = Toko::findOne(['id_user' => Yii::$app->user->identity->id]);

if (function_exists("checkCurrentNav") == false) {
    function checkCurrentNav($target, $withindex = false)
    {
        $text = "";
        $current_url = Url::current();
        // $current_url = $_SERVER['REQUEST_URI'];
        if ($withindex) $current_url .= "/index";

        if (is_array($target)) {
            foreach ($target as $item) {
                $item = Url::to([$item]);
                if (stripos($current_url, $item) !== false) {
                    $text = "active";
                }

                if ($text != "") break;
            }
        } else {
            $target = Url::to([$target]);
            if ($withindex) $target .= "/index";
            if (stripos($current_url, $target) !== false) {
                $text = "active";
            }
        }

        return $text;
    }
}
?>
<style>
    .header__menu ul li {
        list-style: none;
        display: inline-block;
        margin-right: 1%;
        position: relative;
    }

    a.active {
        color: #7fad39 !important;
        ;
    }

    .navbar .nav__item .nav__item-link {
        color: #7fad39;
        line-height: 30px !important;
        padding-left: 15px;
        margin-left: -10px;
        ;
    }

    .logo-header {
        width: 70px;
    }

    .slider .slide-item {
        height: auto;
    }
</style>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="#"><img src="img/logo.png" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span><?= $totalcard ?></span></a></li>
        </ul>
        <div class="header__cart__price">item: <span>$150.00</span></div>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__language">
            <img src="img/language.png" alt="">
            <div>English</div>
            <span class="arrow_carrot-down"></span>
            <ul>
                <li><a href="#">Spanis</a></li>
                <li><a href="#">English</a></li>
            </ul>
        </div>
        <div class="header__top__right__auth">
            <a href="<?= Yii::$app->request->baseUrl . "/home/login" ?>"><i class="fa fa-user"></i> Login</a>
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <!-- <li class="active"><a href="./index.html">Home</a></li> -->
            <li>
                <a href="<?= Yii::$app->request->baseUrl ?>" class="nav__item-link <?= checkCurrentNav('/home', true) ?>">Home</a>
            </li>
            <li>
                <a href="<?= Yii::$app->request->baseUrl . "/home/produk" ?>" class="nav__item-link <?= checkCurrentNav('/home/produk', true) ?>">Product</a>
            </li>
            <li>
                <a href="<?= Yii::$app->request->baseUrl . "/home/about" ?>" class="nav__item-link <?= checkCurrentNav('/home/about', true) ?>">About</a>
            </li>
            <li>
                <a href="<?= Yii::$app->request->baseUrl . "/home/kontak" ?>" class="nav__item-link <?= checkCurrentNav('/home/kontak', true) ?>">Contact</a>
            </li>
            <li><a href="./shop-grid.html">Shop</a></li>
            <li><a href="#">Pages</a>
                <ul class="header__menu__dropdown">
                    <li><a href="./shop-details.html">Shop Details</a></li>
                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                    <li><a href="./checkout.html">Check Out</a></li>
                    <li><a href="./blog-details.html">Blog Details</a></li>
                </ul>
            </li>
            <li><a href="./blog.html">Blog</a></li>
            <li><a href="./contact.html">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
            <li>Free Shipping for all Order of $99</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-user"></i> <?= Yii::$app->user->identity->name ?></li>
                            <li>Gratis Ongkir untuk Pesanan diatas <?= \app\components\Angka::toReadableHarga(99999); ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <img src="img/language.png" alt="">
                            <div>English</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">Spanis</a></li>
                                <li><a href="#">English</a></li>
                            </ul>
                        </div>
                        <?php if (Yii::$app->user->identity->id == null) { ?>
                            <div class="header__top__right__auth pl-1">
                                <a href="<?= Yii::$app->request->baseUrl . "/home/login" ?>" class=" nav__item-link <?= checkCurrentNav('/home/login', true) ?>"><i class="fa fa-user"></i>Login</a>
                            </div>
                            <div class="header__top__right__auth pl-1">
                                <a href="<?= Yii::$app->request->baseUrl . "/home/registrasi" ?>" class="nav__item-link <?= checkCurrentNav('/home/registrasi', true) ?>"><i class="fa fa-envelope"></i>Daftar</a>
                            </div>
                            <!-- <a id="btn-registrasi" class="nav__item-link" style="color: black;cursor:pointer">Daftar</a> -->
                        <?php } else { ?>
                            <div class="header__top__right__auth pl-1">
                                <a href="<?= Yii::$app->request->baseUrl . "/home/profile" ?>" class="nav__item-link <?= checkCurrentNav('/home/profile', true) ?>">Akun Saya</a>
                            </div>
                            <div class="header__top__right__auth pl-1">
                                <a href="<?= Yii::$app->request->baseUrl . "/site/logout" ?>" class="nav__item-link" style="color: black;">Logout</a>
                            </div>
                        <?php } ?>
                        <?php if (Yii::$app->user->identity->role_id != null) { ?>
                            <div class="header__top__right__auth pl-1">
                                <a href="<?= Yii::$app->request->baseUrl . "/site/index" ?>" class="nav__item-link" style="color: black;">Halaman Admin</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <div class="row">
                        <div class="col-lg-5" style="margin-top: -2%;">
                            <a style="max-width:100%;" href="<?= Yii::$app->request->baseUrl ?>">
                                <img src="<?= $icons ?>" alt="">
                                <!-- <h2>IPI</h2> -->
                            </a>
                        </div>
                        <div class="col-lg-7">
                            <a href="<?= Yii::$app->request->baseUrl ?>">
                                <h5 style="display: block;text-transform: uppercase;font-weight: 800;letter-spacing: 2px;margin-left: -15%; margin-top: 7%; color: #037a20">
                                    IKATAN PESANTREN INDONESIA
                                </h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li>
                            <a href="<?= Yii::$app->request->baseUrl ?>" class="nav__item-link <?= checkCurrentNav('/home', true) ?>">Home</a>
                        </li><!-- /.nav-item -->
                        <li>
                            <a href="<?= Yii::$app->request->baseUrl . "/home/produk" ?>" class="nav__item-link <?= checkCurrentNav('/home/produk', true) ?>">Product</a>
                        </li>
                        <li>
                            <a href="<?= Yii::$app->request->baseUrl . "/home/about" ?>" class="nav__item-link <?= checkCurrentNav('/home/about', true) ?>">About</a>
                        </li>
                        <li>
                            <a href="<?= Yii::$app->request->baseUrl . "/home/kontak" ?>" class="nav__item-link <?= checkCurrentNav('/home/kontak', true) ?>">Contact</a>
                        </li>
                        <?php if (Yii::$app->user->identity->id == null) { ?>

                        <?php } else { ?>
                            <li>
                                <a href="<?= Yii::$app->request->baseUrl . "/home/pesanan" ?>" class="nav__item-link <?= checkCurrentNav('/home/pesanan', true) ?>">Pesanan </a>
                            </li>
                            <?php if ($toko == null) { ?>
                                <li class="nav__item">
                                    <a href="<?= Yii::$app->request->baseUrl . "/home/register-toko" ?>" class="nav__item-link <?= checkCurrentNav('/home/register-toko', true) ?>">Register Toko</a>
                                </li><!-- /.nav-item -->
                            <?php } else { ?>
                                <li class="nav__item">
                                    <a href="<?= Yii::$app->request->baseUrl . "/home/toko-saya" ?>" class="nav__item-link <?= checkCurrentNav("/home/toko-saya", true) ?><?= checkCurrentNav("/home/produk-saya", true) ?>">Toko
                                        Saya</a>
                                </li><!-- /.nav-item -->
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart" style="padding-top: 43px">
                    <?php if (Yii::$app->user->identity->id == !null) { ?>
                        <ul>
                            <!-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> -->
                            <li>
                                <a href="<?= Yii::$app->request->baseUrl . "/home/keranjang" ?>" class="nav__item-link <?= checkCurrentNav('/home/keranjang', true) ?>"><i class="fa fa-shopping-bag">
                                    </i> <span><?= $totalcard ?></span></a>
                            </li>
                        </ul>
                        <div class="header__cart__price">item: <span><?= \app\components\Angka::toReadableHarga($totalharga); ?></span></div>
                    <?php } else { ?>
                        <ul>
                            <!-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> -->
                            <li>
                                <a href="<?= Yii::$app->request->baseUrl . "/home/keranjang" ?>" class="nav__item-link <?= checkCurrentNav('/home/keranjang', true) ?>"><i class="fa fa-shopping-bag">
                                    </i> <span><?= $totalcard ?></span></a>
                            </li>
                        </ul>
                        <div class="header__cart__price">item: <span>Rp0</span></div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
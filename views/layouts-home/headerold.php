<!-- <script>


var a =window.location.href;
console.log(a);

</script> -->
<?php

use app\models\Toko;
use yii\helpers\Url;

$setting = app\models\Setting::find()->one();
$icons = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;
// $relativeHomeUrl = "<script>document.write(a);</script>";
$relativeHomeUrl = $_SERVER['REQUEST_URI'];
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
  a.active {
    color: #009b03 !important;
    ;
  }

  .navbar .nav__item .nav__item-link {
    color: #282828;
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
<header id="header" class="header header-transparent">
  <nav class="navbar navbar-expand-lg sticky-navbar">
    <div class="container">
      <a href="<?= Yii::$app->request->baseUrl ?>">
        <img src="<?= $icons ?>" class="logo-header logo-light" alt="logo">
        <img src="<?= $icons ?>" class="logo-header logo-dark" alt="logo">
      </a>
      <button class="navbar-toggler" type="button">
        <span class="menu-lines"><span></span></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNavigation">
        <ul class="navbar-nav ml-auto">
          <li class="nav__item">
            <a href="<?= Yii::$app->request->baseUrl ?>" class="nav__item-link <?= checkCurrentNav('/home', true) ?>">Home</a>
          </li><!-- /.nav-item -->
          <li class="nav__item">
            <a href="<?= Yii::$app->request->baseUrl . "/home/about" ?>" class="nav__item-link <?= checkCurrentNav('/home/about', true) ?>">About</a>
          </li>
          <li class="nav__item">
            <a href="<?= Yii::$app->request->baseUrl . "/home/produk" ?>" class="nav__item-link <?= checkCurrentNav('/home/produk', true) ?>">Product</a>
          </li>
          <li class="nav__item">
            <a href="<?= Yii::$app->request->baseUrl . "/home/kontak" ?>" class="nav__item-link <?= checkCurrentNav('/home/kontak', true) ?>">Contact</a>
          </li>
          <?php if (Yii::$app->user->identity->id == null) { ?>
            <!-- <li class="nav__item">
              <a href="<?= Yii::$app->request->baseUrl . "/site/login" ?>" class="nav__item-link" style="color: black;">Login</a>
            </li> -->
            <li class="nav__item">
              <!-- <a id="btn-login" class="nav__item-link" style="color: black;cursor:pointer">Login</a> -->

              <a href="<?= Yii::$app->request->baseUrl . "/home/login" ?>" class="nav__item-link <?= checkCurrentNav('/home/login', true) ?>">Login</a>
            </li>
            <li class="nav__item">
              <!-- <a id="btn-registrasi" class="nav__item-link" style="color: black;cursor:pointer">Daftar</a> -->

              <a href="<?= Yii::$app->request->baseUrl . "/home/registrasi" ?>" class="nav__item-link <?= checkCurrentNav('/home/registrasi', true) ?>">Daftar</a>
            </li>
          <?php } else { ?>
            <li class="nav__item">
              <a href="<?= Yii::$app->request->baseUrl . "/home/profile" ?>" class="nav__item-link <?= checkCurrentNav('/home/profile', true) ?>">Akun Saya</a>
            </li><!-- /.nav-item -->
            <li class="nav__item">
              <a href="<?= Yii::$app->request->baseUrl . "/home/keranjang" ?>" class="nav__item-link <?= checkCurrentNav('/home/keranjang', true) ?>">Keranjang</a>
            </li><!-- /.nav-item -->
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

            <li class="nav__item">
              <a href="<?= Yii::$app->request->baseUrl . "/site/logout" ?>" class="nav__item-link" style="color: black;">Logout</a>
            </li><!-- /.nav-item -->
          <?php } ?>

          <?php if (Yii::$app->user->identity->role_id == 1) { ?>

            <li class="nav__item">
              <a href="<?= Yii::$app->request->baseUrl . "/site/index" ?>" class="nav__item-link" style="color: black;">Halaman Admin</a>
            </li>
          <?php } ?>
        </ul><!-- /.navbar-nav -->
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navabr -->
</header><!-- /.Header -->
<?php
$setting = app\models\Setting::find()->one();
$icons = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;
$categories = app\models\KategoriBerita::find()->all();
$kategori_pendanaans = app\models\KategoriPendanaan::find()->all();
?>
<style>
  .navbar .nav__item .nav__item-link {
    color: #282828;
    line-height: 30px !important;
    padding-left: 15px;
    margin-left: -10px;
    ;
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
            <a href="<?= Yii::$app->request->baseUrl ?>" class="nav__item-link">HOME</a>
          </li><!-- /.nav-item -->
          <li class="nav__item with-dropdown">
            <a href="<?= \Yii::$app->request->baseUrl . "/home/program/" ?>" class="dropdown-toggle nav__item-link dropdown-icon">
            <div class="d-none d-lg-block">
              PROGRAM <i class="fa fa-angle-down"></i>
            </div>
            <div class="d-none d-md-block d-sm-block d-block d-lg-none">
              PROGRAM</i>
            </div>
            </a>
            <i class="fa fa-angle-right" data-toggle="dropdown"></i>
            <ul class="dropdown-menu">
              <li class="nav__item"><a href="<?= \Yii::$app->request->baseUrl . "/home/program/" ?>" class="nav__item-link text-dark">Semua Kategori</a></li>
              <?php foreach ($kategori_pendanaans as $kategori_program) {  ?>
                <li class="nav__item"><a href="<?= \Yii::$app->request->baseUrl . "/home/program?kategori=" . $kategori_program->name ?>" class="nav__item-link text-dark"><?= $kategori_program->name ?></a></li>
              <?php } ?>
            </ul><!-- /.dropdown-menu -->
          </li>
          <li class="nav__item with-dropdown">
            <a href="<?= \Yii::$app->request->baseUrl . "/home/news/" ?>" class="dropdown-toggle nav__item-link">
            <div class="d-none d-lg-block">
              BERITA <i class="fa fa-angle-down"></i>
            </div>
            <div class="d-none d-md-block d-sm-block d-block d-lg-none">
              BERITA</i>
            </div>
          </a>
            <i class="fa fa-angle-right" data-toggle="dropdown"></i>
            <ul class="dropdown-menu">
              <li class="nav__item"><a href="<?= \Yii::$app->request->baseUrl . "/home/news/" ?>" class="nav__item-link text-dark">Semua Kategori</a></li>
              <?php foreach ($categories as $kategori) {  ?>
                <li class="nav__item"><a href="<?= \Yii::$app->request->baseUrl . "/home/news?kategori=" . $kategori->nama ?>" class="nav__item-link text-dark"><?= $kategori->nama ?></a></li>
              <?php } ?>
            </ul><!-- /.dropdown-menu -->
          </li>
          <li class="nav__item with-dropdown">
            <a href="<?= \Yii::$app->request->baseUrl . "/home#" ?>" class="dropdown-toggle nav__item-link">
            <div class="d-none d-lg-block">
              LAYANAN <i class="fa fa-angle-down"></i>
            </div>
            <div class="d-none d-md-block d-sm-block d-block d-lg-none">
              LAYANAN</i>
            </div>
          </a>
            <i class="fa fa-angle-right" data-toggle="dropdown"></i>
            <ul class="dropdown-menu">
              <li class="nav__item"><a href="<?= \Yii::$app->request->baseUrl . "/home/rekening" ?>" class="nav__item-link text-dark">Daftar Rekening</a></li>
             
                <li class="nav__item"><a href="<?= \Yii::$app->request->baseUrl . "/home/report"?>" class="nav__item-link text-dark">Anual Report</a></li>
              
            </ul><!-- /.dropdown-menu -->
          </li>
          <li class="nav__item">
            <a href="<?= Yii::$app->request->baseUrl . "/about" ?>" class="nav__item-link" style="color: black;">TENTANG KAMI</a>
          </li><!-- /.nav-item -->
        </ul><!-- /.navbar-nav -->
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navabr -->
</header><!-- /.Header -->
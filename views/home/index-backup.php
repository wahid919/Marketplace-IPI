<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
?>
<!DOCTYPE html>
<html lang="en-US" class="no-js">

<head>

  <!-- Title -->
  <title>Selamat Datang</title>

  <link rel="icon" type="image/png" href="<?= $icon ?>" />
  <!-- Required Meta Tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?= $setting->nama_web ?>">

  <!-- Libs CSS -->
  <link rel="stylesheet" href="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/fullPage.js/dist/jquery.fullpage.min.css" type="text/css">
  <link rel="stylesheet" href="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/slick/slick.min.css" type="text/css">
  <link rel="stylesheet" href="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/vegas/vegas.min.css" type="text/css">
  <link rel="stylesheet" href="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/magnific-popup/dist/magnific-popup.min.css" type="text/css">
  <link rel="stylesheet" href="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/animate.css/animate.min.css" type="text/css">
  <link rel="stylesheet" href="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/font-awesome/css/all.min.css" type="text/css">
  <link rel="stylesheet" href="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/themify-icons/css/themify-icons.css" type="text/css">
  <link rel="icon" href="<?= \Yii::$app->request->BaseUrl ?>/template/assets/images/batu.png" type="image/icon type">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,700%7CMontserrat:200,300,400,500,700&display=swap">

  <!-- Theme CSS -->
  <link rel="stylesheet" href="<?= \Yii::$app->request->BaseUrl ?>/template/assets/css/theme.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?= \Yii::$app->request->BaseUrl ?>/template/assets/css/custom.css">

</head>

<body class="layout-wide">

  <!-- Loader -->
  <div class="loader bg-dark">
    <div class="spinner-grow text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  <div id="top"></div>

  <!-- Site navigation -->
  <nav class="site-navbar site-navbar-transparent navbar navbar-expand-lg navbar-dark fixed-top bg-white shadow-light p-lg-4" data-navbar-base="navbar-dark" data-navbar-toggled="navbar-light" data-navbar-scrolled="navbar-light">

    <!-- Brand -->
    <a class="navbar-brand" href="#">
      <img style="filter:none; width:110px; height:80px; position:relative; right:-50px;" src="<?= $icon ?>" class="navbar-brand-img" alt="<?= $setting->nama_web ?>">
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler-alternative" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-alternative-icon"></span>
    </button>

    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="navbarCollapse">

      <!-- Navigation -->
      <ul class="navbar-nav ml-auto" id="navigation">
        <li class="nav-item active" data-menuanchor="home">
          <a style="color:none;" class="nav-link" href="#home">Home</a>
        </li>
        <!-- <li class="nav-item" data-menuanchor="visi-misi">
            <a style="color:none;" class="nav-link" href="#visi-misi">Visi & Misi</a>
          </li>
          <li class="nav-item" data-menuanchor="profile-desa">
            <a style="color:none;" class="nav-link" href="#profile-desa">Profil Desa</a>
          </li>
          <li class="nav-item" data-menuanchor="berita">
            <a style="color:none;" class="nav-link" href="#berita">Berita</a>
          </li>
          <li class="nav-item" data-menuanchor="galeri">
            <a style="color:none;" class="nav-link" href="#galeri">Galeri</a>
          </li>
          <li class="nav-item" data-menuanchor="contact">
            <a style="color:none;" class="nav-link" href="#contact">Hubungi Kami</a>
          </li> -->
      </ul>




    </div>
  </nav>

  <!-- Back To Top Button -->
  <a href="#top" class="backtotop">
    <span>Back To Top</span>
    <i style="color:silver;" class="fas fa-angle-up"></i>
  </a>

  <!-- Scroll progress -->
  <div class="scroll-progress">
    <div class="sp-left">
      <div class="sp-inner"></div>
      <div class="sp-inner progress"></div>
    </div>
    <div class="sp-right">
      <div class="sp-inner"></div>
      <div class="sp-inner progress"></div>
    </div>
  </div>

  <!-- Fullpage content -->
  <div class="ln-fullpage" data-navigation="true">

    <!-- Section - Home -->
    <section class="ln-section d-flex min-vh-100" data-anchor="home" data-tooltip="Home" data-ui="light" data-navbar="navbar-dark">
      <div class="overlay overlay-advanced">
        <div class="overlay-inner bg-image-holder bg-cover bg-bottom-center">
          <img src="<?= $bg ?>" alt="background">
        </div>
        <div class="overlay-inner bg-dark opacity-70"></div>
      </div>
      <div class="container align-self-center text-white">
        <div class="row">
          <div class="col-12 col-lg-12 col-xl-12">

            <h1 class="mb-4 animated" data-animation="fadeInUp"><?= $setting->judul_web ?> </h1>
            <h5 class="mb-7 animated font-weight-light" data-animation="fadeInUh4" data-animation-delay="200"> <?= $setting->slogan_web ?> </h5>
            <a href="<?= $setting->link_download_apk ?>" class="btn text-white" style="background-color: #e26812;"><span class="ti-android"></span> Download Aplikasi Wakaf</a>
            <a href="<?= $setting->link_download_apk_marketing ?>" class="btn text-white" style="background-color: #e26812;"><span class="ti-android"></span> Download Aplikasi Wakaf Marketing</a>
            <!-- <a href="#visi-misi " style="color:white; background-color:rgba(255,255,255,0.3);" class="btn btn-white mr-3 scrollto animated" data-animation="fadeInUp" data-animation-delay="400">Selengkapnya</a> -->


          </div>
        </div>
      </div>
    </section>

    <!-- Section - Our mission -->
    <!-- <section class="ln-section d-xl-flex" data-anchor="visi-misi" data-tooltip="Our mission" data-ui="dark" data-navbar="navbar-light">
        <div class="container align-self-xl-center">

          
            
              <h2 class="mb-4 animated" data-animation="fadeInUp" data-animation-delay="150">Visi Kami</h2>
              <p class="animated" data-animation="fadeInUp" data-animation-delay="150"><?= $profile_desas->visi ?></p>
              <h2 class="mb-4 animated" data-animation="fadeInUp" data-animation-delay="150">Misi Kami</h2>
              <p class="animated" data-animation="fadeInUp" data-animation-delay="150"><?= $profile_desas->misi ?></p>
             
            </div>
          </div>

        </div>
      </section> -->

    <!-- <section class="ln-section d-xl-flex bg-light" data-anchor="profile-desa" data-tooltip="What we do" data-ui="dark" data-navbar="navbar-light">
        <div class="container align-self-xl-center">

          <div class="row">
          
              <h2 class="animated mb-4" data-animation="fadeInUp">Profil Desa</h2>

              <div class="card animated" data-animation="fadeInUp" data-animation-delay="150"  style="border:none;background-color:transparent;width: 100%; height:100%;">
      <img src="<?= $desa ?>" class="card-img-top" style="width:150px; padding: 25px; margin-left:25px;" alt="...">
      <div class="card-body">
        <h5 class="card-title"></h5>
          <p class="card-text">Slogan &nbsp;&nbsp;:</p>
          <p class="card-text">Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
          </p>
          <p class="card-text">Nomor Telepon &nbsp;&nbsp;:</p>
          <p class="card-text">Sejarah &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</p>
          <p class="card-text">Lokasi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
        <a href="https://www.google.co.id/maps/place/Pandanrejo,+Kec.+Bumiaji,+Kota+Batu,+Jawa+Timur/@-7.8544192,112.5314753,14z/data=!3m1!4b1!4m5!3m4!1s0x2e788097f9b9bb71:0x189e3de295e2483a!8m2!3d-7.8671319!4d112.545369">
        <img src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/images/map.png" style="width:30px; height:30px;" alt="">  
      </a>
    </p>
    
    </div>
          
  
  

              </div>
            </div>
          </div>

        </div>
      </section> -->

    <!-- Section - Our solutions -->

    <!-- Section - Our work -->
    <!-- <section class="ln-section d-xl-flex" data-anchor="galeri" data-tooltip="Our work" data-ui="dark" data-navbar="navbar-light">
        <div class="container align-self-xl-center">
          <div class="row mb-8">
            <div class="col-12 col-xl-6">
              <h2 class="mb-4 animated" data-animation="fadeInUp">Galeri Foto</h2>
              <p class="animated" data-animation="fadeInUp" data-animation-delay="150">Berikut adalah gambar hasil dari kegiatan di desa batu.</p>
            </div>
          </div>
          <div class="slider animated" data-animation="fadeInUp" data-animation-delay="300" data-slick='{"dots": true}'>
          
            <div>
              <div class="portfolio-item mb-8">
                <div class="row">
                  <div class="col-12 col-lg-7 mb-4 mb-lg-0">
                    <div class="item-media">
                      <a href="<?= \Yii::$app->request->BaseUrl ?>/uploads/galeri/" class="mfp-image">
                        <div class="media-container">
                          <div class="bg-image-holder bg-cover">
                            <img src="<?= \Yii::$app->request->BaseUrl ?>/uploads/galeri/" alt="">
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-12 col-lg-5">
                    <div class="pt-lg-8">
                      <div class="divider divider-alt bg-dark mt-0 mb-8 d-none d-lg-block"></div>
                      <h4 class="h3 item-title"></h4>
                      <p class="item-cat">Paralayang Batu menjadi pilihan aktivitas seru saat berwisata ke Kota Batu, Malang. Olahraga menantang sekaligus menikmati keindahan alam dari atas ketinggian yang dijamin menjadikan liburan Anda semakin berkesan.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

    <!-- <div>
              <div class="portfolio-item mb-8">
                <div class="row flex-lg-row-reverse">
                  <div class="col-12 col-lg-7 mb-4 mb-lg-0">
                    <div class="item-media">
                      <a href="<?= \Yii::$app->request->BaseUrl ?>/uploads/galeri/<?= $galeri->gambar ?>" class="mfp-image">
                        <div class="media-container">
                          <div class="bg-image-holder bg-cover">
                            <img src="<?= \Yii::$app->request->BaseUrl ?>/uploads/galeri/<?= $galeri->gambar ?>" alt="">
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-12 col-lg-5 d-lg-flex justify-content-lg-end text-lg-right">
                    <div class="pt-lg-8">
                      <div class="divider divider-alt bg-dark mt-0 mb-8 ml-auto mr-0 d-none d-lg-block"></div>
                      <h4 class="h3 item-title"></h4>
                      <p class="item-cat">Lumbung Strawberry berlokasi di desa Pandanrejo, Kawasannya cukup mencolok Teman Traveler. Hampir semua dinding rumah warga di sekitarnya dihiasi lukisan stroberi. Suasananya pun jadi terasa sangat ceria.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
    <!-- </div>
        </div>
      </section> -->

    <section class="ln-section d-xl-flex" data-anchor="contact" data-tooltip="Contact" data-ui="dark" data-navbar="navbar-light" style="background-color: #e26812;">
      <div class="container align-self-center">
        <div class="row mb-7">
          <div class="col-12 col-xl-12">
            <h2 class="mb-4 animated text-white" data-animation="fadeInUp">Hubungi Kami</h2>
            <p class="animated text-white" data-animation="fadeInUp" data-animation-delay="150">Ingin menyapa? Ingin tahu lebih banyak tentang kami? Hubungi kami atau kirimkan email kepada kami dan kami akan segera menghubungi Anda kembali.</p>
          </div>
        </div>
        <div class="col-12 col-lg-12 animated" data-animation="fadeInUp" data-animation-delay="150">
          <!-- display success message -->
          <?php if (Yii::$app->session->hasFlash('success')) : ?>
            <div class="alert alert-success alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
              <p><i class="icon fa fa-check"></i>Saved!</p>
              <?= Yii::$app->session->getFlash('success') ?>
            </div>
          <?php endif; ?>

          <!-- display error message -->
          <?php if (Yii::$app->session->hasFlash('error')) : ?>
            <div class="alert alert-danger alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
              <h4><i class="icon fa fa-check"></i>Saved!</h4>
              <?= Yii::$app->session->getFlash('error') ?>
            </div>
          <?php endif; ?>
          <div class="contact-form">

            <?php $form = ActiveForm::begin(
              [
                'id' => 'HubungiKami',
                'layout' => 'horizontal',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error'
              ]
            );
            ?>
            <div class="form-row">

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <?= $form->field($model, 'nama', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                      'class' => 'form-control'
                    ],
                    'labelOptions' => [
                      'class' => 'text-white'
                    ],
                    'options' => ['tag' => false]
                  ])->textInput(['maxlength' => true]) ?>
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <?= $form->field($model, 'nomor_hp', [
                    'template' => '
                        {label}
                        {input}
                        {error}
                    ',
                    'inputOptions' => [
                      'class' => 'form-control'
                    ],
                    'labelOptions' => [
                      'class' => 'text-white'
                    ],
                    'options' => ['tag' => false]
                  ])->textInput(['maxlength' => true]) ?>
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <?= // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::activeField
                  $form->field($model, 'tema_hubungi_kami_id', [
                    'template' => '
                  {label}
                  {input}
                  {error}
              ',
                    'inputOptions' => [
                      'class' => 'form-control'
                    ],
                    'labelOptions' => [
                      'class' => 'text-white'
                    ],
                    'options' => ['tag' => false]
                  ])->dropDownList(
                    \yii\helpers\ArrayHelper::map(app\models\TemaHubungiKami::find()->all(), 'id', 'nama_tema'),
                    [
                      'prompt' => 'Select',
                      'disabled' => (isset($relAttributes) && isset($relAttributes['tema_hubungi_kami_id'])),
                    ]
                  ); ?>
                </div>
              </div>
              <?php echo $form->errorSummary($model); ?>

              <div class="col-12 text-center">
                <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn-primary']); ?>
              </div>
            </div>

            <?php ActiveForm::end(); ?>

            <!-- <form class="mb-0" id="cf" name="cf" action="include/sendemail.php" method="post" autocomplete="off">
                    <div class="form-row">

                      <div class="col-12 col-md-4">
                        <div class="form-group">
                          <label for="name" class="text-white">Nama</label>
                          <input type="text" id="cf-name" name="cf-name" placeholder="Masukkan Nama Anda" class="form-control required">
                        </div>
                      </div>

                      <div class="col-12 col-md-4">
                        <div class="form-group">
                          <label for="no_hp" class="text-white">Nomor HP</label>
                          <input type="number" id="cf-email" name="cf-email" placeholder="Masukkan nomor HP" class="form-control required">
                        </div>
                      </div>

                      <div class="col-12 col-md-4 ">
                        <div class="form-group">
                          <label for="tema" class="text-white">Tema</label>
                          <input type="text" id="cf-subject" name="cf-subject" placeholder="Subject (Optional)" class="form-control">
                        </div>
                      </div>

                      <div class="col-12 d-none">
                        <input type="text" id="cf-botcheck" name="cf-botcheck" value="">
                      </div>

                      <input type="hidden" name="prefix" value="cf-">

                      <div class="col-12 text-center">
                        <button class="btn btn-primary" type="submit" id="cf-submit" name="cf-submit">Kirim Pesan</button>
                      </div>

                    </div>
                  </form> -->
            <div class="contact-form-result"></div>
          </div>
        </div>

      </div>
    </section>

  </div>

  <!-- Footer -->
  <footer class="position-relative py-10 py-lg-6 bg-dark text-gray-500">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-xl-12 col-xxl-10 mx-auto text-center">
          <!-- <ul class="list-inline mb-5">
              <li class="list-inline-item mx-0">
                <a class="btn btn-icon btn-text-secondary text-gray-400" href="#" tabindex="0">
                  <i class="fab fa-facebook-f btn-icon-inner"></i>
                </a>
              </li>
              <li class="list-inline-item mx-0">
                <a class="btn btn-icon btn-text-secondary text-gray-400" href="#" tabindex="0">
                  <i class="fab fa-twitter btn-icon-inner"></i>
                </a>
              </li>
              <li class="list-inline-item mx-0">
                <a class="btn btn-icon btn-text-secondary text-gray-400" href="#" tabindex="0">
                  <i class="fab fa-linkedin-in btn-icon-inner"></i>
                </a>
              </li>
              <li class="list-inline-item mx-0">
                <a class="btn btn-icon btn-text-secondary text-gray-400" href="#" tabindex="0">
                  <i class="fab fa-dribbble btn-icon-inner"></i>
                </a>
              </li>
            </ul> -->
          <p class="mb-0">© <?= date('Y') ?> <?= $setting->nama_web ?> - Batu Tracking 19 - <a href="#!" class="text-gray-400">Terms of Service</a></p>
        </div>
      </div>
    </div>
  </footer><!-- footer end -->

  <!-- Fullpage - Social icons -->
  <!-- <nav class="ln-social-icons">
      <ul class="mx-auto">
        <li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
        <li><a href="#!"><i class="fab fa-twitter"></i></a></li>
        <li><a href="#!"><i class="fab fa-instagram"></i></a></li>
        <li><a href="#!"><i class="fab fa-pinterest"></i></a></li>
      </ul>
    </nav> -->

  <!-- Fullpage - Copyright -->
  <div class="ln-copyright text-right">
    <p>© <?= date('Y') ?> <?= $setting->nama_web ?> - All Rights Reserved - <a href="#!">Terms of Service</a></p>
  </div>





  <!-- Libs JS -->
  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/popper.js/dist/popper.min.js"></script>
  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/fullPage.js/dist/scrolloverflow.min.js"></script>
  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/fullPage.js/dist/jquery.fullpage.min.js"></script>
  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/waypoints/lib/jquery.waypoints.min.js"></script>
  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/jquery-smooth-scroll/jquery.smooth-scroll.min.js"></script>
  <!-- <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script> -->
  <!-- <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/jquery-form/dist/jquery.form.min.js"></script> -->
  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/jQuery.countdown/dist/jquery.countdown.min.js"></script>
  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/granim.js/dist/granim.min.js"></script>
  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/slick/slick.min.js"></script>
  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/vendor/vegas/vegas.min.js"></script>

  <!-- Theme JS -->
  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/js/main.js"></script>

</body>

</html>
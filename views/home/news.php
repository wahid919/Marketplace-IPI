<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="description" content="<?= $setting->nama_web ?>">
  <link href="<?= $icon ?>" rel="icon">
  <title><?= $setting->nama_web ?></title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto:400,500,700%7cPoppins:400,600,700&display=swap">
  <link rel="stylesheet" href="<?= \Yii::$app->request->BaseUrl ?>/template/assets/css/libraries.css" />
  <link rel="stylesheet" href="<?= \Yii::$app->request->BaseUrl ?>/template/assets/css/style.css" />
</head>

<body>
  <div class="wrapper">
    <!-- =========================
        Header
    =========================== -->
    <?= $this->render('component/header') ?>

    <!-- ============================
        Slider
    ============================== -->
    <section id="slider1" class="slider slider-1">
      <div class="owl-carousel thumbs-carousel carousel-arrows" data-slider-id="slider1" data-dots="false"
        data-autoplay="true" data-nav="true" data-transition="fade" data-animate-out="fadeOut" data-animate-in="fadeIn">
        <div class="slide-item align-v-h bg-overlay">
          <div class="bg-img"><img src="<?= $bg_login ?>" alt="img"></div>
          <div class="container">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="slide__content">
                  <h2 class="slide__title"><?= $setting->judul_web ?></h2>
                  <p class="slide__desc"><?= $setting->slogan_web ?></p>
                  <a href="#" class="btn btn__primary btn__hover2 mr-30">GET NOW</a>
                  <a href="#" class="btn btn__white">CONTACT US</a>
                </div><!-- /.slide-content -->
              </div><!-- /.col-lg-8 -->
            </div><!-- /.row -->
          </div><!-- /.container -->
        </div><!-- /.slide-item -->
      </div><!-- /.carousel -->
    </section><!-- /.slider -->

    <!-- ========================
        Services
    =========================== -->
    <section id="services" class="services pb-90">
      <div class="container">
        <div class="row heading heading-2 mb-40">
          <div class="col-sm-12 col-md-12 col-lg-12">
            <!-- <span class="heading__subtitle" style="color:orange;">Tentang Kami</span> -->
          </div><!-- /.col-lg-12 -->
          <div class="col-sm-12 col-md-12 col-lg-6">
            <h2 class="heading__title" style="color:orange;">Visi</h2>
            <!-- <br> -->
            <!-- <img src="<?= $icon ?>" class="logo" alt="logo" style="width:35%;"> -->
          </div><!-- /.col-lg-5 -->
          <div class="col-sm-12 col-md-12 col-lg-6 ">
            <p class="heading__desc"><?= $setting->visi ?></p>
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
       
        
      </div><!-- /.container -->
    </section><!-- /.Services -->
    <section id="services" class="services pb-90">
      <div class="container">
        <div class="row heading heading-2 mb-40">
          <div class="col-sm-12 col-md-12 col-lg-12">
            <!-- <span class="heading__subtitle" style="color:orange;">Tentang Kami</span> -->
          </div><!-- /.col-lg-12 -->
          <div class="col-sm-12 col-md-12 col-lg-6">
            <h2 class="heading__title" style="color:orange;">MISI</h2>
            <!-- <br> -->
            <!-- <img src="<?= $icon ?>" class="logo" alt="logo" style="width:35%;"> -->
          </div><!-- /.col-lg-5 -->
          <div class="col-sm-12 col-md-12 col-lg-6 ">
            <p class="heading__desc"><?= $setting->misi ?></p>
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
       
        
      </div><!-- /.container -->
    </section><!-- /.Services -->
    <!-- =========================== 
      fancybox Carousel
    ============================= -->
    

    <!-- ========================
        Request Quote Tabs
    =========================== -->
    <?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
?>
    <section id="requestQuoteTabs" class="request-quote request-quote-tabs p-0">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="request__form">
              <nav class="nav nav-tabs">
                <!-- <a class="nav__link active" data-toggle="tab" href="#quote">Request A Quote</a>
                <a class="nav__link" data-toggle="tab" href="#track">Track & Trace</a> -->
              </nav>
              <div class="tab-content">
                <div class="tab-pane fade show active" id="quote">
                  <div class="request-quote-panel">
                    <div class="request__form-body">
                      <div class="row">
                        
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
      ])->textInput(['maxlength' => true,'placeholder'=>'Nama']) ?>
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
      ])->textInput(['maxlength' => true,'placeholder'=>'Nomor Handphone']) ?>
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
<div class="contact-form-result"></div>
</div>
                      </div>
                    </div><!-- /.request__form-body -->
                    <div class="widget widget-download bg-theme" style="background-color: orange !important;">
                      <div class="widget__content">
                        <h5>HUBUNGI KAMI</h5>
                        <p>Ingin Menyapa?Ingin tahu lebih banyak tentang kami?Hubungi kami atau kiriman email kepada kami,dari kami akan segera menghubungi Anda Kembali</p>
                        <!-- <a href="#" class="btn btn__secondary btn__hover2 btn__block">
                          <span>Download 2019 Brochure</span><i class="icon-arrow-right"></i>
                        </a> -->
                      </div><!-- /.widget__content -->
                    </div><!-- /.widget-download -->
                  </div><!-- /.request-quote-panel-->
                </div><!-- /.tab -->
                <div class="tab-pane fade" id="track">
                  <div class="request-quote-panel">
                    <div class="request__form-body">
                      <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                          <div class="form-group">
                            <label>Shipment Type</label>
                            <div class="form-group form-group-select">
                              <select class="form-control">
                                <option>Packaging</option>
                                <option>Packaging 1</option>
                                <option>Packaging 2</option>
                              </select>
                            </div>
                          </div>
                        </div><!-- /.col-lg-12 -->
                        <div class="col-sm-12 col-md-12 col-lg-12">
                          <div class="form-group">
                            <label>Tracking Number</label>
                            <div class="form-group">
                              <textarea class="form-control"
                                placeholder="You can enter up to a maximum of 10 airway bill numbers for tracking."></textarea>
                            </div>
                          </div>
                        </div><!-- /.col-lg-12 -->
                        <div class="col-sm-12 col-md-12 col-lg-12 d-flex flex-wrap">
                          <div class="form-group input-radio">
                            <label class="label-radio">Fragile
                              <input type="radio" name="radioGroup2" checked="">
                              <span class="radio-indicator"></span>
                            </label>
                          </div>
                          <div class="form-group input-radio">
                            <label class="label-radio">Express Delivery
                              <input type="radio" name="radioGroup2">
                              <span class="radio-indicator"></span>
                            </label>
                          </div>
                          <div class="form-group input-radio">
                            <label class="label-radio">Insurance
                              <input type="radio" name="radioGroup2">
                              <span class="radio-indicator"></span>
                            </label>
                          </div>
                          <div class="form-group input-radio">
                            <label class="label-radio">Packaging
                              <input type="radio" name="radioGroup2">
                              <span class="radio-indicator"></span>
                            </label>
                          </div>
                        </div><!-- /.col-lg-12 -->
                        <div class="col-sm-12 col-md-12 col-lg-12">
                          <button class="btn btn__secondary btn__block">Track & Trace</button>
                        </div><!-- /.col-lg-12 -->
                      </div>


                    </div><!-- /.request__form-body -->
                    <div class="widget widget-download bg-theme">
                      <div class="widget__content">
                        <h5>Industry<br>Solutions!</h5>
                        <p>Our worldwide presence ensures the timeliness, cost efficiency and compliance adherence
                          required to ensure your production timelines are met.</p>
                        <a href="#" class="btn btn__secondary btn__hover2 btn__block">
                          <span>Download 2019 Brochure</span><i class="icon-arrow-right"></i>
                        </a>
                      </div><!-- /.widget__content -->
                    </div><!-- /.widget-download -->
                  </div><!-- /.request-quote-panel-->
                </div><!-- /.tab -->
              </div><!-- /.tab-content -->
            </div><!-- /.request-form -->
          </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.Request Quote Tabs -->

    <!-- ========================= 
            Testimonial #1
    =========================  -->
    

    <!-- =====================
       Clients 1
    ======================== -->
    <section id="clients1" class="clients clients-1 border-top">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12">
           
          </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.clients 1 -->

    <!-- ======================
           banner 3
      ========================= -->
   
    <!-- ======================
      Blog Grid
    ========================= -->

    <!-- ========================= 
            contact 1
      =========================  -->
    

    <!-- ========================
            Footer
    ========================== -->
   
    <?= $this->render('component/footer') ?>

    <div class="module__search-container">
      <i class="fa fa-times close-search"></i>
      <form class="module__search-form">
        <input type="text" class="search__input" placeholder="Type Words Then Enter">
        <button class="module__search-btn"><i class="fa fa-search"></i></button>
      </form>
    </div><!-- /.module-search-container -->

    <button id="scrollTopBtn"><i class="fa fa-long-arrow-up"></i></button>
  </div><!-- /.wrapper -->

  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/js/jquery-3.3.1.min.js"></script>
  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/js/plugins.js"></script>
  <script src="<?= \Yii::$app->request->BaseUrl ?>/template/assets/js/main.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCV6HOHjE9XM8IbEaL6ZMZdW8e0tavsOL8&libraries=places&region=id&language=en&sensor=false"></script>

  <script>
        
        var marker;
          function initialize() {
              
            // Variabel untuk menyimpan informasi (desc)
            var infoWindow = new google.maps.InfoWindow;
            
            //  Variabel untuk menyimpan peta Roadmap
            var mapOptions = {
              mapTypeId: google.maps.MapTypeId.ROADMAP
            } 
            
            // Pembuatan petanya
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                  
            // Variabel untuk menyimpan batas kordinat
            var bounds = new google.maps.LatLngBounds();
    
            // Pengambilan data dari database
            <?php
              
                    $nama = $setting->nama_web;
                    $lat = $setting->latitude;
                    $lon = $setting->longitude;
                    
                    echo ("addMarker($lat, $lon, '<b>$nama</b>');\n");                        
               
              ?>
              
            // Proses membuat marker 
            function addMarker(lat, lng, info) {
                var lokasi = new google.maps.LatLng(lat, lng);
                bounds.extend(lokasi);
                var marker = new google.maps.Marker({
                    map: map,
                    position: lokasi
                });       
                map.fitBounds(bounds);
                bindInfoWindow(marker, map, infoWindow, info);
             }
            
            // Menampilkan informasi pada masing-masing marker yang diklik
            function bindInfoWindow(marker, map, infoWindow, html) {
              google.maps.event.addListener(marker, 'click', function() {
                infoWindow.setContent(html);
                infoWindow.open(map, marker);
              });
            }
     
            }
          google.maps.event.addDomListener(window, 'load', initialize);
        
        </script>
</body>

</html>
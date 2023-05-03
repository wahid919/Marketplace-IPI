<?php

use app\models\Berita;
use richardfan\widget\JSRegister;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<style>
  h3{
    color: #0077c1;
  }
  @media (min-width:1200px) {
    .container {
        max-width: 1540px
    }
    .slider .slide-item{
      min-height: 500px;
    }
}
.text-list__data {
  text-align : center !important;
}
.color-orange-light-1 {
  color : #ef672f;
}

@media screen and (min-width: 1200px) {
.komentar{
  font-size: 13px;
}
}
</style>
<section id="slider3" class="slider slider-3">
  <div class="carousel owl-carousel carousel-arrows carousel-dots" data-slide="1" data-slide-md="1" data-slide-sm="1" data-autoplay="false" data-nav="true" data-dots="false" data-space="0" data-loop="true" data-speed="3000" data-transition="fade" data-animate-out="fadeOut" data-animate-in="fadeIn">
    <div class="slide-item align-v-h bg-overlay">
      <!-- <div class="bg-img"><img src="assets/images/sliders/3.jpg" alt="slide img"></div> -->

      <div class="bg-img"><img src="<?= Yii::$app->request->baseUrl . '/uploads/organisasi/' . $organisasis->background_organisasi ?>" alt="background"></div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-8 col-xl-6">
          </div><!-- /.col-xl-6 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </div><!-- /.slide-item -->
  </div><!-- /.carousel -->
</section><!-- /.slider -->
<section id="projectsGallery" class="projects projects-gallery pb-80" style="margin-top: 5%;">
      <div class="container">
      
        <div class="row">
          <!-- project item #1 -->
          <div class="col-sm-3 col-md-3 col-lg-3">
          <h3 class="contact-brand">  
          Kenal lebih dekat Dengan kami,Ikatan <?= $organisasis->nama_organisasi ?> Provinsi Jawa Timur
          </h3></div>
          <div class="col-sm-9 col-md-9 col-lg-9">
            <div class="row">
            <?php foreach($foto_organisasis as $value){
                $foto = \Yii::$app->request->baseUrl . "/uploads/foto_organisasi/" . $value->foto;
                ?>
              <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="project-item">
                  <div class="project__img">
                    <img src="<?= $foto ?>" alt="project img">
                    <a href="<?= $foto ?>" data-lightbox="lightbox" class="zoom__icon"></a>
                  </div><!-- /.project-img -->
                </div><!-- /.project-item -->
              </div><!-- /.col-lg-4 -->
              <?php } ?>
              

            </div>
        </div>
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.projects Gallery -->
    <div class="col-12">
      <hr>
    </div>
<section id="services" class="services pb-80  text-center" style="margin-top: 5%;">
  <div class="container">

    <div class="row">
      <div data-aos="fade-up" data-aos-delay="500" data-aos-duration="1000" class="col-md-6">
        <h3 class="contact-brand"><?=$organisasis->text_sejarah ?></h3>
      </div>
      <div data-aos="fade-up" data-aos-delay="500" data-aos-duration="1000" class="col-md-6">
        <div class="contact-list">
          <p class="contact-office"><?= $organisasis->isi_sejarah ?></p>
          
        </div>
      </div>
    </div>
    <div class="row" style="margin-top: 2%;margin-bottom:2%;">
      <div data-aos="fade-up" data-aos-delay="500" data-aos-duration="1000" class="col-md-6">
        <h3 class="contact-brand">Visi & Misi <br> Organisasi</h3>
      </div>
      <div data-aos="fade-up" data-aos-delay="500" data-aos-duration="1000" class="col-md-6">
        <div class="contact-list">
        <h3 class="contact-brand">Visi</h3>
          <p class="contact-office"><?= $organisasis->visi ?></p>
          
        </div>
        <div class="contact-list">
        <h3 class="contact-brand">Misi</h3>
          <p class="contact-office"><?= $organisasis->misi ?></p>
          
        </div>
      </div>
    </div>
    <div class="row" style="margin-top: 2%;">
      <div data-aos="fade-up" data-aos-delay="500" data-aos-duration="1000" class="col-md-6">
        <h3 class="contact-brand">Anggota Ikatan <?= $organisasis->nama_organisasi ?></h3>
      </div>
      <div data-aos="fade-up" data-aos-delay="500" data-aos-duration="1000" class="col-md-6">
      <div class="row fancybox-layout2">
              <!-- fancybox item #1 -->
              <?php foreach($foto_organisasis as $value){
                $foto = \Yii::$app->request->baseUrl . "/uploads/foto_organisasi/" . $value->foto;
                ?>
              <div class="col-sm-12 col-md-6 col-lg-4" style="margin-top: 2%;">
                <div class="team-img bg-banner" style="background-image: url(<?= $foto ?>);"></div>
                
              </div><!-- /.col-lg-4 -->
              <?php } ?>
              <!-- fancybox item #2 -->
              
              
            </div>
      </div>
    </div>
  </div><!-- /.container -->
</section><!-- /.Services -->
<div class="container">
  <div class="col-12 mt-6">

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

  <div class="col-12">
    <hr>
  </div>


  <section id="services" class="services pb-50">
    <div class="row">
      
    
    <div class="col-lg-9 col-md-6 col-sm-12">
      <div class="row">
        <div class="col-lg-6">

          <h2 class="text-left" style="color:orange">Berita Update</h2>
          <p class="text-left font-weight-bold">KORMI JAWA TIMUR</p>
        </div>
        <div class="col-lg-3"></div>
        <div class="col-lg-3" align="right">
          <form class="footer__newsletter-form d-flex flex-wrap">
            <div class="form-group d-flex flex-1 mb-20 mr-1">
              <input type="search" class="form-control" placeholder="Pencarian" style="border-radius: 10px;height:35px;">
              <!-- <textarea name="pesan" id="pesan" cols="30" rows="10" class="form-control"></textarea> -->
            </div>
            <!-- <button class="btn btn__primary btn__hover3 mb-20">Submit Now!</button> -->
          </form>
        </div>
      </div>

      <div class="row">
        <?php foreach ($news as $berita) { ?>
          <div class="col-lg-4 col-md-4 mt-3">
            <a href="<?= \Yii::$app->request->baseUrl . "/detail-berita?id=" . $berita->slug ?>">
              <div class="card border-r15 shadow-br2">
                <div class="border-r15" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/berita/" . $berita->gambar ?>);background-size: cover;height: 200px;">

                </div>
                <div class="card-body">
                  <h6 class="card-title"><?= $berita->getShowTitle() ?></h6>
                  <div class="content-berita__info">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-6 text-left">
                        <?= date("d M Y", strtotime($berita->created_at)); ?> <br>
                      </div>
                      <div class="col-lg-6 col-md-6 col-6 text-right">
                        <?= $berita->kategoriBerita->nama ?>
                      </div>
                    </div>
                    <hr>
                  </div>
                  <p style="color: #666; margin-bottom: .5rem; font-size: .9rem" :hover="color: #666">
                    <?= $berita->getDescription() ?> .. <a href="<?= Url::to(['home/detail-berita', 'id' => $berita->slug]) ?>" style="color: #d07500;">Baca Selengkapnya</a>
                  </p>
                  <div style="text-align: right;">
                    <!-- <a href="<?= Url::to(['home/detail-berita', 'id' => $berita->slug]) ?>" class="btn btn-more"><?= Yii::t("cruds", "Baca Selengkapnya") ?></a> -->
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php } ?>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-12 pt-70">
    <!-- <div class="card"> -->
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <h6 class="text-left font-weight-bold" style="color: black;">
                  <?php 
    $newss = Berita::find()->limit(5)->orderBy(['view_count'=>SORT_DESC])->all();
    ?>
    <?= Yii::t("cruds", "Berita Terpopuler") ?>
                </h6>
                </div>
                <hr>
                <!-- <div class="col-12 text-left border-top-2 mt-4 pt-4">
                </div> -->
                <?php foreach ($newss as $keys => $berita) { $number = $keys + 1; ?>
                  <div class="col-lg-12 col-md-12 mt-3">
                    <!-- <div class="card shadow-br2" style="border-radius: 15px;"> -->
                      <!-- <a href="<?= \yii\helpers\Url::to(['home/detail-berita', 'id' => $berita->slug]) ?>">
                      <div class="team-img" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/berita/" . $berita->gambar ?>);border-radius: 15px;height:100px;width:auto">
                      </div>
                      </a> -->
                      <!-- <div class="card-body" style="margin-top: -10px;"> -->
                        <div class="row">
                          <div class="col-md-3">
                          <h6 style="color:#999999;">#<?=$number ?></h6>
                          </div>
                          <div class="col-md-9">
                            <h6 class="card-title"><a href="<?= \yii\helpers\Url::to(['home/detail-berita', 'id' => $berita->slug]) ?>" style="color: black;"><?= $berita->judul ?></a></h6>
                          </div>
                        </div>
                        
                      <!-- </div> -->
                    <!-- </div> -->
                    <!-- </a> -->
                  </div>
                <?php } ?>
              </div>
            </div>
          <!-- </div> -->
          <hr>
          <!-- <div class="card"> -->
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <h6 class="text-left font-weight-bold" style="color: black;">
                  <?php 
              $newss = (new \yii\db\Query())
              ->select(['berita.id as id','berita.slug as slug','berita.judul as judul','berita.gambar as gambar','count(komentar.id) as jumlah'])
              ->from('berita')
              ->leftJoin('komentar', 'komentar.post_id=berita.id')
              ->where(['komentar.flag'=>1])
              ->limit(5)->orderBy(['jumlah'=>SORT_DESC])->all();
    ?>
    <?= Yii::t("cruds", "Komentar Terbanyak") ?>
                </h6>
                </div>
                <hr>
                <!-- <div class="col-12 text-left border-top-2 mt-4 pt-4">
                </div> -->
                <?php foreach ($newss as $keys => $berita) { $number = $keys + 1; ?>
                  <div class="col-lg-12 col-md-12 mt-3">
                    <!-- <div class="card shadow-br2" style="border-radius: 15px;"> -->
                      <!-- <a href="<?= \yii\helpers\Url::to(['home/detail-berita', 'id' => $berita["slug"]]) ?>">
                      <div class="team-img" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/berita/" . $berita["gambar"] ?>);border-radius: 15px;height:100px;width:auto">
                      </div>
                      </a> -->
                      <!-- <div class="card-body" style="margin-top: -10px;"> -->
                        <div class="row">
                          <div class="col-md-3">
                          <div class="text-list__data">
                            <div class="font-sm color-orange-light-1"><?= $berita["jumlah"] ?></div>
                            <div class="komentar">Komentar</div>
                          </div>
                          </div>
                          <div class="col-md-9">
                            <h6 class="card-title"><a href="<?= \yii\helpers\Url::to(['home/detail-berita', 'id' => $berita["slug"]]) ?>" style="color: black;"><?= $berita["judul"] ?></a></h6>
                          </div>
                        </div>
                        
                      <!-- </div> -->
                    <!-- </div> -->
                    <!-- </a> -->
                  </div>
                <?php } ?>
              </div>
            </div>
          <!-- </div> -->
    </div>
    </div>
    </div><!-- /. -->
  </section><!-- /.Services -->

  <div class="col-12">
    <hr>
  </div>


</div>
</div>
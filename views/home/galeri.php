<?php

use yii\helpers\Url;

$css = <<<CSS
.owl-nav {
    position: absolute;
    top: 45%;
    left: -1.5rem;
    right: -1.5rem;
    display: flex;
    justify-content: space-between;
    overflow: hidden;
}

.owl-nav .owl-prev,
.owl-nav .owl-next {
    font-size: 1rem;
    padding: 0 .5rem;
    margin: 0 1rem;
    border-radius: 100%;
    background: #fff;
    box-shadow: 0 0 3px 0 #ccc;
    color: #aaa;
}

.owl-stage,
.owl-item {
    overflow: hidden;
    border-radius: 1rem;
}

.owl-dots,
.owl-thumbs {
    display: none;
}
.btn-more {
  padding: 0;
  background-color: #F1A527;
}


.ad {
  margin: 20px auto;
  max-width: 768px;
  background-image: url('https://tribratanewspolrestasidoarjo.com/img/berita/Berita-20210706085545.jpg');
  background-size: cover;
  background-position: left center;
  border: 1px solid #333;
  
}
.link {
  background-color: rgba(245,160,25,.8);
  padding: 10px 20px;
  font-size: 2.15em;
  line-height: 90px;
  font-family: 'Oswald', sans-serif;
  text-transform: uppercase;
  transition: all .15s ease;
  text-align: center;
}
.link:hover {
  background-color: rgba(245,160,25,.8);
  transition: all .15s ease;
}
.conten {
    clear: both;
    padding: 1px 0 0 0;
  }
  .logo {
    width: 283px;
    height: 50px;
    margin: 30px auto;
    background-image: url('https://tribratanewspolrestasidoarjo.com/img/berita/Berita-20210706085545.jpg');
    background-size: cover;
    background-position: center center;
  }
  a {
    display: block;
    color: #ffffff;
    text-decoration: none;
    }

@media screen and (min-width: 525px) {
  .ad {
    height: 150px;
  }
  .conten {
    padding: 0 25px;
  }
  .logo {
    float: left;
  }
  .link {
    float: right;
    background-color: rgba(255,255,255,.25);
  }
}
@media (min-width:1200px) {
    .container {
        max-width: 1540px
    }
}
CSS;

$this->registerCss($css) ?>
<hr class="mt-0">
<div class="mt-4 mb-4">
  <div class="container mt-4 mb-4">

  <!--  -->

  <section class="ad">
  <div class="conten">
    <a href="http://www.timberland.com/">
      <div class="logo" alt="Timberland">
      </div>
    </a>
    <a href="http://www.timberland.com/sale.html">
      <h2 class="link">Shop Now</h2>
    </a>
  </div>
</section>

    <div class="row mt-2">
    <section id="projectsGallery" class="projects projects-gallery pb-80">
      <div class="container">
        <div class="row">
          <!-- project item #1 -->
          <?php foreach ($galeris as $galeri) { ?>
          <div class="col-sm-6 col-md-6 col-lg-4">
            <div class="project-item">
              <div class="project__img">
                <img src="<?= \Yii::$app->request->BaseUrl.'/uploads/galeri/'.$galeri->foto ?>" alt="project img">
                <a title="<?=$galeri->isi ?>" href="<?= \Yii::$app->request->BaseUrl.'/uploads/galeri/'.$galeri->foto ?>" data-lightbox="lightbox" class="zoom__icon"></a>
              </div><!-- /.project-img -->
            </div><!-- /.project-item -->
          </div><!-- /.col-lg-4 -->
          <?php } ?>
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.projects Gallery -->
        
    </div>
    <div class="row mt-4 mb-4 text-center">
      <div class="col-md-12">
        <div class='d-flex justify-content-center'>
          <?php echo \yii\widgets\LinkPager::widget([
            'pagination' => $pagination,
            'maxButtonCount' => 5
          ]); ?>
        </div>
      </div>
    </div>
    <h3 class="mt-4 mb-4" style="margin-left:10px;color: #F5AE3D;font-size:1.4rem"><?= Yii::t("cruds", "Profil Singkat") ?></h3>
      <div class="row">
          <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 mt-3">
            <!-- <a href="#" style="color: #333333;"> -->
              <div class="card h-100 card_berita">
                <!-- <img src="" class="card-img-top" alt="..."> -->
                <div style="border-radius: .7rem;background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/slides/" . $slides->gambar ?>);background-size: cover;height: 200px;">
  
                </div>
                <div class="card-body">
                  <div class="content-berita__info">
                  <p style="color: #333333; margin-bottom: .5rem; font-size: .9rem" :hover="color: #333333">
                <?= $setting->getDescription() ?> <a href="<?= Url::to(['home/about']) ?>" style="color: #d07500;"><?= Yii::t("cruds", "Baca Selengkapnya") ?></a>
              </p>
                  </div>
                </div>
              </div>
            <!-- </a> -->
          </div>
      </div>
    <hr>
    <?php /*
    <h3 class="mt-4 mb-4" style="margin-left:10px;color: #F5AE3D;font-size:1.4rem"><?= Yii::t("cruds", "Berita Lainnya") ?></h3>
      <div class="row">
        <?php foreach ($news as $berita) { ?>
          <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mt-3">
            <a href="<?= \Yii::$app->request->baseUrl . "/detail-berita?id=" . $berita->slug ?>">
              <div class="card h-100 card_berita">
                <!-- <img src="" class="card-img-top" alt="..."> -->
                <div style="border-radius: .7rem;background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/berita/" . $berita->gambar ?>);background-size: cover;height: 200px;">
  
                </div>
                <div class="card-body">
                  <h6 class="card-title"><?= $berita->getShowTitle() ?></h6>
                  <div class="content-berita__info">
                    <hr>
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-6 text-left">
                        <?= date("d M Y", strtotime($berita->created_at)); ?>
                      </div>
                      <div class="col-lg-6 col-md-6 col-6 text-right">
                        <?= $berita->kategoriBerita->nama ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php } ?>
      </div>
      */ ?>
  </div>
</div>

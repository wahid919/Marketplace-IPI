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

  .kategori {
    margin: 1% 5% 5% 5%;
  }

  .bg-overlay::before {
    background-image: linear-gradient(to left, rgba(245, 246, 252, 0.52), rgb(159 8 7 / 0%));
  }

  @media screen and (min-width: 1200px) {

    #grad1 {
      height: 375px;
    }

    .card {
      height: 429.69px;
    }

    .slider-1 .slide-item {
      max-height: 429.69px;
    }

    .slider .slide-item {
      min-height: 429.69px;
    }

    .nilai .card {
      height: 214.6px;
    }
  }

  @media screen and (max-width: 540px) {

    .slide__content {
      margin-top: 4%;
    }

    .kategori {

      margin: 5% 5% 5% 5%;
    }

    .btn {
      line-height: 38px;
    }

    .nilai {
      display: none;
    }

    .slider-1 .slide-item {
      max-height: 250px;
    }

    .slider .slide-item {
      min-height: 250px;
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
    width: 100%;
    border-bottom-left-radius: 6%;
    border-top-left-radius: 6%;
  }

  .harga {
    pointer-events: none;
  }
</style>
<?php /*
<section id="slider3" class="slider slider-3">
  <div class="carousel owl-carousel carousel-arrows carousel-dots" data-slide="1" data-slide-md="1" data-slide-sm="1" data-autoplay="true" data-nav="true" data-dots="false" data-space="0" data-loop="true" data-speed="3000" data-transition="fade" data-animate-out="fadeOut" data-animate-in="fadeIn">
    <?php foreach($slider as $slides){ ?>
    <div class="slide-item align-v-h bg-overlay">
      <!-- <div class="bg-img"><img src="assets/images/sliders/3.jpg" alt="slide img"></div> -->
      <div class="bg-img"><img src="<?= Yii::$app->request->baseUrl . '/uploads/slides/' . $slides->gambar ?>" alt="background"></div>
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
<hr class="mt-0">
<!-- Product Section Begin -->
<section class="product spad" style="padding-top: 2%;">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-5">
        <div class="sidebar">
          <div class="blog__sidebar__search">
            <form action="#">
              <input type="text" placeholder="Search...">
              <button type="submit"><span class="icon_search"></span></button>
            </form>
          </div>
          <div class="blog__sidebar__item">
            <h4>Categories</h4>
            <ul>
              <li><a href="#">All</a></li>
              <?php
              foreach ($kategoris as $kategori) {  ?>
                <li><a href="<?= \Yii::$app->request->baseUrl . "/home/produk?kategori=" . $kategori->nama ?>"><?= $kategori->nama ?></a></li>
              <?php } ?>
            </ul>
          </div>
          <!-- <div class="sidebar__item">
            <h4>Price</h4>
            <div class="price-range-wrap">
              <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="10" data-max="540">
                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
              </div>
              <div class="range-slider">
                <div class="price-input">
                  <input type="text" id="minamount">
                  <input type="text" id="maxamount">
                </div>
              </div>
            </div>
          </div>
          <div class="sidebar__item sidebar__item__color--option">
            <h4>Colors</h4>
            <div class="sidebar__item__color sidebar__item__color--white">
              <label for="white">
                White
                <input type="radio" id="white">
              </label>
            </div>
            <div class="sidebar__item__color sidebar__item__color--gray">
              <label for="gray">
                Gray
                <input type="radio" id="gray">
              </label>
            </div>
            <div class="sidebar__item__color sidebar__item__color--red">
              <label for="red">
                Red
                <input type="radio" id="red">
              </label>
            </div>
            <div class="sidebar__item__color sidebar__item__color--black">
              <label for="black">
                Black
                <input type="radio" id="black">
              </label>
            </div>
            <div class="sidebar__item__color sidebar__item__color--blue">
              <label for="blue">
                Blue
                <input type="radio" id="blue">
              </label>
            </div>
            <div class="sidebar__item__color sidebar__item__color--green">
              <label for="green">
                Green
                <input type="radio" id="green">
              </label>
            </div>
          </div>
          <div class="sidebar__item">
            <h4>Popular Size</h4>
            <div class="sidebar__item__size">
              <label for="large">
                Large
                <input type="radio" id="large">
              </label>
            </div>
            <div class="sidebar__item__size">
              <label for="medium">
                Medium
                <input type="radio" id="medium">
              </label>
            </div>
            <div class="sidebar__item__size">
              <label for="small">
                Small
                <input type="radio" id="small">
              </label>
            </div>
            <div class="sidebar__item__size">
              <label for="tiny">
                Tiny
                <input type="radio" id="tiny">
              </label>
            </div>
          </div> -->
          <div class="sidebar__item">
            <div class="latest-product__text">
              <h4>Latest Products</h4>
              <div class="sidebar__item">
                <div class="latest-product__slider owl-carousel" display="2" data-slide-auto="3" data-slide-xs="3" data-slide-md="3" data-slide-sm="3" data-slide-lg="3" data-slide-xl="3" data-autoplay="true" data-nav="" data-dots="false" data-space="20" data-loop="true" data-speed="700">
                  <?php foreach ($produkterbaru as $pro) { ?>
                    <div class="latest-product__slider__item" display="3" data-slide-auto="3" data-slide-xs="3" data-slide-md="3" data-slide-sm="3" data-slide-lg="3" data-slide-xl="3">
                      <a href="#" class="latest-product__item">
                        <div class="latest-product__item__pic">
                          <img src="<?= \Yii::$app->formatter->asMyImage("banner_produk/$pro->foto_banner", false, "logo.png;") ?>" alt="">
                        </div>
                        <div class="latest-product__item__text">
                          <h6><?= $pro->nama ?></h6>
                          <span><?= $pro->harga ?></span>
                        </div>
                      </a>
                    </div>
                  <?php } ?>
                </div>
                <script>
                  $(document).ready(function() {

                    $(".owl-carousel").owlCarousel({

                      autoPlay: 3000,
                      items: 3,
                      itemsDesktop: [1199, 3],
                      itemsDesktopSmall: [979, 3],
                      center: true,
                      nav: true,
                      loop: true,
                      responsive: {
                        600: {
                          items: 3
                        }
                      }






                    });

                  });
                </script>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-9 col-md-7">
        <div class="product__discount">
          <div class="section-title product__discount__title">
            <h2>Sale Off</h2>
          </div>
          <div class="row">
            <div class="product__discount__slider owl-carousel">
              <div class="col-lg-4">
                <div class="product__discount__item">
                  <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/pd-2.jpg">
                    <div class="product__discount__percent">-20%</div>
                    <ul class="product__item__pic__hover">
                      <li><a href="#"><i class="fa fa-heart"></i></a></li>
                      <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                      <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                  </div>
                  <div class="product__discount__item__text">
                    <span>Vegetables</span>
                    <h5><a href="#">Vegetables’package</a></h5>
                    <div class="product__item__price">$30.00 <span>$36.00</span></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="product__discount__item">
                  <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/pd-3.jpg">
                    <div class="product__discount__percent">-20%</div>
                    <ul class="product__item__pic__hover">
                      <li><a href="#"><i class="fa fa-heart"></i></a></li>
                      <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                      <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                  </div>
                  <div class="product__discount__item__text">
                    <span>Dried Fruit</span>
                    <h5><a href="#">Mixed Fruitss</a></h5>
                    <div class="product__item__price">$30.00 <span>$36.00</span></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="product__discount__item">
                  <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/pd-4.jpg">
                    <div class="product__discount__percent">-20%</div>
                    <ul class="product__item__pic__hover">
                      <li><a href="#"><i class="fa fa-heart"></i></a></li>
                      <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                      <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                  </div>
                  <div class="product__discount__item__text">
                    <span>Dried Fruit</span>
                    <h5><a href="#">Raisin’n’nuts</a></h5>
                    <div class="product__item__price">$30.00 <span>$36.00</span></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="product__discount__item">
                  <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/pd-5.jpg">
                    <div class="product__discount__percent">-20%</div>
                    <ul class="product__item__pic__hover">
                      <li><a href="#"><i class="fa fa-heart"></i></a></li>
                      <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                      <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                  </div>
                  <div class="product__discount__item__text">
                    <span>Dried Fruit</span>
                    <h5><a href="#">Raisin’n’nuts</a></h5>
                    <div class="product__item__price">$30.00 <span>$36.00</span></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="product__discount__item">
                  <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/pd-6.jpg">
                    <div class="product__discount__percent">-20%</div>
                    <ul class="product__item__pic__hover">
                      <li><a href="#"><i class="fa fa-heart"></i></a></li>
                      <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                      <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                  </div>
                  <div class="product__discount__item__text">
                    <span>Dried Fruit</span>
                    <h5><a href="#">Raisin’n’nuts</a></h5>
                    <div class="product__item__price">$30.00 <span>$36.00</span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="filter__item">
          <div class="row">
            <div class="col-lg-4 col-md-5" style="margin-top: -2%">
              <div class="section-title product__discount__title">

                <?php if ($get_id == !null) { ?>
                  <style>
                    h2 {
                      font-family: "Cairo", sans-serif;
                      color: #1c1c1c;
                      font-weight: 700;
                      position: relative;
                    }
                  </style>
                  <h2>
                    <?= $get_id->nama ?>
                  </h2>
                <?php } else { ?>
                  <style>
                    h2 {
                      font-family: " Cairo", sans-serif;
                      color: #1c1c1c;
                      font-weight: 700;
                      position: relative;
                    }
                  </style>
                  <h2>
                    All Prodcuts
                  </h2>
                <?php } ?>
                <!-- <span>Sort By</span>
                <select>
                  <option value="0">Default</option>
                  <option value="1">Default</option>
                </select> -->
              </div>
            </div>
            <div class="col-lg-4 col-md-4">
              <div class="filter__found">
                <!-- <h6><span>16</span> <?= $summary ?>Products found</h6> -->
              </div>
            </div>
            <div class="col-lg-4 col-md-3">
              <div class="filter__option">
                <h6><?= $summary ?></h6>
                <!-- <span class="icon_grid-2x2"></span>
                <span class="icon_ul"></span> -->
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <?php foreach ($produks as $data) { ?>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="product__item">
                <div class="product__item__pic program1-wrap" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $data->foto_banner ?>);    border-radius: 5%;background-position: center;background-repeat: no-repeat;background-size: cover;box-shadow: rgb(204 204 204) 12px 12px 9px;">
                  <ul class="product__item__pic__hover program__info">
                    <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li> -->
                    <li><a href="<?= Url::to(["detail-produk", "id" => $data->id]) ?>"><i class="fa fa-eye"></i></a></li>
                    <li><a href=""><i class="fa fa-shopping-cart btn-program" id="keranjang"></i></a></li>
                  </ul>
                </div>
                <div class="product__item__text">
                  <h6><a href="#"><?= $data->nama ?></a></h6>
                  <h5 class="harga"><?= $data->harga ?></h5>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.js">
        </script>
        <script>
          document.querySelector("#keranjang").addEventListener("click", () => {
            let jumlah = 0;
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
            <?php if (Yii::$app->user->identity->id == !null) { ?>
              $.ajax({
                url: `<?= Url::to(['add-keranjang', 'id' => $data->id]) ?>?jumlah=${jumlah}&selectsize=${selectsize}&selectwarna=${selectwarna}`,
                success: (response) => {
                  alert("Sukses menambahkan keranjang");
                  window.location = "<?= Yii::$app->request->baseUrl . "/home/keranjang" ?>";
                }
              })
            <?php } else { ?>
              $.ajax({
                success: (response) => {
                  alert("Silahkan Login Terlebih dahulu");
                  window.location = "<?= Yii::$app->request->baseUrl . "/home/login" ?>";
                }
              })
            <?php } ?>

          });
        </script>
        <div class="product__pagination">
          <?php echo \yii\widgets\LinkPager::widget([
            'pagination' => $pagination,
          ]); ?>
          <!-- <a href="#">1</a>
          <a href="#">2</a>
          <a href="#">3</a>
          <a href="#"><i class="fa fa-long-arrow-right"></i></a> -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Product Section End -->


<hr style="width:80%; margin-left:10% !important; margin-right:10% !important;border:1px solid #cb1d08;" />
<div class="mt-4 mb-4" style="padding-top: 5px;">
  <div class="container mt-4 mb-4">
    <div class="slide-item align-v-h">
      <div class="container">
        <div class="row" style="margin-top: -1rem;">
          <div class="col-sm-12 col-md-12 col-lg-8 pb-20">
            <!-- <div class="card img-fluid" style="border-radius: 10px;">
    <img class="card-img-top" src="https://www.tutorialspoint.com/avro/images/apache-avro-mini-logo.jpg" alt="Card image" style="width:100%">
    <div class="card-img-overlay">
      <h4 class="card-title">Avro</h4>
      <p class="card-text">Tutorial for Apache Avro</p>
      <a href="#" class="btn btn-info">Learn</a>
    </div>
  </div> -->
            <section id="slider1" class="slider slider-1 card">
              <div class="owl-carousel thumbs-carousel carousel-arrows" data-slider-id="slider1" data-dots="false" data-autoplay="true" data-nav="true" data-transition="fade" data-animate-out="fadeOut" data-animate-in="fadeIn">
                <?php foreach ($slider as $slides) { ?>
                  <div class="slide-item align-v-h bg-overlay">
                    <div class="bg-img"><img src="<?= Yii::$app->request->baseUrl . '/uploads/slides/' . $slides->gambar ?>" alt="slide img" class="responsive" style="width:100%;height: auto;"></div>
                    <div class="card-body">
                      <div>
                        <a href="#" class="btn btn__hover3 mb-20" style="background-color: rgb(247 247 247 / 76%);border-radius:10px;border:rgb(247 247 247 / 76%);width: 100%;height: 100%;">
                          <h3>UMKM Kerjainan Kayu Kota Batu

                            <p>Telusuri Keunikan Kerjinan berbahan dasar kayu dari Kota batu</p>
                          </h3>
                        </a>
                      </div>

                    </div>
                  </div><!-- /.slide-item -->
                <?php } ?>



              </div><!-- /.carousel -->

            </section><!-- /.slider -->
          </div>
          <div class="col-sm-12 col-md-12 col-lg-4 pt-10 nilai">
            <div class="slide__content">
              <div class="card" style="border-radius: 10px;">
                <div class="card-body" style="background-image: url('<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $produks->foto_banner ?>');color:white;border-radius:10px;border:#cb1d08;background-size: cover;background-position: center center;">
                  <div style="margin-top:17%;">
                    <a href="#" class="btn btn__hover3 mb-20" style="background-color: rgb(247 247 247 / 76%);border-radius:10px;border:rgb(247 247 247 / 76%);width: 100%;height: 100%;">Tanaman Hias UMKM</a>
                  </div>

                </div>
              </div>
            </div><!-- /.slide-content -->
            <div class="slide__content">
              <div class="card" style="border-radius: 10px;">
                <div class="card-body" style="background-image: url('<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $produks->foto_banner ?>');color:white;border-radius:10px;border:#cb1d08;background-size: cover;background-position: center center;">
                  <div style="margin-top:17%;">
                    <a href="#" class="btn btn__hover3 mb-20" style="background-color: rgb(247 247 247 / 76%);border-radius:10px;border:rgb(247 247 247 / 76%);width: 100%;height: 100%;">Tanaman Hias UMKM</a>
                  </div>

                </div>
              </div>
            </div><!-- /.slide-content -->
          </div><!-- /.row -->
        </div><!-- /.container -->
      </div><!-- /.slide-item -->
    </div>
  </div>



</div><!-- /.carousel -->

<!-- Kategori -->
<div class="mt-4 mb-4 pt-20 pb-20">
  <div class="container mt-4 mb-4">
    <div class="slide-item align-v-h">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-6 col-sm-12">
            <div class="row">
              <div class="col-lg-6">

                <h2 class="text-left font-weight-bold" style="color:#08150a">Kategori</h2>
              </div>
            </div>

            <div class="row">
              <?php
              foreach ($kategoris as $kategori) { ?>


                <!-- <div class="col-lg-2"> -->
                <div class="card kategori" style="height: 45px;border: 1px solid transparent;">
                  <a href="<?= \Yii::$app->request->baseUrl . "/home/list-produk?kategori=" . $kategori->nama ?>">
                    <div class="card" style="color:#cb1d08;background-color: white;width:45px;height:45px;border-color:#cb1d08;margin-left:auto;margin-right:auto;">

                      <div class="card-body" style="margin-top: -8px;margin-left:-6px;">

                        <i class="fa <?= $kategori->icon ?>"></i>
                      </div>
                    </div>
                  </a>
                  <p style="margin-top: 5%;"><b><?= $kategori->nama ?></b></p>
                </div>

                <!-- </div> -->
              <?php }
              /*
              foreach ($kategoris as $kategori) { ?>


                <div class="col-lg-3">
                  <div class="card" style="background-color: #cb1d08;width:45px;height:45px;">
            <div class="card-body" style="margin-top: -8px;margin-left:-4px;">
              <a href="<?= $setting->facebook ?>" target="_blank"><i class="<?=$kategori->icon ?>"></i></a>
            </div>
            <h6><?= $kategori->nama ?></h6>
                </div>

                </div>
              <?php }*/ ?>
            </div>
          </div>
        </div><!-- /. -->
      </div><!-- /.slide-item -->
    </div>
  </div>



</div><!-- /.carousel -->
<!-- Terbaru Di IKM Kota Batu -->
<div class="mt-4 mb-4 pt-20 pb-20">
  <div class="container mt-4 mb-4">
    <div class="slide-item align-v-h">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-6 col-sm-12">
            <div class="row">
              <div class="col-lg-6">

                <h2 class="text-left font-weight-bold" style="color:#08150a">Terbaru di IKM Kota Batu</h2>
              </div>
              <div class="col-lg-3"></div>
              <div class="col-lg-3" align="right">
                <a href="<?= Yii::$app->request->baseUrl . "/home/list-produk" ?>" style="color: #cb1d08;">
                  Lihat Semua
                </a>
              </div>
            </div>

            <div class="row">
              <?php
              foreach ($produks as $data) { ?>


                <div class="col-lg-4 col-md-4 mt-4">
                  <!-- <div class="card h-100 card_berita"> -->
                  <div class="card h-100 card_beritas" align="center" style="border-bottom-right-radius: 5%;border-top-right-radius: 5%;">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="gmbr" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $data->foto_banner ?>);">
                        </div>
                      </div>
                      <div class="col-lg-5" align="center" style="padding-top: 5%;">

                        <h6 class="card-title"><?= $data->nama ?></h6>
                        <h6 class="card-title">
                          <?= \app\components\Angka::toReadableHarga($data->harga); ?>
                        </h6>
                        <a href="<?= Url::to(["detail-produk", "id" => $data->id]) ?>" class="btn btn__primary btn__hover3 mb-20" style="background-color: #cb1d08;border-radius:10px;border:#cb1d08;width: 50%;height: 30%;">Beli</a>

                      </div>
                    </div>

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
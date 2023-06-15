<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Berita;
use app\models\ProductDetail;
use yii\bootstrap\ActiveForm;
use richardfan\widget\JSRegister;
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
                <div class="latest-product__slider owl-carousel" data-items="3">
                  <?php
                  $counter = 0;
                  foreach ($produkterbaru as $pro) {
                    $minimumprice = ProductDetail::find()->where(['id_product' => $pro->id])->min('harga');
                    $maximumprice = ProductDetail::find()->where(['id_product' => $pro->id])->max('harga');
                    $averageprice = ProductDetail::find()->where(['id_product' => $pro->id])->average('harga');
                    if ($counter % 3 === 0) {
                      echo '<div class="latest-product__slider__item">';
                    }
                  ?>
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
                    <a href="#" class="latest-product__item">
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
          <?php foreach ($produks as $data) {
            $minimumprice = ProductDetail::find()->where(['id_product' => $data->id])->min('harga');
            $maximumprice = ProductDetail::find()->where(['id_product' => $data->id])->max('harga');
            $averageprice = ProductDetail::find()->where(['id_product' => $data->id])->average('harga');
          ?>
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
                  <h5 class="harga"><?= \app\components\Angka::toReadableHarga($averageprice); ?></h5>
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
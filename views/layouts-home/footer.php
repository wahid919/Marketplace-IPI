<?php
$setting = app\models\Setting::find()->one();
$icons = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;
?>
<style>
  @media (min-width:394px) {
    .tengah {
      margin-left: 1rem;
      margin-right: 1rem
    }
  }
</style>
<!-- Footer Ogani -->
<!-- Footer Section Begin -->
<footer id="footer" class="footer spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="footer__about">
          <div class="footer__about__logo">
            <div class="row">
              <div class="col-4">
                <a href="<?= Yii::$app->request->baseUrl ?>"><img style="    max-width: 150%;position: inherit;margin-top: -54%;margin-left: -71%;" src="<?= $icons ?>" alt="">
                </a>
              </div>
              <div class="col-8">
                <a href="<?= Yii::$app->request->baseUrl ?>">
                  <style>
                    h5:hover {
                      color: white;
                      /* text-decoration: none; */
                    }
                  </style>
                  <h5 style="margin-left: -15%; margin-top: -3%; color: #037a20"><strong><b>Ikatan Pesantren Indonesia</b></strong></h5>
                </a>
              </div>
            </div>
          </div>
          <ul>
            <li>Address: 60-49 Road 11378 New York</li>
            <li>Phone: <?= $setting->telepon ?></li>
            <li>Email: <?= $setting->email ?></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
        <div class="footer__widget">
          <h6>Useful Links</h6>
          <ul>
            <li><a href="<?= Yii::$app->request->baseUrl ?>">Home</a></li>
            <li><a href="<?= Yii::$app->request->baseUrl . "/home/about" ?>">About Our Shop</a></li>
            <li><a href="<?= Yii::$app->request->baseUrl . "/home/product" ?>">Secure Shopping</a></li>
            <li><a href="#">Delivery infomation</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Our Sitemap</a></li>
          </ul>
          <ul>
            <li><a href="#">Who We Are</a></li>
            <li><a href="#">Our Services</a></li>
            <li><a href="#">Projects</a></li>
            <li><a href="<a href=" <?= Yii::$app->request->baseUrl . "/home/kontak" ?>">Contact</a></li>
            <li><a href="#">Innovation</a></li>
            <li><a href="#">Testimonials</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-4 col-md-12">
        <div class="footer__widget">
          <h6>Join Our Newsletter Now</h6>
          <p>Get E-mail updates about our latest shop and special offers.</p>
          <form action="#">
            <input style="display: -webkit-inline-box;" type="text" placeholder="Enter your mail">
            <button type="submit" class="site-btn">Subscribe</button>
          </form>
          <div class="footer__widget__social">
            <a href="<?= $setting->facebook ?>"><i class="fa fa-facebook"></i></a>
            <a href="<?= $setting->instagram ?>"><i class="fa fa-instagram"></i></a>
            <a href="<?= $setting->twitter ?>"><i class="fa fa-twitter"></i></a>
            <!-- <a href="#"><i class="fa fa-pinterest"></i></a> -->
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="footer__copyright">
          <div class="footer__copyright__text">
            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;<script>
                document.write(new Date().getFullYear());
              </script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
          <!-- <div align="right" class=""><img src="../../web/uploads/payment-item.png" alt="" style="width: 10%;"></div> -->
          <div style="" class="footer__copyright__payment"><img src="../../web/uploads/paymentitem.png" alt=""></div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Footer Section End -->
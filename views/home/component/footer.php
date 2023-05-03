<?php
$setting = app\models\Setting::find()->one();
$icons = \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo;
?>
<footer id="footer" class="footer mt-4">
  <div class="footer-newsletter">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-3 col-lg-4 footer__widget footer__widget-about">
          <div class="footer__widget-content">

            <ul class="list-unstyled">
              <li class="media">
                <img src="<?= $icons ?>" class="mr-3" alt="ISALAM" width="50px">
                <div class="media-body">
                  <h5 class="mt-0 mb-1 text-footer-about"><?= $setting->judul_web ?></h5>
                </div>
              </li>
            </ul>
            <p style="margin-right: 30px;" class="pt-3 text-justify">
              <?= $setting->slogan_web ?>
            </p>
          </div>
        </div><!-- /.col-lg-4 -->
        <div class="col-12 col-sm-12 col-md-5 col-lg-4 footer__widget footer__widget-about">
          <div class="footer__widget-content">
            <h5 class="mt-0 mb-1 text-footer-about" style="color:orange;">Lebih Dekat dengan Kami</h5>
            <p>Ikuti Sosial Media Kami untuk Informasi lebih update dan Terbaru.</p>
            <ul class="contact__list list-unstyled">
              <center>

                <div class="social__icons">
                  <a href="<?= $setting->facebook ?>" target="_blank"><i class="fab fa-facebook-f fa-lg"></i></a>
                  <a href="<?= $setting->twitter ?>" target="_blank"><i class="fab fa-twitter fa-lg"></i></a>
                  <a href="<?= $setting->instagram ?>" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>
                  <a href="<?= $setting->telegram ?>" target="_blank"><i class="fab fa-telegram-plane fa-lg"></i></a>
                </div><!-- /.col-xl-2 -->
              </center>
            </ul>
          </div>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4 footer__widget footer__widget-about">
          <div class="footer__widget-content">
            <div id="map-canvas" style="height: 200px; width: 100%"></div>
          </div>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container -->
  </div><!-- /.footer-top -->
  <div class="footer-bottom">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-sm-12 col-md-6 col-lg-6">
          <div class="footer__copyright">
            <span>&copy;<?= date('Y'); ?> <?= $setting->nama_web ?> </span>
          </div><!-- /.Footer-copyright -->
        </div><!-- /.col-lg-6 -->
        <div class="col-sm-12 col-md-6 col-lg-6">
          <nav>
            <ul class="list-unstyled footer__copyright-links d-flex flex-wrap justify-content-end">
              <li><a href="#">Terms & Conditions </a></li>
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Sitemap</a></li>
            </ul>
          </nav>
        </div><!-- /.col-lg-6 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </div><!-- /.Footer-bottom -->
</footer><!-- /.Footer -->
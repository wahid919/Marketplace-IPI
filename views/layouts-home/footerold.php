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
<footer id="footer" class="footer">

    <div class="footer-top" style="background-color: #f6d8d5;color:black">
        <div class="container">
            <div class="row">

                <div class="col-12 col-sm-12 col-md-5 col-lg-4 footer__widget footer__widget-about">
                    <div class="footer__widget-content">
                        <h5 class="mt-0 mb-1 text-footer-about" style="color:red;">Marketplace IPI</h5>
                        <p>Ikuti Sosial Media Kami untuk Informasi lebih update dan Terbaru.</p>
                        <ul class="contact__list list-unstyled">
                            <!-- <center> -->
                            <div class="row">
                                <div class="col-md-1">
                                    <i class="fas fa-envelope fa-lg" style="color: red;"> </i>
                                </div>
                                <div class="col-md-11" style="margin-top:-0.25rem;">
                                    <p><?= $setting->email ?></p>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    <i class="fas fa-phone fa-lg" style="color: red;"> </i>
                                </div>
                                <div class="col-md-11" style="margin-top:-0.25rem;">
                                    <p><?= $setting->telepon ?></p>

                                </div>
                            </div>

                            <!-- </center> -->
                        </ul>
                    </div>
                </div>

                <!-- <div class="col-6 col-sm-12 col-md-4 col-lg-1 footer__widget footer__widget-nav">
        </div> -->
                <div class="col-6 col-sm-12 col-md-4 col-lg-3 footer__widget footer__widget-nav">
                    <!-- <h6 class="footer__widget-title txt">Halaman</h6> -->
                    <div class="footer__widget-content">

                        <h5 class="mt-0 mb-1 text-footer-about" style="color:black;">Halaman</h5>
                        <p style="margin-right: 30px; margin-bottom: -10px;" class="pt-3 text-justify">
                            <a href="<?= Yii::$app->request->baseUrl ?>" style="color:black"> Home
                            </a>
                        </p>
                        <p style="margin-right: 30px; margin-bottom: -10px;" class="pt-3 text-justify">
                            <a href="<?= Yii::$app->request->baseUrl . "/home/about" ?>" style="color:black"> About
                            </a>
                        </p>
                        <p style="margin-right: 30px; margin-bottom: -10px;" class="pt-3 text-justify">
                            <a href="<?= Yii::$app->request->baseUrl . "/home/product" ?>" style="color:black"> Product
                            </a>
                        </p>
                        <p style="margin-right: 30px; margin-bottom: -10px;" class="pt-3 text-justify">
                            <a href="<?= Yii::$app->request->baseUrl . "/home/kontak" ?>" style="color:black"> Contact
                            </a>
                        </p>
                    </div><!-- /.footer-widget-content -->
                </div><!-- /.col-lg-4 -->
                <div class="col-6 col-sm-12 col-md-4 col-lg-4 footer__widget footer__widget-nav">
                    <!-- <h2 class="footer__widget-title txt">Kunjungi Sosial Media Kami</h2> -->
                    <div class="footer__widget-content">

                        <h5 class="mt-0 mb-1 text-footer-about" style="color:black;">Ikuti Sosial Media Kami</h5>
                        <ul class="contact__list list-unstyled" style="margin-top:1.5rem;">
                            <center>

                                <div class="social__icons">
                                    <div class="card" style="background-color: #cb1d08;width:45px;height:45px;">
                                        <div class="card-body" style="margin-top: -8px;margin-left:-4px;">
                                            <a href="<?= $setting->facebook ?>" target="_blank"><i class="fab fa-facebook-f fa-lg"></i></a>
                                        </div>
                                    </div>
                                    <div class="card tengah" style="background-color: #cb1d08;width:45px;height:45px;">
                                        <div class="card-body" style="margin-top: -8px;margin-left:-6px;">
                                            <a href="<?= $setting->twitter ?>" target="_blank"><i class="fab fa-twitter fa-lg"></i></a>
                                        </div>
                                    </div>
                                    <div class="card" style="background-color: #cb1d08;width:45px;height:45px;">
                                        <div class="card-body" style="margin-top: -8px;margin-left:-6px;">
                                            <a href="<?= $setting->instagram ?>" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>
                                        </div>
                                    </div>
                                </div><!-- /.col-xl-2 -->
                            </center>
                        </ul>
                    </div>
                </div><!-- /.col-lg-4 -->

            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
    <!-- /.footer-top -->


    <!-- /.footer-top -->

    <div class="footer-bottom" style="background-color: #f6d8d5;color:black">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="footer__copyright">
                        <span>&copy; <?= date('Y') ?>, Marketplace IPI</span>
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

    <!-- Footer Ogani -->
    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="<?= Yii::$app->request->baseUrl ?>">Home</a></li>
                            <li><a href="<?= Yii::$app->request->baseUrl . "/home/about" ?>">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
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
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
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
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
</footer><!-- /.Footer -->
<?php

use app\models\Toko;
use app\models\User;
use app\models\Alamat;

$setting = app\models\Setting::find()->one();

?>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    .flip-card {
        background-color: transparent;
        width: 350px;
        height: 218px;
        perspective: 1000px;
    }

    .flip-card-inner {
        position: relative;
        border-radius: 0.7rem;
        width: 350px;
        height: 200px;
        text-align: center;
        transition: transform 0.6s;
        transform-style: preserve-3d;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }

    .flip-card:hover .flip-card-inner {
        transform: rotateY(180deg);
    }

    .flip-card-front,
    .flip-card-back {
        position: absolute;
        border-radius: 0.7rem;
        width: 350px;
        height: 200px;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }

    .flip-card-front {
        border-radius: 0.7rem;
        background-image: url(<?= \Yii::$app->request->baseUrl . "/KTA2.jpg" ?>);
        background-size: cover;
        width: 350px;
        height: 200px;
    }

    .flip-card-back {
        border-radius: 0.7rem;
        background-image: url(<?= \Yii::$app->request->baseUrl . "/KTS_BACK2.jpg" ?>);
        background-size: cover;
        width: 350px;
        height: 200px;
        transform: rotateY(180deg);
    }

    .product__discount__title {
        /* text-align: left; */
        margin-bottom: 2px;
        text-align: center;
    }

    .section-title h2 {
        color: #1c1c1c;
        font-weight: 700;
        position: relative;
    }

    .section-title h2:after {
        position: absolute;
        left: 0;
        bottom: -15px;
        right: 0;
        height: 4px;
        width: 80px;
        background: white;
        content: "";
        margin: 0 auto;
    }
</style>
<div class="product_discount">
    <div class="section-title product__discount__title">
        <h2>Member Of IPI</h2>
    </div>
</div>
<div class="container">
    <div class="row">
        <?php foreach ($member as $mem) {
            $user = User::find()->where(['id' => $mem->id_user])->one();
            $alamat = Alamat::find()->where(['usrid' => $user->id])->one();
            $pesantren = Toko::find()->where(['id_user' => $mem->id])->one();
        ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 kta" style="padding: 20px;">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img style="
      width: 27%;
position: relative;
margin-top: 4.3%;
margin-left: -55%;" src="<?= \Yii::$app->request->baseUrl . "/uploads/setting/" . $setting->logo ?>" alt="">
                            <div class="col-12" style="
color: #8fc543;
position: relative;
margin-top: -22.8%;
font-size: 23px;
margin-left: -9%;
font-weight: 700;">IPI</div>

                            <div class="col-6" style="
    color: #adc391;
position: relative;
font-size: 16px;
margin-left: 33%;
font-weight: 700;
margin-top: 0%;
text-align: left;
line-height: 17px;">Ikatan Pesantren Indonesia
                            </div>
                            <div class="col-3"></div>
                            <div class="col-3"></div>
                        </div>
                        <div class="flip-card-back">
                            <div class="row">
                                <div class="col-6">
                                    <div class="col-12">
                                        <img style="
          width: 48%;
position: relative;
margin-top: 64.3%;
margin-left: -43%;" src="<?= \Yii::$app->request->baseUrl . "/logoback1.png" ?>" alt="">
                                    </div>
                                    <div class="col-12" style="
                                                color: #5c891c;
                                margin-left: -17%;
                                font-weight: 700;
                                font-size: 14px;
                                        ">
                                        IPI
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12" style="
                                                text-align: left;
                                color: #5c891c;
                                text-transform: uppercase;
                                font-weight: 700;
                                margin-top: 4%;
                                font-size: 12px;
                                margin-left: 2%;
                                line-height: initial;
                                height: 33px;
                                            ">
                                            <?= $mem->nama ?>
                                        </div>
                                        <div class="col-2"></div>
                                        <div class="col-10" style="
                                                    text-align: left;
                                    color: #98bc57;
                                    /* text-transform: uppercase; */
                                    margin-top: 8%;
                                    font-weight: 700;
                                    font-size: 9px;
                                    line-height: initial;
                                                ">
                                            <?= $user->name ?>
                                        </div>
                                        <div class="col-2"></div>
                                        <div class="col-10" style="
                                                    text-align: left;
                                    color: black;
                                    /* text-transform: uppercase; */
                                    font-weight: 500;
                                    font-size: 9px;
                                    line-height: initial;
                                    height: 25px;
                                                ">
                                            pengurus
                                        </div>
                                        <div class="col-2"></div>
                                        <div class="col-10" style="
                                                text-align: left;
                                color: #888687;
                                /* text-transform: uppercase; */
                                /* font-weight: 500; */
                                font-size: 9px;
                                line-height: initial;
                                height: 39px;
                                            ">
                                            <?= $mem->alamat ?>
                                        </div>
                                        <div class="col-2"></div>
                                        <div class="col-10" style="
                                            text-align: left;
                            color: #888687;
                            /* text-transform: uppercase; */
                            /* font-weight: 500; */
                            font-size: 9px;
                            line-height: initial;
                            height: 29px;
                                        ">
                                            <?= $user->username ?>
                                        </div>
                                        <div class="col-2"></div>
                                        <div class="col-10" style="
                            text-align: left;
                            color: #888687;
                            /* text-transform: uppercase; */
                            /* font-weight: 500; */
                            font-size: 9px;
                            line-height: initial;
        ">
                                            <?= $user->nomor_handphone ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="text-align: center;font-size: 115%;">
                    <?= $mem->nama ?>
                </div>
            </div>
        <?php } ?>

        <div class="product__pagination col-12 d-flex justify-content-end" style="padding-bottom: 2%; padding-top: 2%">
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
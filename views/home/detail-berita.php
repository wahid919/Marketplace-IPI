<?php if (Yii::$app->session->hasFlash('success')) : ?>
            <div class="alert alert-success alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
              <p><i class="icon fa fa-check"></i>Saved!</p>
              <?= Yii::$app->session->getFlash('success') ?>
            </div>
          <?php endif; ?>
 <?php if (Yii::$app->session->hasFlash('error')) : ?>
            <div class="alert alert-danger alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
              <h4><i class="icon fa fa-close"></i>Not Saved!</h4>
              <?= Yii::$app->session->getFlash('error') ?>
            </div>
          <?php endif; ?>
<?php

            use app\components\Tanggal;
            use app\models\Berita;
            use yii\helpers\Html;

 $this->registerCss("
.text-primary {
  color: rgb(245, 174, 61) !important;
}
.content-berita__info {
  color: #F1A527;
  font-size: .6rem;
  position: absolute;
  bottom: 0;
  left: 1.25rem;
  right: 1.25rem;
  padding-bottom: .5rem;
}
.card_berita {
  border-radius: .7rem;
  box-shadow: 0 0 3px 0px #dedede;
}
.card-title {
  font-size: 1.1rem;
  color: #666;
  margin-bottom: 3rem;
}
.komen {
  padding: 30px 60px;
}
.friend img {
  height: 70px;
  width: 100px;
  display: block;
  float: left;
  border-radius :2%;
  }
.friend {
  margin-top:1rem;
  margin-left:1.7rem;
  margin-bottom:1rem;
}
.friend h3{
  font-size: 20px;
  font-weight:400;
}
") ?>
<style>
  .sosmed_inline {
    font-size: 25px;
    color: #0a3c8b;
    font-family: "Poppins", sans-serif;
    text-transform: capitalize;
    font-weight: 600;
    line-height: 1.1;
    margin-bottom: 10px;
  }
  .sosmed_inline img{
   display:inline;
   margin:2px;
   /* border-radius:4px; */
   border-radius: 100%;
   width:44px;
   opacity:1;
   cursor:pointer;
}
.sosmed_inline img:hover{
   opacity:0.8;
   transform:scale(1.1);
}
.conten {
    clear: both;
    padding: 1px 0 0 0;
  }
  .logo {
    width: 283px;
    height: 70px;
    margin: 20px auto;
    background-image: url('https://tribratanewspolrestasidoarjo.com/img/berita/Berita-20210706085545.jpg');
    background-size: cover;
    background-position: center center;
  }

@media screen and (min-width: 525px) {
  .ad {
    height: 90px;
  }
  .conten {
    padding: 0 25px;
  }
  .logo {
    float: left;
  }
  /* h2 {
    float: right;
    background-color: rgba(255,255,255,.25);
  } */
}
@media screen and (min-width: 1200px) {
  .ad {
    height: 90px;
  }
  .conten {
    padding: 0 25px;
  }
  .logo {
    float: left;
    width: 1200px;
    height: 80px;
    margin: 20px 0 0 20px auto;
  }
  /* h2 {
    float: right;
    background-color: rgba(255,255,255,.25);
  } */
}
</style>

<hr class="mt-0">
<div class="mt-4 mb-4">
  <div class="container mt-4 mb-4">
    <h2 class="heading__title mt-4 mb-2" style="font-size: 1.8rem;;color: #666"><?= $berita->judul ?></h2>
    <div class="row">
      <div class="col-md-7">
        <!-- <h2 class="heading__title mt-4 mb-2" style="font-size: 1.8rem;;color: #666"><?= $berita->judul ?></h2> -->
        <div class="row" style="font-size: .8rem;">
          <div class="col-lg-3 col-md-3" style="color: #666; font-weight:600">
            <i class="fa fa-user mr-1 text-primary"></i> <?= $berita->user ? $berita->user->name : "-" ?>
          </div>
          <div class="col-lg-9 col-md-4" style="color: #666; font-weight:600">
            <i class="fa fa-calendar mr-1 text-primary"></i> <?= \app\components\Tanggal::getDayName($berita->created_at,true); ?> ,<?= \app\components\Tanggal::toReadableDate($berita->created_at,false) ?>
          </div>
          <div class="col-md-3" style="color: #666; font-weight:600;margin-top:5px;">
            <i class="fa fa-eye mr-1 text-primary"></i> <?= $berita->view_count ?> <?= Yii::t("cruds", "kali dilihat") ?>
          </div>
          <div class="col-md-3" style="color: #666; font-weight:600;margin-top:5px;">
          <div class="row">
          <?php
          $data = \app\models\Like::find()->where(['user_id' => Yii::$app->user->id, 'post_id' => $berita->id])->one();
          
          ?>
            <div style="margin-left:17px;">
            <?php if($data->like == 1){ ?>
              <?= Html::a('<i class="fa fa-thumbs-up" aria-hidden="true" style="color:orange;"></i>', ['home/test-pjax1','post_id'=>$berita->id ,'like' => 2, ]) ?>
            <?php }else{ ?>
              <?= Html::a('<i class="fa fa-thumbs-up" aria-hidden="true"></i>', ['home/test-pjax1','post_id'=>$berita->id ,'like' => 1, ]) ?>
            <?php } ?>
            </div>
            <div style="margin-left:10px;">
            <?php if($data->like == 3){ ?>
              <?= Html::a('<i class="fa fa-thumbs-down" aria-hidden="true" style="color:orange;"></i>', ['home/test-pjax1', 'post_id'=>$berita->id ,'like' => 4, ]) ?>
            <?php }else { ?>
              <?= Html::a('<i class="fa fa-thumbs-down" aria-hidden="true"></i>', ['home/test-pjax1', 'post_id'=>$berita->id ,'like' => 3, ]) ?>
              <?php } ?>

            </div>
              

          </div>

          </div>

        </div>
      </div>
      <div class="col-md-5"></div>
    </div>
    <br>
    <div style="background-image: url(<?= Yii::$app->formatter->asMyImage("berita/" . $berita->gambar, false, "logo.png") ?>);background-position: center;background-size:cover;border-radius: 1rem;width:100%;height:35vw"></div>
    <span style="font-size: .8rem"> <?= $berita->image_summary ?></span>
    <div class="row">

    
    <div class="col-lg-9 col-md-6 col-sm-12">
      <div style="margin-left : 10px;">
    
        <p class="mt-4 text-justify" style="font-size: .9rem;color:#888;">
          <?= $berita->isi ?>
        </p>
        
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 pt-30">
    <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <p class="text-left font-weight-bold" style="color: black;">
                  <?php 
    $ktg = $berita->kategoriBerita->nama;
    $newss = Berita::find()->where(['kategori_berita_id' => $berita->kategori_berita_id])->limit(3)->all();
    ?>
    <?= Yii::t("cruds", "$ktg Lainnya") ?>
                </p>
                  <h6 class="text-left" style="color:black;margin-top:-3%;">KORMI JAWA TIMUR</h6>
                </div>
                <hr>
                <!-- <div class="col-12 text-left border-top-2 mt-4 pt-4">
                </div> -->
                <?php foreach ($newss as $berita) { ?>
                  <div class="col-lg-12 col-md-12 mt-3">
                    <div class="card shadow-br2" style="border-radius: 15px;">
                      <a href="<?= \yii\helpers\Url::to(['home/detail-berita', 'id' => $berita->slug]) ?>">
                      <div class="team-img" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/berita/" . $berita->gambar ?>);border-radius: 15px;height:100px;width:auto">
                      </div>
                      </a>
                      <div class="card-body" style="margin-top: -10px;">
                        <h6 class="card-title"><a href="<?= \yii\helpers\Url::to(['home/detail-berita', 'id' => $berita->slug]) ?>" style="color: black;"><?= $berita->judul ?></a></h6>
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
            </div>
          </div>
    </div>
  </div>

<section class="ad">
  <div class="conten">
    <a href="http://www.timberland.com/">
      <div class="logo" alt="Timberland">
      </div>
    </a>
<!--     <a href="http://www.timberland.com/sale.html">
      <h2>Shop Now</h2>
    </a> -->
  </div>
</section>
      <hr>
      <p class="sosmed_inline">
         Bagikan | 
 <!-- <img src="<?= \Yii::$app->request->baseUrl . "/uploads/res/facebook.png"?>" onclick="_fb();" alt="facebook"> -->
 <img src="https://img.icons8.com/color/480/000000/facebook-new.png" onclick="_fb();" alt="facebook"/>
 <img src="https://img.icons8.com/color/480/000000/whatsapp--v1.png"  onclick="_whatapps();" alt="whatapps"/>
 <img src="https://img.icons8.com/color/480/000000/telegram-app--v1.png" onclick="_telegram();" alt="telegram"/>
 <!-- <img src="res/twitter.png" onclick="_twitter();" alt="twitter"> -->
<!-- <img src="<?= \Yii::$app->request->baseUrl . "/uploads/res/whatapps.png"?>" onclick="_whatapps();" alt="whatapps"> -->
<!-- <img src="<?= \Yii::$app->request->baseUrl . "/uploads/res/telegram.png"?>" onclick="_telegram();" alt="telegram"> -->
 </p>
 <script>
 var title = "<?php echo $berita->judul ?>";
// var deskripsi= "<?php echo $berita->judul ?>";
var deskripsi = window.location.href;
var currentLocation = window.location;
// console.log();
var top = (screen.height - 570) / 2;
var left = (screen.width - 570) / 2;
var params = "menubar=no,toolbar=no,status=no,width=570,height=570,top=" + top + ",left=" + left;
// console.log(encodeURI(title+deskripsi));
   function _fb(){
     var url="https://web.facebook.com/sharer.php?u=" + encodeURI(currentLocation);
     window.open(url,'NewWindow',params);
   }
   function _twitter(){
     var url="https://twitter.com/intent/tweet?url=" + encodeURI(currentLocation) + "&text="+encodeURI(deskripsi);
     window.open(url,'NewWindow',params);
     
   }
   function _whatapps(){
     var url="https://api.whatsapp.com/send?phone=&text=" + encodeURI(title +" "+deskripsi);
     window.open(url,'NewWindow',params);
   }
   function _telegram(){
     var url="https://telegram.me/share/url?url=" + encodeURI(currentLocation) + "&text=" +encodeURI(title + deskripsi);
     window.open(url,'NewWindow',params);
   }
</script>
<br>
<div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-2">
          <div class="footer__newsletter-text">
            <h4 style="color: #0a3c8b;">Komentar</h4>
          </div><!-- /.footer-newsletter-text -->
        </div><!-- /.col-xl-3-->
        <div class="col-sm-12 col-md-12 col-lg-9 col-xl-7">
          <?php /*
          <form action="<?= \Yii::$app->request->baseUrl . "/home/komentar" ?>" method="post" class="footer__newsletter-form d-flex flex-wrap">
            <div class="form-group d-flex flex-1 mb-20 mr-1">
            <input type="hidden" name="post_id" id="post_id"  value="<?=$berita->id ?>" />
              <textarea name="pesan" id="pesan" cols="30" rows="10" placeholder="Komentar" class="form-control" required></textarea>
            </div>

            <?php if (!\Yii::$app->user->isGuest) { ?>
            <button class="btn btn__primary btn__hover3 mb-20" type="submit">Kirim Komentar</button>
            <?php } else{ ?>
              <a href="<?= Yii::$app->request->baseUrl . "/site/login" ?>" class="btn btn__primary btn__hover3 mb-20">Kirim Komentar</a>
            <?php } ?>
          </form>
          */ ?>
          <?php
          
use yii\bootstrap\ActiveForm;
          $form = ActiveForm::begin([
        'id' => 'Komentar',
        'layout' => 'horizontal',
        'enableClientValidation' => true,
        'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]
        );
        ?>
        <!-- <div class="row">
          <div class="col-sm-12">

          </div>
        </div> -->
			<?= $form->field($model, 'pesan')->textarea(['rows' => 10,'cols'=>30])->label('Komentar') ?> 
      <?= $form->field($model, 'reCaptcha', ["template" => "{input}"])->widget(
                        \app\components\ReCaptcha3::className(),
                        [
                            'siteKey' => Yii::$app->params['recaptcha3.clientKey'], // unnecessary is reCaptcha component was set up
                            'action' => 'registrasi',
                        ]
                    ) ?> 
             <!-- <hr/> -->
        <?php echo $form->errorSummary($model); ?>
        <?php if (!\Yii::$app->user->isGuest) { ?>
          <div class="row">
              <div class="col-md-offset-3 col-md-6" align="center">
                  <?=  Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn__primary btn__hover3 mb-20']); ?>
              </div>
          </div>
            <!-- <button class="btn btn__primary btn__hover3 mb-20" type="submit">Kirim Komentar</button> -->
            <?php } else{ ?>
              <a href="<?= Yii::$app->request->baseUrl . "/site/login" ?>" class="btn btn__primary btn__hover3 mb-20">Kirim Komentar</a>
            <?php } ?>

        <?php ActiveForm::end(); ?>
        </div><!-- /.col-xl-7 -->

      </div><!-- /.row -->
      <section class="komen">

      <div class="card h-100 card_berita" style="background-color: #f8f8f8;">
      <?php if($komens == null){ ?>
        <div align="center" style="margin-top: 1%;">
              <h3>Belum ada komentar.</h3>
              <p>Jadilah yang pertama dalam berkomentar di sini</p>
        </div>
      <?php
       }else{foreach($komens as $komen){ 
        $profil = $komen->user->photo_url;  
        $nama = $komen->user->name;
        $tgl= \app\components\Tanggal::facebook_time_ago($komen->created_at);
        ?>
    <div class='friend'>
    <p class="pull-right" style="margin-right: 1%;"><small><?= Yii::t("cruds", "$tgl") ?></small></p>
                <img src='<?= \Yii::$app->request->baseUrl . "/uploads/$profil"?>'>

        <h3><?= $nama ?></h3>
        <p><?= $komen->pesan ?></p>
    </div>
     <?php } } ?>
    <!-- <div class='friend'>
    <img src='<?= \Yii::$app->request->baseUrl . "/uploads/default.png"?>'>
    <p class="pull-right"><small>5 days ago</small></p>
        <h3>John Smith</h3>
        <p>Just another comment</p>
    </div>
    <div class='friend'>
    <img src='<?= \Yii::$app->request->baseUrl . "/uploads/default.png"?>'>
    <p class="pull-right" style="margin-right: 1%;"><small>5 days ago</small></p>
        <h3>John Smith</h3>
        <p>Just another comment</p>

    </div> -->
      </div>
</section>
<?php /*
      <hr>
    <h3 class="mt-4 mb-4" style="margin-left:10px;color: #F5AE3D;font-size:1.4rem">
    <?php 
    $ktg = $berita->kategoriBerita->nama;
    $newss = Berita::find()->where(['kategori_berita_id' => $berita->kategori_berita_id])->limit(3)->all();
    ?>
    <?= Yii::t("cruds", "$ktg Lainnya") ?>
  </h3>
    <div class="row">
      <?php foreach ($newss as $berita) { ?>
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
    </div> */ ?>
    <hr>
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
    
  </div>
</div>
<style>
.ad {
  margin: 2px auto;
  max-width: 768px;
  background-image: url('https://tribratanewspolrestasidoarjo.com/img/berita/Berita-20210706085545.jpg');
  background-size: cover;
  background-position: left center;
  border: 1px solid #333;
  
}
/* h2 {
  background-color: rgba(245,160,25,.8);
  padding: 10px 20px;
  font-size: 2.15em;
  line-height: 70px;
  font-family: 'Oswald', sans-serif;
  text-transform: uppercase;
  transition: all .15s ease;
  text-align: center;
}
h2:hover {
  background-color: rgba(245,160,25,.8);
  transition: all .15s ease;
} */
.conten {
    clear: both;
    padding: 1px 0 0 0;
  }
  .logo {
    width: 283px;
    height: 50px;
    margin: 20px auto;
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
    width: 253px;
    height: 300px;
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
@media (min-width:1200px) {
    .container {
        max-width: 1540px
    }
}
</style>
<hr class="mt-0">
<section id="blogSingle" class="blog blog-single pt-50 pb-50">
  <div class="container">
    <div class="program1-wrap">
      <div class="row">
        <div class="col-lg-9 col-md-12 col-sm-12 pt-60">
          <div class="header-panel-wrap">
            <ul class="nav nav-tabs pb-0 border-d-program justify-content-center" id="isalam" role="tablist">
              <li class="nav-item text-center">
                <a class="nav-link font-weight-bold font-size-1 font-grey-78 active" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="home" aria-selected="true">Kalender</a>
              </li>
              <li class="nav-item text-center">
                <a class="nav-link font-weight-bold font-size-1 font-grey-78" id="uptade-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">Infografis</a>
              </li>
            </ul>
            <div class="tab-content pt-4" id="myTabContent">
              <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                <form action="<?= \Yii::$app->request->baseUrl . "/home/kalender" ?>" method="get">
              <div class="row">

        <div class="col-lg-5 col-md-12  mt-1">
        </div>
        <div class="col-lg-2 col-md-12  mt-1">
        <select class="header-sort" name="_tahun" id="_tahun">
            <?php 
            $firstYear = (int)date('Y') - 5;
            $lastYear = $firstYear + 10;
            for($i=$firstYear;$i<=$lastYear;$i++)
            {
                echo '<option value='.$i.'>'.$i.'</option>';
            }
            ?>
          </select>
        </div>
        <div class="col-lg-2 col-md-3  mt-1">
        <select class="header-sort" name="_bulan" id="_bulan">
        <?php
    for ($i = 0; $i < 12; $i++) {
        $time = strtotime(sprintf('%d months', $i));   
        $label = date('F', $time);   
        $value = date('n', $time);
        echo "<option value='$value'>$label</option>";
    }
    ?>
          </select>
        </div>
        <div class="col-lg-3 col-md-12 text-left mt-1">
      <div class="input-group mb-4">
        <?php

        use richardfan\widget\JSRegister;
        use yii\helpers\Url;

        if (Yii::$app->request->queryParams) :
          foreach (Yii::$app->request->queryParams as $key => $item) :
            if ($key == "kategori") : ?>
              <input type="hidden" name="<?= $key ?>" value="<?= $item ?>">
        <?php endif;
          endforeach;
        endif ?>
        
        <input type="text" name="cari" class="form-control search-input" placeholder="Pencarian" aria-label="Cari Event" aria-describedby="button-addon2" value="<?= Yii::$app->request->queryParams['cari'] ?>" style="height: 40px;">
        <button class="btn btn-search-input" type="submit" id="cari" style="height: 40px;line-height: 38px">
          <i class="fa fa-search"></i>
        </button>
      </div>
    </form>
         
        </div>
      </div>
                <!-- <img class="border-r10 shadow-br3" src="<?= Yii::$app->request->baseUrl . '/uploads/setting/' . $setting->banner ?>" style="opacity: 0.3;"> -->
                <section id="page-title" class="page-title bg-overlay bg-parallax">
      <div class="bg-img"><img id="myImg" src="<?= Yii::$app->request->baseUrl . '/uploads/setting/' . $setting->banner ?>" ></div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12">
            <h1 class="pagetitle__heading" id="nama_event">Kalender Dan Informasi</h1>
            <h6 style="color:#ffffff" id="lokasi">Surabaya,Jawa Timur</h6>
            <p style="color: #ffffff;" id="isi">Merealisasikan Program Kesehatan,</p>
          </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.page-title -->
    <div class="container" style="margin-top: 5px;">
    
        <div class="row text-center">
    <div class="carousel owl-carousel carousel-arrows" data-slide="6" data-slide-md="2" data-slide-sm="1" data-autoplay="false" data-nav="true" data-dots="false" data-space="20" data-loop="true" data-speed="800">
            <!-- fancybox item #1 -->
            <?php foreach ($kalenders as $kalender) {
              $month = date("m",strtotime($kalender->tanggal)); ?>
              <div class="fancybox-item">
                <div class="fancybox__content">
                  <div class="col-12 mx-auto">
                    <?php 
                    if($month == "01" || $month == "06" || $month == "11"){ ?>
                      <div class="service-item" style="padding: 20px 15px 15px;margin-top:10px;border-radius:10px;background-color: #FF4E11 ;">
                    <?php }elseif($month == "02" || $month == "07" || $month == "12"){ ?>
                      <div class="service-item" style="padding: 20px 15px 15px;margin-top:10px;border-radius:10px;background-color: #FF8E15 ;">
                    <?php }elseif($month == "03" || $month == "08") { ?>
                      <div class="service-item" style="padding: 20px 15px 15px;margin-top:10px;border-radius:10px;background-color: #FAB733 ;">
                    <?php }elseif($month == "04" || $month == "09"){ ?>
                      <div class="service-item" style="padding: 20px 15px 15px;margin-top:10px;border-radius:10px;background-color: #ACB334 ;">
                    <?php }elseif($month == "05" || $month == "10"){ ?>
                      <div class="service-item" style="padding: 20px 15px 15px;margin-top:10px;border-radius:10px;background-color: #69B34C ;">
                    <?php } ?>
                      <!-- <div class="team-img" style="background-image: url('<?= \Yii::$app->request->baseUrl . "/uploads/organisasi/" . $organisasi->foto; ?>')">
                      </div> -->
                      <div class="service__content">
                       <a href="#" onclick="theFunction('<?= $kalender->id ?>');"> <h4 class="service__title" style="color: #ffffff;"><?= \app\components\Tanggal::toReadableDateKalender($kalender->tanggal,false) ?></h4></a>
                        <h6 style="color:#ffffff"><?= \app\components\Tanggal::toReadableDateKalender2($kalender->tanggal,false) ?></h6>
                        <!-- <p class="service__desc">asdasdsadasdas</p> -->
                      </div>
                    </div><!-- /.service-item -->
                  </div><!-- /.col-lg-4 -->
                </div><!-- /.fancybox-content -->
              </div><!-- /.fancybox-item -->
            <?php } ?>
          </div><!-- /.carousel -->
        </div>
    </div>
                <!-- <p class="desc-program">
                  <?= $setting->tentang_kami ?>
                </p> -->
              </div>
              <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
                <div class="row">
                  <!-- project item #1 -->
                  <?php foreach ($infografis as $value) { ?>
                  
                    <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="project-item">
              <div class="project__img">
                      <img src="<?= \Yii::$app->request->BaseUrl . '/uploads/infografis/' . $value->foto ?>" style="width:350px;height433px;display: block;margin-left: auto;margin-right: auto;">
                      <a href="<?= \Yii::$app->request->BaseUrl.'/uploads/infografis/'.$value->foto ?>" data-lightbox="lightbox" class="zoom__icon"></a>
              </div>
                    </div>
                    </div><!-- /.col-lg-4 -->
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.col-lg-12 -->
        <div class="col-lg-3 col-md-12 col-sm-12 pt-40">
        <a href="http://www.timberland.com/">
    <section class="ad">
      <div class="conten">
          <!-- <div class="logo" alt="Timberland">
          </div> -->
          <!--     <a href="http://www.timberland.com/sale.html">
            <h2>Shop Now</h2>
          </a> -->
        </div>
      </section>
    </a>
    <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <p class="text-left font-weight-bold" style="color: black;">Berita Update</p>
                  <h6 class="text-left" style="color:black;margin-top:-3%;">KORMI JAWA TIMUR</h6>
                </div>
                <hr>
                <div class="col-12 text-left border-top-2 mt-4 pt-4">
                </div>
                <?php foreach ($news as $berita) { ?>
                  <div class="col-lg-12 col-md-12 mt-3">
                    <div class="card shadow-br2" style="border-radius: 15px;">
                      <a href="<?= \yii\helpers\Url::to(['home/detail-berita', 'id' => $berita->slug]) ?>">
                      <div class="team-img" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/berita/" . $berita->gambar ?>);border-radius: 15px;height:100px;width:auto">
                      </div>
                      </a>
                      <div class="card-body" style="margin-top: -10px;">
                        <h6 class="card-title"><a href="<?= \yii\helpers\Url::to(['home/detail-berita', 'id' => $berita->slug]) ?>" style="color: black;"><?= $berita->judul ?></a></h6>
                      </div>
                    </div>
                    </a>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
          </div>

      </div><!-- /.row -->
    </div><!-- /.container -->

</section><!-- /.blog Single -->
  <?php
$my_js = '
function theFunction(e){
    var id = e;
    $.ajax({
      type: "GET",
      url: "' . Yii::$app->urlManager->createUrl('home/get-kalender?id=') . '"+id,
      success: function(data){
        var obj = jQuery.parseJSON(data);
        var lokasi = obj.lokasi;
        var nama_event = obj.nama_event;
        var isi = obj.isi;
        var slider = obj.slider;
        var urls = "'.Yii::$app->request->baseUrl . '/uploads/kalender_event/' .'"+slider;
        console.log(urls);
        document.getElementById("lokasi").innerHTML = lokasi;
        document.getElementById("nama_event").innerHTML = nama_event;
        document.getElementById("isi").innerHTML = isi;
        if(document.getElementById("myImg") != ""){
          document.getElementById("img2").src = "/kormi/web/uploads/kalender_event/dd824a3b8c2f738c359558544544bfcbbf88fa9f.jpeg"
          console.log("ada");
         }else{
           console.log("tidak ada");
         }
        // document.getElementById("slider").src=;
        var foto = "/kormi/web/uploads/kalender_event/dd824a3b8c2f738c359558544544bfcbbf88fa9f.jpeg";
        },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("error");
            }
        });
}
';

$this->registerJS($my_js, \yii\web\View::POS_END);
?>
<?php
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
CSS;

$this->registerCss($css) ?>
<hr class="mt-0">
<div class="mt-4 mb-4">
  <div class="container mt-4 mb-4">

    <?= $this->render('component/banner', [
      "banner" => \app\models\Berita::getbanner()
    ])
    ?>

    <div class="text-center mt-5 mb-4">
      <div class="row">
        <div class="col-lg-3 col-md-12  mt-1">
          <h3 class="text-primary text-left"><?= Yii::t("cruds", "Berita Update") ?></h3>
        </div>
        <div class="col-lg-6 col-md-12  mt-1">
          <!-- <ul class="header-list_kategori d-lg-block d-none">
            <li class="<?= $_GET['kategori'] == null ? "active" : "" ?>"><a class="font-weight-bold" href="<?= \Yii::$app->request->baseUrl . "/home/news" ?>"><?= Yii::t("cruds", "Semua") ?></a></td>
              <?php foreach ($categories as $kategori) {  ?>
            <li class="<?= $_GET['kategori'] == $kategori->nama ? "active" : "" ?>"><a class="font-weight-bold" href="<?= \Yii::$app->request->baseUrl . "/home/news?kategori=" . $kategori->nama ?>"><?= $kategori->nama ?> </a></td>
            <?php } ?>
          </ul>
          <select class="header-sort d-lg-none d-block" name="filter_kategori" id="filter_kategori">
            <option value="" <?= $_GET['kategori'] == "" ? "selected" : "" ?>><?= Yii::t("cruds", "Pilih kategori Berita") ?></option>
            <?php foreach ($categories as $kategori) {  ?>
              <option value=" <?= $kategori->nama ?>" <?= $_GET['kategori'] == $kategori->nama ? "selected" : "" ?>><?= $kategori->nama ?> </option>
            <?php } ?>
          </select> -->
        </div>
        <div class="col-lg-3 col-md-12 text-left mt-1">
        <form action="<?= \Yii::$app->request->baseUrl . "/home/news" ?>" method="get">
      <div class="input-group mb-4">
        <?php

                        use app\models\Berita;
                        use richardfan\widget\JSRegister;
        use yii\helpers\Url;

        if (Yii::$app->request->queryParams) :
          foreach (Yii::$app->request->queryParams as $key => $item) :
            if ($key == "kategori") : ?>
              <input type="hidden" name="<?= $key ?>" value="<?= $item ?>">
        <?php endif;
          endforeach;
        endif ?>
        <input type="text" name="cari" class="form-control search-input" placeholder="Cari Berita" aria-label="Cari Berita" aria-describedby="button-addon2" value="<?= Yii::$app->request->queryParams['cari'] ?>" style="height: 40px;">
        <button class="btn btn-search-input" type="submit" id="cari" style="height: 40px;line-height: 38px">
          <i class="fa fa-search"></i>
        </button>
      </div>
    </form>
           <!-- <form class="footer__newsletter-form d-flex flex-wrap">
            <div class="form-group d-flex flex-1 mb-20 mr-1">
              <input type="search" class="form-control" placeholder="Pencarian" style="border-radius: 10px;height:35px;">
              <textarea name="pesan" id="pesan" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <button class="btn btn__primary btn__hover3 mb-20">Submit Now!</button>
          </form> -->
          <!-- <select class="header-sort" name="_sort" id="_sort">
            <option value="" <?= $_GET['_sort'] == null ? "selected" : "" ?>><?= Yii::t("cruds", "Pilih Pengurutan Berita") ?></option>
            <option value="1" <?= $_GET['_sort'] == 1 ? "selected" : "" ?>><?= Yii::t("cruds", "Terbaru Dibuat") ?></option>
            <option value="2" <?= $_GET['_sort'] == 2 ? "selected" : "" ?>><?= Yii::t("cruds", "Terbaru Diubah") ?></option>
            <option value="3" <?= $_GET['_sort'] == 3 ? "selected" : "" ?>><?= Yii::t("cruds", "Paling Banyak Dilihat") ?></option>
            <option value="4" <?= $_GET['_sort'] == 4 ? "selected" : "" ?>><?= Yii::t("cruds", "Paling Lama") ?></option>
          </select> -->
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-12  mt-1">
          <h3 class="text-primary text-left"><?= Yii::t("cruds", "Kategori Berita") ?></h3>
        </div>
        <div class="col-lg-6 col-md-12  mt-1">
          <ul class="header-list_kategori d-lg-block d-none">
            <li class="<?= $_GET['kategori'] == null ? "active" : "" ?>"><a class="font-weight-bold" href="<?= \Yii::$app->request->baseUrl . "/home/news" ?>"><?= Yii::t("cruds", "Semua") ?></a></td>
              <?php foreach ($categories as $kategori) {  ?>
            <li class="<?= $_GET['kategori'] == $kategori->nama ? "active" : "" ?>"><a class="font-weight-bold" href="<?= \Yii::$app->request->baseUrl . "/home/news?kategori=" . $kategori->nama ?>"><?= $kategori->nama ?> </a></td>
            <?php } ?>
          </ul>
          <select class="header-sort d-lg-none d-block" name="filter_kategori" id="filter_kategori">
            <option value="" <?= $_GET['kategori'] == "" ? "selected" : "" ?>><?= Yii::t("cruds", "Pilih kategori Berita") ?></option>
            <?php foreach ($categories as $kategori) {  ?>
              <option value=" <?= $kategori->nama ?>" <?= $_GET['kategori'] == $kategori->nama ? "selected" : "" ?>><?= $kategori->nama ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="col-lg-3 col-md-12 text-left mt-1">
        
          
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <p style="font-size: .8rem; text-align:left">
            <?= $summary ?>
          </p>
        </div>
      </div>
    </div>
    <div class="row">
            
    <div class="col-lg-9 col-md-6 col-sm-12">
    <div class="row mt-2">
      <?php foreach ($news as $berita) { ?>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mt-3">
          <!-- <a href="<?= \Yii::$app->request->baseUrl . "/detail-berita?id=" . $berita->slug ?>"> -->
          <div class="card h-100 card_berita">
            <!-- <img src="" class="card-img-top" alt="..."> -->
            <div style="border-radius: .7rem;background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/berita/" . $berita->gambar ?>);background-size: cover;height: 200px;">

            </div>
            <div class="card-body">
              <h6 class="card-title"><?= $berita->getShowTitle() ?></h6>
              <div class="content-berita__info">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-6 text-left">
                    <?= $berita->kategoriBerita->nama ?>
                    <br>
                  </div>
                  <div class="col-lg-6 col-md-6 col-6 text-right">
                    <?= date("d M Y", strtotime($berita->created_at)); ?>
                  </div>
                </div>
                <hr>
              </div>
              <p style="color: #666; margin-bottom: .5rem; font-size: .9rem" :hover="color: #666">
                <?= $berita->getDescription() ?> <a href="<?= Url::to(['home/detail-berita', 'id' => $berita->slug]) ?>" style="color: #d07500;"><?= Yii::t("cruds", "Baca Selengkapnya") ?></a>
              </p>
              <div style="text-align: right;">
                <!-- <a href="<?= Url::to(['home/detail-berita', 'id' => $berita->slug]) ?>" class="btn btn-more"><?= Yii::t("cruds", "Baca Selengkapnya") ?></a> -->
              </div>
            </div>
          </div>
          <!-- </a> -->
        </div>
      <?php } ?>
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
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 pt-10">
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
              // var_dump($newss);die;
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
    
  </div>
</div>

<?php JSRegister::begin(); ?>
<script>
  $("#_sort").on("change", (event) => {
    let params = <?= json_encode((Yii::$app->request->queryParams)) ?>;
    if (event.target.value == "") {
      delete params["_sort"];
    } else {
      params["_sort"] = event.target.value;
    }
    const url = new URL(`<?= Url::to(['/home/news'], true) ?>`);
    url.search = new URLSearchParams(params);
    console.log(url)
    window.location.href = url;
  })
  $("#filter_kategori").on("change", (event) => {
    let params = <?= json_encode((Yii::$app->request->queryParams)) ?>;
    if (event.target.value == "") {
      delete params["filter_kategori"];
    } else {
      params["filter_kategori"] = event.target.value;
    }
    const url = new URL(`<?= Url::to(['/home/news'], true) ?>`);
    url.search = new URLSearchParams(params);
    console.log(url)
    window.location.href = url;
  })
  $('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    navText: ["<i class='fa fa-angle-double-left'></i>", "<i class='fa fa-angle-double-right'></i>"],
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 1
      }
    }
  })
</script>
<?php JSRegister::end(); ?>
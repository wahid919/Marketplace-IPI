<hr class="mt-0">
<section id="services" class="services pb-90" style="padding-top: 10px;">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="text-left">
          <h2 style="color: #cb1d08;">Produk</h>
            <p class="font-weight-bold text-summary"><?= $summary ?></p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-category">
        <label class="font-weight-600 font-size-1" for="wakaf" style="color:#a5a4a4;">Pilih Kategori Produk</label>
        <select class="form-control select-category ml-auto" id="select-category">
          <option class="font-weight-bold" value="<?= \Yii::$app->request->baseUrl . "/home/list-produk/" ?>">Semua Kategori</option>
          <?php

          use yii\helpers\Url;

          foreach ($kategori_produks as $kategori_produk) {  ?>
            <option class="font-weight-bold" value="<?= \Yii::$app->request->baseUrl . "/home/list-produk?kategori=" . $kategori_produk->nama ?>" <?php
                                                                                                                                                  if ($_GET['kategori'] == $kategori_produk->nama) {
                                                                                                                                                    echo "selected";
                                                                                                                                                  }
                                                                                                                                                  ?>><?= $kategori_produk->nama ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="row">
      <?php foreach ($produks as $produk) {
        $nominal = $produk->harga;
      ?>
        <div class="col-lg-3 col-md-6 mt-3">
          <div class="card shadow-br2" style="border-radius: 15px;">
            <!-- <img src="" class="card-img-top" alt="..."> -->
            <div class="team-img" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/banner_produk/" . $produk->foto_banner ?>);border-radius: 15px;">
            </div>
            <div class="card-body">
              <h6 class="card-title"><?= $produk->nama ?></h6>
              <div class="row">
                <div class="col-lg-8 col-md-8 col-8 text-left font-weight-bold" style="color: #cb1d08;font-size: 1.3rem;">
                  <?= \app\components\Angka::toReadableHarga($nominal, false)  ?><br>
                </div>
                <div class="col-lg-4 col-md-4 col-4 text-right font-weight-bold" style="color: #cb1d08;font-size: 1.3rem;">

                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 5px;">
                  <a href="<?= Url::to(["detail-produk", "id" => $produk->id]) ?>" class="btn btn-sm btn-program btn-block">Beli Sekarang</a>
                </div>
              </div>
            </div>
          </div>
          </a>
        </div>
      <?php }
      ?>
    </div><!-- /.row -->
    <hr>
    <div class='d-flex justify-content-center'>
      <?php echo \yii\widgets\LinkPager::widget([
        'pagination' => $pagination,
      ]); ?>
    </div>

  </div><!-- /.container -->
</section><!-- /.Services -->

<?php
$script = <<< JS
$(document).ready(function () {
    $("#select-category").change(function() {
        window.location.href = $(this).val();
    });
});
JS;
$this->registerJs($script);
?>
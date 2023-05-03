<hr class="mt-0">
<section id="services" class="services pb-90" style="padding-top: 10px;">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="text-left">
          <h2 style="color: #ffa500;">Program</h>
            <p class="font-weight-bold text-summary"><?= $summary ?></p>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-12 text-category">
        <label class="font-weight-600 font-size-1" for="wakaf" style="color:#a5a4a4;">Pilih Kategori Wakaf</label>
        <select class="form-control select-category ml-auto" id="select-category">
          <option class="font-weight-bold" value="<?= \Yii::$app->request->baseUrl . "/home/program/" ?>">Semua Kategori</option>
          <?php

          use yii\helpers\Url;

          foreach ($kategori_pendanaans as $kategori_pendanaan) {  ?>
            <option class="font-weight-bold" value="<?= \Yii::$app->request->baseUrl . "/home/program?kategori=" . $kategori_pendanaan->name ?>"><?= $kategori_pendanaan->name ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="row">
      <?php foreach ($pendanaans as $pendanaan) {
        $nominal = \app\models\Pembayaran::find()->where(['pendanaan_id' => $pendanaan->id, 'status_id' => 6])->sum('nominal');

        $pewakaf = \app\models\Pembayaran::find()->where(['pendanaan_id' => $pendanaan->id, 'status_id' => 6])->count();
        $datetime1 =  new Datetime($pendanaan->pendanaan_berakhir);
        $datetime2 =  new Datetime(date("Y-m-d H:i:s"));
        $interval = $datetime1->diff($datetime2)->days;
        $target = $pendanaan->nominal;
        $nilai_sekarang = ($nominal / $target) * 100;
      ?>
        <div class="col-lg-4 col-md-6 mt-3">
          <!-- <a href="<?= \Yii::$app->request->baseUrl . "/home/detail-berita?id=" . $berita->slug ?>"> -->
          <div class="card shadow-br2" style="border-radius: 15px;">
            <!-- <img src="" class="card-img-top" alt="..."> -->
            <div class="team-img" style="background-image: url(<?= \Yii::$app->request->baseUrl . "/uploads/" . $pendanaan->poster ?>);border-radius: 15px;">
            </div>
            <div class="card-body">
              <h6 class="card-title"><?= $pendanaan->nama_pendanaan ?></h6>
              <div class="row">
                <div class="col-12">
                  <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $nilai_sekarang ?>%" aria-valuenow="<?= $nilai_sekarang ?>" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-6 text-left pt-4 font-weight-bold font-size-08">
                  Sudah Terkumpul
                </div>
                <div class="col-lg-6 col-md-6 col-6 text-right pt-4 font-weight-bold font-size-08">
                  Durasi
                </div>
              </div>
              <div class="row">
                <div class="col-lg-8 col-md-8 col-8 text-left font-weight-bold" style="color: #ffa500;font-size: 1.3rem;">
                  <?= \app\components\Angka::toReadableHarga($nominal, false)  ?><br>
                </div>
                <div class="col-lg-4 col-md-4 col-4 text-right font-weight-bold" style="color: #ffa500;font-size: 1.3rem;">
                  <?= $interval; ?> Hari
                </div>
              </div>
              <hr>
              <div class="row">

                <div class="col-lg-12 col-md-12 col-12 text-left font-weight-bold font-size-08">
                <i class="fa fa-users" aria-hidden="true"></i> Jumlah Pewakaf(<?= $pewakaf ?>)
                </div>
                </div>
              <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12" style="margin-top: 5px;">
                  <a href="<?= Url::to(["detail-program", "id" => $pendanaan->id]) ?>" class="btn btn-sm btn-program btn-block">Mulai Wakaf</a>
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
<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

// namespace Midtrans;

use app\models\KegiatanPendanaan;
use yii\helpers\Url;
?>
<hr class="mt-0">
<section id="blogSingle" class="blog blog-single pt-50 pb-50">
  <div class="container">
    <div class="program1-wrap">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
          <div class="program1__big-img">
            <img class="border-r10" alt="program 1" src="<?= \Yii::$app->request->baseUrl . "/uploads/" . $pendanaan->poster ?>" style="max-height: 500px;">
          </div>
          <div class="program1__img-wrap d-none">
            <!-- <?php if ($kegiatan_pendanaans == null) { ?>
              <div class="program1-img">
                <a href="<?= \Yii::$app->request->baseUrl . "/uploads/" . $pendanaan->poster ?>" data-lightbox="program">
                  <img alt="program Small 1" src="<?= \Yii::$app->request->baseUrl . "/uploads/" . $pendanaan->poster ?>" class="img-project">
                </a>
              </div>
              <div class="program1-img">
                <a href="<?= \Yii::$app->request->baseUrl . "/uploads/" . $pendanaan->poster ?>" data-lightbox="program">
                  <img alt="program Small 1" src="<?= \Yii::$app->request->baseUrl . "/uploads/" . $pendanaan->poster ?>" class="img-project">
                </a>
              </div>
              <div class="program1-img">
                <a href="<?= \Yii::$app->request->baseUrl . "/uploads/" . $pendanaan->poster ?>" data-lightbox="program">
                  <img alt="program Small 1" src="<?= \Yii::$app->request->baseUrl . "/uploads/" . $pendanaan->poster ?>" class="img-project">
                </a>
              </div>
              <?php } else {
              foreach ($kegiatan_pendanaans as $kegiatan_pendanaan) { ?>
                <div class="program1-img">
                  <a href="<?= \Yii::$app->request->BaseUrl ?>/uploads/kegiatan/<?= $kegiatan_pendanaan->foto ?>" data-lightbox="program">
                    <img alt="<?= $kegiatan_pendanaan->kegiatan ?>" src="<?= \Yii::$app->request->BaseUrl ?>/uploads/kegiatan/<?= $kegiatan_pendanaan->foto ?>" class="img-project">
                  </a>
                </div>
            <?php }
            } ?> -->
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
          <div class="program__text">
            <h3 class="font-weight-bold text-detail-program"><?= $pendanaan->nama_pendanaan ?></h3>
            <div class="table-responsive d-none d-lg-block">
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th style="color:#787878" scope="col">Kategori</th>
                    <th style="color:#787878" scope="col">Tempat</th>
                    <th style="color:#787878" scope="col">Penerima Wakaf</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="font-weight-bold text-isalam-1 font-size-08"><?= $pendanaan->kategoriPendanaan->name ?></td>
                    <td class="font-weight-bold text-isalam-1 font-size-08"><?= $pendanaan->tempat ?></td>
                    <td class="font-weight-bold text-isalam-1 font-size-08"><?= $pendanaan->penerima_wakaf ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="table-responsive d-none d-block d-sm-block d-md-block d-lg-none">
              <table class="table table-borderless">
                <thead>
                  <tr>
                    <th style="color:#787878">Kategori</th>
                    <th style="color:#787878">Tempat</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="font-weight-bold text-isalam-1 font-size-08"><?= $pendanaan->kategoriPendanaan->name ?></td>
                    <td class="font-weight-bold text-isalam-1 font-size-08"><?= $pendanaan->tempat ?></td>
                  </tr>
                  <tr>
                    <th colspan="2" style="color:#787878">Penerima Wakaf</th>
                  </tr>
                  <tr>
                    <td colspan="2" class="font-weight-bold text-isalam-1 font-size-08"><?= $pendanaan->penerima_wakaf ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="program__info">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-6 text-left pt-4 font-weight-bold font-size-08">
                Sudah Terkumpul
              </div>
              <div class="col-lg-6 col-md-6 col-6 text-right pt-4 font-weight-bold font-size-08">
                Dana Dibutuhkan
              </div>
            </div>
            <div class="row">
              <div class="col-lg-8 col-md-6 col-6 text-left font-weight-bold progress-dana pb-2">
                <?= \app\components\Angka::toReadableHarga($dana); ?><br>
              </div>
              <div class="col-lg-4 col-md-6 col-6 text-right font-weight-bold progress-dana pb-2">
                <?= \app\components\Angka::toReadableHarga($pendanaan->nominal); ?>
              </div>
              <div class="col-12">
                <div class="progress">
                  <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $persen ?>%" aria-valuenow="<?= $persen ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-6 text-left pt-4 font-weight-bold font-size-1">
                Durasi Wakaf
              </div>
              <div class="col-lg-6 col-md-6 col-6 text-right pt-4 font-weight-bold font-size-1">
                <?= $interval ?> Hari
              </div>
              <!-- <div class="col-lg-6 col-md-6 col-6 text-left pt-4 font-weight-bold font-size-1">
                Share Wakaf Melalui Sosial Media
              </div>
              <div class="col-lg-6 col-md-6 col-6 text-right pt-4 font-weight-bold font-size-1 ">
                <div class="share__icons">
                  <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                  <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                  <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
              </div> -->
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12">
                <!-- <a href="#" class="btn btn-sm btn-program btn-block" data-toggle="modal" data-target="#mulaiwakaf" style="padding: 10px !important;">Mulai Wakaf</a> -->
                <div class="col-12">
                    <?php if (!\Yii::$app->user->isGuest) { ?>
                      <a href="#" class="btn btn-sm btn-program btn-block" data-toggle="modal" data-target="#mulaiwakaf" style="padding: 10px !important;">Mulai Wakaf</a>
                    <?php } else { ?>
                      <button type="button" class="btn-sm btn-block text-white font-weight-bold" style="height: 3rem;background-color: #f1a502;" id="btn-user-login">Mulai Wakaf</button>
                    <?php
                    } ?>
              </div>
            </div>
          </div>
          <!-- End program Info -->
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="mulaiwakaf" tabindex="-1" role="dialog" aria-labelledby="mulaiwakaf" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="mulaiwakaf">Pembayaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ul class="nav nav-tabs pb-4" id="isalam" role="tablist">
              <li class="nav-item text-center" style="width: 50%;">
                <a class="nav-link font-weight-bold active" id="Wakaf-tab" data-toggle="tab" href="#pembayaran" role="tab" aria-controls="pembayaran" aria-selected="true"><i class="fas fa-hand-holding-usd"></i> Uang</a>
              </li>
              <li class="nav-item text-center" style="width: 50%;">
                <a class="nav-link font-weight-bold" id="wakaf-tab" data-toggle="tab" href="#lembaran" role="tab" aria-controls="lembaran" aria-selected="false"><i class="fas fa-money-bill-alt"></i> Lembaran</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="pembayaran" role="tabpanel" aria-labelledby="pembayaran-tab">
                <div class="row">
                  <div class="col-4">
                    <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->BaseUrl ?>/uploads/detail-program.jpeg" width="200px">
                  </div>
                  <div class="col-8">
                    <p class="font-size-08">Anda akan berwakaf untuk project :</p>
                    <p class="font-weight-bold">
                      <?= $pendanaan->nama_pendanaan ?>
                    </p>
                  </div>
                  <div class="col-12 pt-3">
                    <h3 style="color: #404040;">Nominal Wakaf</h3>
                    <p class="font-size-08">Anda akan berwakaf dengan nominal sebesar :</p>
                    <div class="row">
                      <div class="col-6">
                        <a href="#" class="btn btn-block btn-nilai-wakaf btn-outline-bayar border-r5 mt-2" role="button" aria-pressed="true" onclick="return theFunction(100000);">Rp. 100.000 ></a>
                      </div>
                      <div class="col-6">
                        <a href="#" class="btn btn-block btn-nilai-wakaf btn-outline-bayar border-r5 mt-2" role="button" aria-pressed="true" onclick="return theFunction(200000);">Rp. 200.000 ></a>
                      </div>
                      <div class="col-6">
                        <a href="#" class="btn btn-block btn-nilai-wakaf btn-outline-bayar border-r5 mt-2" role="button" aria-pressed="true" onclick="return theFunction(300000);">Rp. 300.000 ></a>
                      </div>
                      <div class="col-6">
                        <a href="#" class="btn btn-block btn-nilai-wakaf btn-outline-bayar border-r5 mt-2" role="button" aria-pressed="true" onclick="return theFunction(400000);">Rp. 400.000 ></a>
                      </div>
                      <div class="col-6">
                        <a href="#" class="btn btn-block btn-nilai-wakaf btn-outline-bayar border-r5 mt-2" role="button" aria-pressed="true" onclick="return theFunction(500000);">Rp. 500.000 ></a>
                      </div>
                      <div class="col-6">
                        <a href="#" class="btn btn-block btn-nilai-wakaf btn-outline-bayar border-r5 mt-2" role="button" aria-pressed="true" onclick="return theFunction(600000);">Rp. 600.000 ></a>
                      </div>
                      <div class="col-12 mt-2">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend mr-2" style="height:calc(1.5em + .75rem + 2px);">
                            <div class="input-group-text bg-white border-r5 font-weight-bold" style="color: #afafaf;border-color: #787878;">Rp</div>
                          </div>
                          <input type="number" class="form-control select-wakaf" id="nominal" name="nominal" style="border-color: #787878;" placeholder="Minimal Wakaf Rp. 10.000" required>
                          <button id="clear" class="btn btn-danger btn-sm" type="button" style="height: calc(1.5em + 0.75rem + 2px);
                          line-height: 34px;
                          width: 60px;background-color:firebrick;color:white;border-radius:0px;">
                          X</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <script>
                  let hasils =document.querySelector('#nominal');
    window.addEventListener('load', () => {
        const button = document.querySelector('#clear');
        button.addEventListener('click', () => {
          
        hasils.setAttribute("value", 0);
            hasils.value = "";
        });
    }); 
   </script>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-batal" style="background-color:firebrick;color:white" data-dismiss="modal">Batal</button>
                  <!-- <button type="button" class="btn btn-sm btn-program" data-toggle="modal" data-target="#exampleModalScrollable" id="bayarkan">Bayar</button> -->
                  <button type="button" class="btn btn-sm btn-program" style="padding: 10px !important;background-color:green" id="bayarkan">Bayar</button>
                </div>
              </div>
              <div class="tab-pane fade" id="lembaran" role="tabpanel" aria-labelledby="lembaran-tab">
                <div class="row">
                  <div class="col-4">
                    <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->BaseUrl ?>/uploads/detail-program.jpeg" width="200px">
                  </div>
                  <div class="col-8">
                    <p class="font-size-08">Anda akan berwakaf untuk project :</p>
                    <p class="font-weight-bold"><?= $pendanaan->nama_pendanaan ?></p>
                  </div>
                  <div class="col-12 pt-3">
                    <h3 style="color: #404040;">Lembar Wakaf</h3>
                    <p class="font-size-08">Anda akan berwakaf dengan nominal sebesar :<br />*Perlembar <?= \app\components\Angka::toReadableHarga($pendanaan->nominal_lembaran); ?></p>
                    <div class="row">

                      <div class="col-12 mt-2">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend mr-2" style="height:calc(1.5em + .75rem + 2px);">
                            <div class="input-group-text bg-white border-r5 font-weight-bold" style="color: #afafaf;border-color: #787878;">Lembar</div>
                          </div>
                          <input type="number" class="form-control select-wakaf" id="nominal2" name="nominal2" style="border-color: #787878;" placeholder="Minimal Wakaf 1 Lembar" required>
                          <button id="clear2" class="btn btn-danger btn-sm" type="button" style="height: calc(1.5em + 0.75rem + 2px);
                          line-height: 34px;
                          width: 60px;background-color:firebrick;color:white;border-radius:0px;">
                          X</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-batal" style="background-color:firebrick;color:white" data-dismiss="modal">Batal</button>
                  <!-- <button type="button" class="btn btn-sm btn-program" data-toggle="modal" data-target="#exampleModalScrollable" id="bayarkan">Bayar</button> -->
                  <button type="button" class="btn btn-sm btn-program" style="padding: 10px !important;background-color:green" id="bayarkan2">Bayar</button>
                </div>
              </div>
            </div>
          </div>
          <script>
                  let hasils2 =document.querySelector('#nominal2');
    window.addEventListener('load', () => {
        const button = document.querySelector('#clear2');
        button.addEventListener('click', () => {
          
        hasils2.setAttribute("value", 0);
            hasils2.value = "";
        });
    }); 
   </script>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      var global = "Global Variable"; //Define global variable outside of function


      function setGlobal() {
        global = "Hello World!";
      };
      setGlobal();
      var data = 0;
      var coba;
      theFunction(data);
      var pendanaan = "<?php echo $pendanaan->id; ?>";
      document.querySelector("#bayarkan").addEventListener("click", () => {
        let nominal = document.querySelector("#nominal").getAttribute("value");
        if (nominal == null || nominal == "0" || nominal == 0) {
          alert("Anda Belum Mengisi Nominal Wakaf");
        }else if(nominal < 0 ){
          alert("Silahkan Isi Nominal Dengan Benar");
        }else {
          if(pendanaan == null){
          alert("Pendanaan Tidak Diketahui");
          }else{
            window.location.href = `<?= Url::to(['/home/pembayaran', 'id' => $pendanaan->id]) ?>?nominal=${nominal}&ket=nominal`;
          }
        }
      });
      document.querySelector("#bayarkan2").addEventListener("click", () => {
        let nominal2 = document.querySelector("#nominal2").getAttribute("value");
        if (nominal2 == null) {
          alert("Anda Belum Mengisi Nominal Wakaf");
        } else {
          if(pendanaan == null){
          alert("Pendanaan Tidak Diketahui");
          }else{
            window.location.href = `<?= Url::to(['/home/pembayaran', 'id' => $pendanaan->id]) ?>?nominal=${nominal2}&ket=lembar`;
          }
        }
      });

      function theFunction(i) {

        var rupiah;
        var php_var = "<?php $php_var; ?>";
        document.querySelector("#nominal").setAttribute("value", i);
        var a = document.getElementById("nominal").value = i;
        let num = 15;
        let n = num.toString();
        coba = i;
        php_var += a;
        var number_string = i.toString(),
          sisa = number_string.length % 3,
          rupiah = number_string.substr(0, sisa),
          ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
          separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }
        // var b = document.getElementById("nom").innerHTML = "Rp. " + rupiah;
        // coba = "Rp. " + rupiah;
        // var p1 = document.getElementById("nom").value;
        // console.log(php_var);
        return i;
        // console.log(a);
        // data = a;
        // return true or false, depending on whether you want to allow the `href` property to follow through or not
      }
      var duit = document.getElementById("nominal");
      duit.addEventListener('keyup', function(e) {
        // console.log(this.value);
        duit.setAttribute("value", this.value);
      });
      var duit2 = document.getElementById("nominal2");
      duit2.addEventListener('keyup', function(e) {
        // console.log(this.value);
        duit2.setAttribute("value", this.value);
      });

      // console.log(data);
    </script>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Pembayaran<?php var_dump($php_var); ?></h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php  ?> Apakah Anda Yakin Ingin Wakaf sebesar <h3 id="nom"></h3>
            <script>

            </script>

            <?php
            echo "<script>document.writeln(global);</script>";
            ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="pay-button" type="button" class="btn btn-primary">Save changes</button>
            <!-- <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-lrPe45BCGoT9yG2O"></script>
            <script type="text/javascript">
              document.getElementById('pay-button').onclick = function() {
                // SnapToken acquired from previous step
                snap.pay('<?= $snap_token ?>', {
                  // Optional
                  onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                  },
                  // Optional
                  onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                  },
                  // Optional
                  onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                  }
                });
              };
            </script> -->
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 col-md-6 col-sm-12 pt-60">
        <div class="header-panel-wrap">
          <ul class="nav nav-tabs pb-0 border-d-program" id="isalam" role="tablist">
            <li class="nav-item text-center">
              <a class="nav-link font-weight-bold font-size-1 font-grey-78 active" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="home" aria-selected="true">Detail</a>
            </li>
            <li class="nav-item text-center">
              <a class="nav-link font-weight-bold font-size-1 font-grey-78" id="uptade-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">Update</a>
            </li>
            <li class="nav-item text-center">
              <a class="nav-link font-weight-bold font-size-1 font-grey-78" id="donatur-tab" data-toggle="tab" href="#donatur" role="tab" aria-controls="donatur" aria-selected="false">Donatur</a>
            </li>
          </ul>
          <div class="tab-content pt-4" id="myTabContent">
            <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
              <p class="desc-program">
                <?= $pendanaan->deskripsi ?>
            </div>
            <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
              <?php if ($kegiatans == null) {
              ?>
                <p class="update-program">
                  Belum Ada Informasi untuk Program Wakaf Ini.
                </p>
                <!-- <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->BaseUrl ?>/uploads/azhar.jpg"> -->
              <?php } else { ?>

                <p class="update-program">
                  <?= $kegiatans->kegiatan; ?>
                </p>
                <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->BaseUrl ?>/uploads/kegiatan/<?= $kegiatans->foto ?>">
              <?php } ?>
            </div>
            <div class="tab-pane fade" id="donatur" role="tabpanel" aria-labelledby="donatur-tab">
              <div class="table-responsive">
                <?php if ($donatur == null) { ?>
                  <p class="update-program">
                    Belum Ada Donatur untuk Program Wakaf Ini.
                  </p>
                  <!-- <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->BaseUrl ?>/uploads/azhar.jpg"> -->
                <?php } else { ?>
                  <table class="table table-hover">
                    <thead>
                      <?php foreach ($donatur as $done) { ?>
                        <tr>
                          <td class="border-bottom-3 border-top-0 donatur-program-img" rowspan="2">
                            <a href="<?= \Yii::$app->request->BaseUrl ?>/uploads/<?= $done->user->photo_url ?>" data-lightbox="update">
                              <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->BaseUrl ?>/uploads/<?= $done->user->photo_url ?>" width="100px">
                            </a>
                          </td>
                          <td class="border-top-0 donatur-program-nama"><?= $done->nama ?></td>
                          <td class="border-top-0"><?= \app\components\Tanggal::toReadableDate($done->tanggal_konfirmasi); ?></td>
                        </tr>
                        <tr>
                          <td class="border-bottom-3 border-top-0 pt-0 text-isalam-1 font-weight-bold donatur-uang"> <?= \app\components\Angka::toReadableHarga($done->nominal); ?></td>
                          <td class="border-bottom-3 border-top-0"></td>
                        </tr>
                      <?php } ?>
                    </thead>
                  </table>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.col-lg-12 -->
      <div class="col-lg-4 col-md-6 col-sm-12 pt-70">
        <!-- <div class="text-left">
          <p class="font-size-1 font-weight-bold">
            Penggalangan Dana Dimulai
          </p>
          <p class="font-size-1 font-weight-bold">
            <span class="text-isalam-1">
              <?= \app\components\Tanggal::toReadableDate($pendanaan->created_at); ?>
            </span>
            Oleh: Admin
          </p>
        </div> -->
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-4">
                <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->BaseUrl ?>/uploads/logo.png" width="100px">
              </div>
              <div class="col-8">
                <p class="text-isalam-1 font-weight-bold" style="padding-top: 12%;">Yayasan dan Lembaga Inisiator Salam</p>
              </div>
              <hr>
              <div class="col-4 text-left border-top-2 mt-4 pt-4">
                <p class="font-weight-bold">Oleh</p>
              </div>
              <div class="col-8 text-right border-top-2 mt-4 pt-4">
                <p class="font-weight-bold text-isalam-1"><?=$pendanaan->user->name?></p>
              </div>
              <div class="col-4 text-left border-top-2 mt-4 pt-4">
                <p class="font-weight-bold">Tanggal</p>
              </div>
              <div class="col-8 text-right border-top-2 mt-4 pt-4">
                <p class="font-weight-bold text-isalam-1"><?= \app\components\Tanggal::toReadableDate($pendanaan->created_at); ?></p>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="mt-4">
          <label for="" style="color:#787892;">Tambahkan Program Ini di Halaman Anda</label>
          <input type="text" style="width: 100%;" class="select-wakaf border-r5 p-2" value="Lorem ipsum dolor sit amet.">
        </div> -->
      </div>
    </div><!-- /.row -->
  </div><!-- /.container -->
</section><!-- /.blog Single -->
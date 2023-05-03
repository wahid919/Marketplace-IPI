<hr class="mt-0">
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <?= $this->render('component/sidemenu-profile') ?>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section">
            <h3 class="text-isalam-1 font-weight-bold text-detail-program">Laporan Wakaf</h3>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card shadow-br3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img class="border-r10" src="<?= \Yii::$app->request->BaseUrl ?>/uploads/money-icon.png" width="100px">
                                </div>
                                <div class="col-8">
                                    <p class="text-isalam-1 font-weight-bold font-size-1-3"><?= \app\components\Angka::toReadableHarga($jumlah_pembayaran); ?></p>
                                    <p class="font-weight-bold font-size-08">Total Dana Tersalurkan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 pb-4">
                    <div class="card shadow-br3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img class="border-r10" src="<?= \Yii::$app->request->BaseUrl ?>/uploads/success.png" width="100px">
                                </div>
                                <div class="col-8">
                                    <p class="text-isalam-1 font-weight-bold font-size-1-3"><?= $pembayaran_sukses ?></p>
                                    <p class="font-weight-bold font-size-08">Total Pembayaran Sukses</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php foreach ($proyek_didanai as $proyek) { ?>
                    <a href="<?= \Yii::$app->request->BaseUrl . '/home/detail-program/' . $proyek->pendanaan->id ?>">
                        <div class="col-lg-6 col-md-6 col-sm-8 col-8 text-left border-bottom-3">
                            <p class="font-weight-bold"><?= $proyek->pendanaan->nama_pendanaan ?></p>
                            <p class="font-size-08"><?= \app\components\Tanggal::toReadableDate($proyek->pendanaan->created_at); ?></p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-4 col-4 text-right border-bottom-3">
                            <p>Status Pendanaan</p>
                            <?php
                            $status_pembayaran = $proyek->pendanaan->status_id;
                            if ($status_pembayaran == 1 || $status_pembayaran == 2) {
                                $status = "btn-info";
                            }
                            if ($status_pembayaran == 3 || $status_pembayaran == 4 || $status_pembayaran == 6) {
                                $status = "btn-success";
                            }
                            if ($status_pembayaran == 5 || $status_pembayaran == 9 || $status_pembayaran == 10) {
                                $status = "btn-warning";
                            }
                            if ($status_pembayaran == 7 || $status_pembayaran == 8) {
                                $status = "btn-danger";
                            }
                            $status_pendanaan = \app\models\Status::find()->where(['id' => $proyek->pendanaan->status_id])->one();
                            ?>
                            <p><a href="#" class="btn btn-sm btn-program <?= $status ?>"><?= $status_pendanaan->name ?></a></p>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
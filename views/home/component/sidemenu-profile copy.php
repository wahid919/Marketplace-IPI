<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <?php
                $foto = Yii::$app->user->identity->photo_url;
                if ($foto == null) {
                ?>
                    <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->BaseUrl ?>/uploads/default.png" width="100px">
                <?php } else { ?>
                    <img class="border-r10 shadow-br3" src="<?= \Yii::$app->request->BaseUrl .'/uploads/user_image/'.$foto ?>" width="100px">
                <?php } ?>
            </div>
            <div class="col-8">
                <p class="font-weight-bold" style="padding-top: 12%;"><?= Yii::$app->user->identity->name ?></p>
                <p class="font-weight-bold"><a href="<?= \Yii::$app->request->BaseUrl ?>/home/edit-profile"><i class="fas fa-edit"></i> Edit</a></p>
            </div>
            <hr>
            <div class="col-12 text-right border-top-2 mt-4 pt-4">
                <table class="table table-borderless">
                    <tbody>
                        <tr class="border-bottom-3">
                            <td class="text-left w-10"><i class="fas fa-chart-bar fa-lg"></i></td>
                            <td class="text-left"><a href="<?= \Yii::$app->request->BaseUrl ?>/home/profile">Transaksi</a></td>
                        </tr>
                        <tr class="border-bottom-3">
                            <td class="text-left w-10"><i class="far fa-bell fa-lg"></i></td>
                            <td class="text-left"><a href="<?= \Yii::$app->request->BaseUrl ?>/home/notifikasi">Notifikasi</a></td>
                        </tr>
                        <tr class="border-bottom-3">
                            <td class="text-left w-10"><i class="far fa-file-alt fa-lg"></i></td>
                            <td class="text-left"><a href="<?= \Yii::$app->request->BaseUrl ?>/home/laporan-wakaf">Laporan Wakaf</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
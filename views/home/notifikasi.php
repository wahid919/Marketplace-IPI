<hr class="mt-0">
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <?= $this->render('component/sidemenu-profile') ?>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section">
            <h3 class="text-isalam-1 font-weight-bold text-detail-program">Notifikasi</h3>
            <div class="row">
                <?php foreach($notifs as $notif){ ?>
                    <div class="col-lg-6 col-md-6 col-sm-8 col-8 text-left border-bottom-3">
                    <p class="font-weight-bold"><?= $notif->message ?></p>
                    <p class="font-size-08"><?= \app\components\Tanggal::toReadableDate($notif->date); ?></span></p>
                </div>
                
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <?php

                use app\models\Toko;
use yii\helpers\Url;

                $toko = Toko::findOne(['id_user' => Yii::$app->user->identity->id]);
                $foto = Yii::$app->user->identity->photo_url;
                if (function_exists("checkCurrentNav") == false) {
                    function checkCurrentNav($target, $withindex = false)
                    {
                        $text = "";
                        $current_url = Url::current();
                        // $current_url = $_SERVER['REQUEST_URI'];
                        if ($withindex) $current_url .= "/index";
                  
                        if (is_array($target)) {
                            foreach ($target as $item) {
                                $item = Url::to([$item]);
                                if (stripos($current_url, $item) !== false) {
                                    $text = "active";
                                }
                  
                                if ($text != "") break;
                            }
                        } else {
                            $target = Url::to([$target]);
                            if ($withindex) $target .= "/index";
                            if (stripos($current_url, $target) !== false) {
                                $text = "active";
                            }
                        }
                  
                        return $text;
                    }
                  }
                ?>
                  
            </div>
            <div class="col-8">
                <p class="font-weight-bold" style="padding-top: 12%;"><?= $toko->nama ?></p>
                <p class="font-weight-bold"><a class="<?= checkCurrentNav('/home/edit-toko', true) ?>" href="<?= \Yii::$app->request->BaseUrl ?>/home/edit-toko"><i class="fas fa-edit"></i> Edit</a></p>
            </div>
            <hr>
            <div class="col-12 text-right border-top-2 mt-4 pt-4">
                <table class="table table-borderless">
                    <tbody>
                        <tr class="border-bottom-3">
                            <td class="text-left w-10"><i class="fa fa-home fa-lg"></i></td>
                            <td class="text-left"><a class="<?= checkCurrentNav('/home/toko-saya', true) ?>" href="<?= \Yii::$app->request->BaseUrl ?>/home/toko-saya">Beranda</a></td>
                        </tr>
                        <tr class="border-bottom-3">
                            <td class="text-left w-10"><i class="fas fa-chart-bar fa-lg"></i></td>
                            <td class="text-left"><a class="<?= checkCurrentNav('/home/produk-saya', true) ?>" href="<?= \Yii::$app->request->BaseUrl ?>/home/produk-saya">Produk</a></td>
                        </tr>
                        <!-- <tr class="border-bottom-3">
                            <td class="text-left w-10"><i class="far fa-bell fa-lg"></i></td>
                            <td class="text-left"><a href="<?= \Yii::$app->request->BaseUrl ?>/home/notifikasi">Notifikasi</a></td>
                        </tr>
                        <tr class="border-bottom-3">
                            <td class="text-left w-10"><i class="far fa-file-alt fa-lg"></i></td>
                            <td class="text-left"><a href="<?= \Yii::$app->request->BaseUrl ?>/home/laporan-wakaf">Laporan Wakaf</a></td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
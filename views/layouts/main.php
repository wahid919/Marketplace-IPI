<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Setting;
/* @var $this \yii\web\View */
/* @var $content string */

app\assets\AppAsset::register($this);
dmstr\web\AdminLteAsset::register($this);
\app\assets\AdminLtePluginAsset::register($this);
// app\assets\AdminVihoAssets::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
$pluginAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/plugins');
$set = Setting::find()->all();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <link rel="stylesheet" href="../../../">
    <script>
        var baseUrl = "<?= Yii::$app->urlManager->baseUrl ?>";
    </script>
    <link rel="icon" type="image/png" href=<?= \Yii::$app->request->BaseUrl . '/uploads/setting/' . $set["0"]->logo ?> />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet" />
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="https://kit.fontawesome.com/a31fc91734.js" />
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/icofont.css" />
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/themify.css" />
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/flag-icon.css" />
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/feather-icon.css" />
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/chartist.css" />
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/date-picker.css" />
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/prism.css" />
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/vector-map.css" />
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/bootstrap.css" />
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/style.css" />
    <link id="color" rel="stylesheet" href="https://laravel.pixelstrap.com/viho/assets/css/color-1.css" media="screen" />
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="https://laravel.pixelstrap.com/viho/assets/css/responsive.css" />
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="page-wrapper compact-sidebar" id="pageWrapper">
        <?= $this->render(
            'header.php',
            [
                'directoryAsset' => $directoryAsset,
                'pluginAsset' => $pluginAsset,
            ]
        ) ?>
        <div class="page-body-wrapper sidebar-icon">
            <?= $this->render(
                'left.php',
                [
                    'directoryAsset' => $directoryAsset,
                    'pluginAsset' => $pluginAsset,
                ]
            )
            ?>

            <?= $this->render(
                'content.php',
                [
                    'content' => $content,
                    'directoryAsset' => $directoryAsset,
                    'pluginAsset' => $pluginAsset,
                ]
            ) ?>
        </div>
    </div>
    <?php $this->endBody() ?>
    <!-- latest jquery-->
    <script src="https://laravel.pixelstrap.com/viho/assets/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="https://laravel.pixelstrap.com/viho/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="https://laravel.pixelstrap.com/viho/assets/js/sidebar-menu.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="https://laravel.pixelstrap.com/viho/assets/js/bootstrap/popper.min.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- Plugins JS start-->
    <script src="https://laravel.pixelstrap.com/viho/assets/js/chart/chartist/chartist.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/chart/knob/knob.min.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/chart/knob/knob-chart.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/prism/prism.min.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/clipboard/clipboard.min.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/counter/jquery.counterup.min.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/counter/counter-custom.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/custom-card/custom-card.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/vector-map/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/vector-map/map/jquery-jvectormap-us-aea-en.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/vector-map/map/jquery-jvectormap-uk-mill-en.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/vector-map/map/jquery-jvectormap-au-mill.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/vector-map/map/jquery-jvectormap-chicago-mill-en.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/vector-map/map/jquery-jvectormap-in-mill.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/vector-map/map/jquery-jvectormap-asia-mill.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/dashboard/default.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/notify/index.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/datepicker/date-picker/datepicker.en.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/datepicker/date-picker/datepicker.custom.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="https://laravel.pixelstrap.com/viho/assets/js/script.js"></script>
    <script src="https://laravel.pixelstrap.com/viho/assets/js/theme-customizer/customizer.js"></script>
    <!-- Plugin used-->
</body>

</html>
<?php $this->endPage() ?>
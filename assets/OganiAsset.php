<?php

namespace app\assets;

use yii\web\AssetBundle;

class OganiAsset extends AssetBundle
{
    public $basePath = '@webroot/template/assets2';
    public $baseUrl = '@web/template/assets2';

    public $css = [
        "css/libraries.css",
        // "css/style.css",
        "css/sweetalert2.min.css",
        // "fontawesome/css/all.css",
        "css/bootstrap.min.css",
        "css/font-awesome.min.css",
        "css/aos.css",
        "css/select2/select2-bootstrap4.min.css",
        "css/select2/select2.min.css",
        "css/responsive.css",
        "css/elegant-icons.css",
        "css/nice-select.css",
        "css/jquery-ui.min.css",
        "css/owl.carousel.min.css",
        "css/slicknav.min.css",
        "css/style.css",
        // "css/stylehome.css",
    ];
    public $js = [
        // "js/jquery-3.3.1.min.js",
        // "js/jquery.js",
        "js/plugins.js",
        "js/bootstrap.min.js",
        "js/select2/select2.min.js",
        "js/jquery.nice-select.min.js",
        "js/jquery-ui.min.js",
        // "js/jquery-3.3.1.min.js",
        "js/jquery.slicknav.js",
        "js/mixitup.min.js",
        "js/owl.carousel.min.js",
        "js/aos.js",
        "js/main.js",
        "js/sweetalert2.all.min.js",
        // "js/main.js",

    ];
    public $depends = [];
}

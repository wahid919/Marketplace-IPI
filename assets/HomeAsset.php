<?php

namespace app\assets;

use yii\web\AssetBundle;

class HomeAsset extends AssetBundle
{
    public $basePath = '@webroot/template/assets';
    public $baseUrl = '@web/template/assets';

    public $css = [
        "css/libraries.css",
        "css/style.css",
        "css/sweetalert2.min.css",
        "fontawesome/css/all.css"
    ];
    public $js = [
        // "js/jquery-3.3.1.min.js",
        "js/plugins.js",
        "js/main.js",
        "js/sweetalert2.all.min.js",
    ];
    public $depends = [];
}

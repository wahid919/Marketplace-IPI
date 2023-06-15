<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminVihoAssets extends AssetBundle
{
    public $basePath = '@webroot/adminassets';
    public $baseUrl = '@web/adminassets';
    public $css = [
        // "fontawesome/css/all.css",
        "css/fontawesome.all.min.css",
        'css/icofont.css',
        'css/themify.css',
        'css/flag-icon.css',
        'css/feather-icon.css',
        'css/animate.css',
        'css/chartist',
        'css/date-picker.css',
        'css/prism.css',
        'css/vector-map.css',
        'css/bootstrap.css',
        'css/style.css',
        'css/responsive.css'
    ];
    public $js = [
        'js/jquery-3.5.1.min.js',
        'js/feather.min.js',
        'js/feather-icon.js',
        'js/sidebar-menu.js',
        'js/config.js',
        'js/popper.min.js',
        'js/bootstrap.min.js',
        'js/chartist.js',
        'js/chartist-plugin-tooltip.js',
        'js/knob.min.js',
        'js/knob-chart.js',
        'js/apex-chart.js',
        'js/stock-prices.js',
        'js/prism.min.js',
        'js/clipboard.min.js',
        'js/jquery.waypoints.min.js',
        'js/jquery.counterup.min.js',
        'js/counter-custom.js',
        'js/custom-card.js',
        'js/bootstrap-notify.min.js',
        'js/jquery-jvectormap-2.0.2.min.js',
        'js/jquery-jvectormap-world-mill-en.js',
        'js/jquery-jvectormap-us-aea-en.js',
        'js/jquery-jvectormap-uk-mill-en.js',
        'js/jquery-jvectormap-au-mill.js',
        'js/jquery-jvectormap-chicago-mill-en.js',
        'js/jquery-jvectormap-in-mill.js',
        'js/jquery-jvectormap-asia-mill.js',
        'js/default.js',
        'js/index.js',
        'js/datepicker.js',
        'js/datepicker.en.js',
        'js/datepicker.custom.js',
        'js/script.js',
        'js/customizer.js'
    ];
}

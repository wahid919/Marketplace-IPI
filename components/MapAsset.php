<?php

namespace app\components;


use yii\web\AssetBundle;

class MapAsset extends AssetBundle
{
    // public $basePath = '@webroot/template/assets';
    public $baseUrl = '@web/template/assets';

    public $css = [
        "leaflet/leaflet.css",
        "leaflet/leaflet-search.css"
    ];
    public $js = [
        "leaflet/leaflet.js",
        "leaflet/leaflet-search.js",
        // "maps.googleapis.com/maps/api/js?key=AIzaSyCV6HOHjE9XM8IbEaL6ZMZdW8e0tavsOL8&libraries=places&region=id&language=en&sensor=false",
    ];
    public $depends = [];
}
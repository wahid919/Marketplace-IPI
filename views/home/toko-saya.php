<?php





\app\components\MapAsset::register($this);
?>
<style>
#map_canvas {
    width: 100%;
    height: 70vh;
    margin-bottom: 1rem;
    border-radius: 20px;
    box-shadow: 0 8px 4px 5px #eee;
}
</style>
<hr class="mt-0">
<?php if (Yii::$app->session->hasFlash('success')) : ?>
<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <p><i class="icon fa fa-check"></i>Saved!</p>
    <?= Yii::$app->session->getFlash('success') ?>
</div>
<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('error')) : ?>
<div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <h4><i class="icon fa fa-close"></i>Not Saved!</h4>
    <?= Yii::$app->session->getFlash('error') ?>
</div>
<?php endif; ?>
<div class="container pb-20">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <?= $this->render('component/sidemenu-toko') ?>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section">
            <h3 class="text-isalam-1 font-weight-bold text-detail-program"></h3>
            <div class="row">
                <h3>Selamat Datang di <?= $toko->nama ?></h3>
            </div>
            <div class="col-md-12 col-12" id="map_canvas"></div>
        </div>

    </div>
</div>
<?php

// if($model->coordinate!=null){
//     $coordinate = json_decode($model->coordinate);
//     $model->latitude = $coordinate->latitude;
//     $model->longitude = $coordinate->longitude;
// }
$lat = ($toko->latitude) ? $toko->latitude : 0;
$long = ($toko->longitude) ? $toko->longitude : 0;

$js = <<<JS
$(function() {
    let lat = $lat,
     lng = $long,
    
    map = L.map("map_canvas").setView([lat, lng], 13);
   let marker = L.marker([lat, lng]).addTo(map);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiZGVmcmluZHIiLCJhIjoiY2s4ZTN5ZjM0MDFrNzNsdG1tNXk2M2dlMSJ9.YXJM0PTu8PSsCCtYVjJNmw'
}).addTo(map);
});
JS;

$this->registerJs($js);
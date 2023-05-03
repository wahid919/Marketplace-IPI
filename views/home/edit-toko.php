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
<div class="container pb-20">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <?= $this->render('component/sidemenu-toko') ?>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section">
            <h3 class="text-isalam-1 font-weight-bold text-detail-program">Edit Toko</h3>
            <?php

            use yii\bootstrap\ActiveForm;
            use yii\helpers\Html;

            $form = ActiveForm::begin([
                'id' => 'Toko',
                'layout' => 'horizontal',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error',
                'enableClientScript' => false,
            ]);
            ?>
            <?php echo $form->errorSummary($model); ?>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <?= $form->field(
                        $model,
                        'nama',
                        [
                            'template' => '
                                {label}
                                {input}
                                {error}
                            ',
                            'inputOptions' => [
                                'class' => 'form-control'
                            ],
                            'labelOptions' => [
                                'class' => 'control-label'
                            ],
                            'options' => ['tag' => false]
                        ]
                    )->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <?= $form->field(
                        $model,
                        'no_whatsapp',
                        [
                            'template' => '
                                {label}
                                {input}
                                {error}
                            ',
                            'inputOptions' => [
                                'class' => 'form-control'
                            ],
                            'labelOptions' => [
                                'class' => 'control-label'
                            ],
                            'options' => ['tag' => false]
                        ]
                    )->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-12 col-12">
                    <?= $form->field($model, 'alamat',  [
                        'template' => '
                            {label}
                            {input}
                            {error}
                        ',
                        'inputOptions' => [
                            'class' => 'form-control'
                        ],
                        'labelOptions' => [
                            'class' => 'control-label'
                        ],
                        'options' => ['tag' => false]
                    ])->textarea(['rows' => '6']) ?>
                </div>
                <div class="col-lg-6">
                    <div class="">
                        <p class="" style="line-height: 33px;">Provinsi</p>
                        <div class="">

                            <select class="form-control" id="nama_provinsi" name="nama_provinsi" style="z-index: 3;">
                                <option value="" class="active">--Pilih Provinsi--</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group field-alamat-idkec required has-success">
                        <label class=" control-label" for="toko-idkec" style="">Distrik</label>
                        <div class="">
                            <select id="toko-idkec" class="form-control" name="Toko[idkec]" aria-required="true">
                                <option value="" class="active">--Pilih Distrik--</option>
                            </select>
                            <p class="help-block help-block-error "></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group field-toko-kodepos required ">
                        <br>
                        <label class="control-label " for="toko-kodepos">Kode Pos</label>
                        <div class="">
                            <input type="text" id="toko-kodepos" class="form-control" name="Toko[kodepos]" placeholder="otomatis keisi!" aria-required="true">
                            <p class="help-block help-block-error "></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-6">
                </div>
                <div class="col-md-12 col-12">
                    <?= $form->field($model, 'deskripsi',  [
                        'template' => '
                            {label}
                            {input}
                            {error}
                        ',
                        'inputOptions' => [
                            'class' => 'form-control'
                        ],
                        'labelOptions' => [
                            'class' => 'control-label'
                        ],
                        'options' => ['tag' => false]
                    ])->textarea(['rows' => '6']) ?>
                </div>
            </div>
            <div class="col-md-12 col-12" id="map_canvas"></div>
            <?= $form->field($model, 'longitude', \app\components\Constant::COLUMN(2, false))->textInput(['type' => 'hidden', 'maxlength' => true]) ?>
            <?= $form->field($model, 'latitude', \app\components\Constant::COLUMN(2, false))->textInput(['type' => 'hidden', 'maxlength' => true]) ?>
            <div class="clearfix"></div>

            <?= Html::submitButton('Simpan', [
                'class' => 'btn btn-sm btn-program btn-block',
                'data' => [
                    'data-confirm' => 'Apakah data yang anda masukkan sudah benar?'
                ],
                'style' => 'padding:10px!important;width:100%'
            ]); ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$js = <<<JS
$(function() {
    // alert("p "+$('#toko-latitude').val());
let id_lat = $('#toko-latitude'),
    id_lng = $('#toko-longitude'),
    lat = (id_lat.val() != "") ? id_lat.val() : -7.883065,
    lng = (id_lng.val() != "")  ? id_lng.val() : 112.533447,
    
    maps2 = L.map("map_canvas").setView([lat, lng], 13);
        // document.getElementById("latitudepenerima").value = posisiTitik.lat();
        // document.getElementById("longitudepenerima").value = posisiTitik.lng();
        marker2 = L.marker([lat, lng]).addTo(maps2);
    function onMapClickPenerima(e) {
            // alert(this.getLatLng());
            
            maps2.setView(e.latlng, 15);
        document.getElementById("toko-latitude").value = e.latlng.lat;
        document.getElementById("toko-longitude").value = e.latlng.lng;
        let lat = e.latlng.lat;
        let lon = e.latlng.lng;
        $.get('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='+lat+'&lon='+lon, function(data){
    // console.log(data.address.road);
    
    // document.getElementById("alamatPenerimaKiramBarang<?=$penerima?>").value = data.address.road;
});
// console.log(marker2);
if (marker2) { // check
maps2.removeLayer(marker2); // remove
}
marker2 = L.marker([e.latlng.lat, e.latlng.lng]).addTo(maps2);


}
maps2.on('click', onMapClickPenerima);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
attribution: 'Map',
maxZoom: 18,
id: 'mapbox/streets-v11',
tileSize: 512,
zoomOffset: -1,
accessToken: 'pk.eyJ1IjoiZGVmcmluZHIiLCJhIjoiY2s4ZTN5ZjM0MDFrNzNsdG1tNXk2M2dlMSJ9.YXJM0PTu8PSsCCtYVjJNmw'
}).addTo(maps2);
});

$.ajax({
            type: 'post',
            url: 'http://localhost:8080/ipi4/web/home/ajax-select-provinsi',
            success: function(htmlresponse) {
                $("#nama_provinsi").html(htmlresponse);
                $("#nama_provinsi").niceSelect('update');
            }
        })
        $("#nama_provinsi").on("change", function() {
            var id_provinsi_terpilih = $('option:selected', '#nama_provinsi').attr('id_provinsi');
            $.ajax({
                type: 'post',
                url: 'http://localhost:8080/ipi4/web/home/ajax-select-city',
                data: 'id_provinsi=' + id_provinsi_terpilih,
                success: function(htmlresponse) {
                    $("#toko-idkec").html(htmlresponse);
                    $("#toko-idkec").niceSelect('update');
                }
            });
        });
        $('#toko-idkec').on("change", function() {
            var pos = $('option:selected', '#toko-idkec').attr('kodepos');
            $("input[id=toko-kodepos]").val(pos);
        });
JS;

$this->registerJs($js);

<?php

use app\components\Constant;
use app\models\Slides;
use yii\bootstrap\ActiveForm;
use yii\db\Expression;

use yii\helpers\Html;

$slides = Slides::find()->where(['status' => 1])->orderBy(new Expression('rand()'))->one();
?>
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
<style>
    #FormRegister input {
        border-radius: 1.2rem;
        padding: .4rem 1rem;
        border: 1px solid #ccc;
    }

    #FormRegister .control-label {
        z-index: 9999;
        position: relative;
        bottom: -1.7rem;
        font-size: .8rem;
        left: 1.2rem;
        padding: .3rem;
        background: whitesmoke;
    }

    /* Change autocomplete styles in WebKit */
    #FormRegister input:-webkit-autofill,
    #FormRegister input:-webkit-autofill:hover,
    #FormRegister input:-webkit-autofill:focus,
    #FormRegister textarea:-webkit-autofill,
    #FormRegister textarea:-webkit-autofill:hover,
    #FormRegister textarea:-webkit-autofill:focus,
    #FormRegister select:-webkit-autofill,
    #FormRegister select:-webkit-autofill:hover,
    #FormRegister select:-webkit-autofill:focus {
        -webkit-box-shadow: 0 0 0px 1000px whitesmoke inset;
    }

    .btn-registrasi {
        width: 100%;
        border-radius: 1rem
    }

    .card {
        z-index: 999999999;
        margin: 10%;
    }

    .bannes {
        /* content: ""; */
        padding-left: 15px;
        padding-right: 15px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        /* margin-top: -8%; */
        height: 100%;
        margin: auto;
        /* z-index: -1; */
        background-image: url("<?= Yii::$app->request->baseUrl . '/uploads/slides/' . $slides->gambar ?>");
        /* background-position: center;
      background-repeat: no-repeat;
      background-size: cover; */
    }
</style>
<div class="bannes">
    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-12 col-lg-2">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="slide__content">
                    <div class="card">
                        <div class="card-body">
                            <h3 align="center">Daftar Toko</h3>
                            <?php $form = ActiveForm::begin([
                                'id' => 'Toko',
                                'layout' => 'horizontal',
                                'enableClientValidation' => true,
                                'errorSummaryCssClass' => 'error-summary alert alert-error'
                            ]);
                            ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <?= $form->field($model, "nama", Constant::COLUMN(1))->textInput()->label("Nama Toko") ?>
                                </div>
                                <div class="col-lg-6">
                                    <?= $form->field($model, "no_whatsapp", Constant::COLUMN(1))->textInput([
                                        "onkeydown" => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');",
                                        "onkeyup" => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');",
                                    ])->label("No HP") ?>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-md-12">
                                        <p class="col-md-12" style="line-height: 33px;">Provinsi</p>
                                        <div class="col-md-12">

                                            <select class="form-control" id="nama_provinsi" name="nama_provinsi" style="z-index: 3;">
                                                <option value="" class="active">--Pilih Provinsi--</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group field-alamat-idkec required has-success col-md-12">
                                        <label class="col-md-12 control-label" for="toko-idkec" style="">Distrik</label>
                                        <div class="col-md-12">
                                            <select id="toko-idkec" class="form-control" name="Toko[idkec]" aria-required="true">
                                                <option value="" class="active">--Pilih Distrik--</option>
                                            </select>
                                            <p class="help-block help-block-error "></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group field-toko-kodepos required col-md-12">
                                        <br>
                                        <label class="control-label col-md-12" for="toko-kodepos">Kode Pos</label>
                                        <div class="col-md-12">
                                            <input type="text" id="toko-kodepos" class="form-control" name="Toko[kodepos]" placeholder="otomatis keisi!" aria-required="true">
                                            <p class="help-block help-block-error "></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <?= $form->field($model, "alamat", Constant::COLUMN(1))->textarea(['rows' => '6']) ?>
                                </div>
                                <div class="col-lg-12">
                                    <?= $form->field($model, "deskripsi", Constant::COLUMN(1))->textarea(['rows' => '6'])->label("Deskripsi Toko") ?>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <?= Html::submitButton('Daftar Sekarang', [
                                            'class' => "btn btn-danger btn-block btn-flat btn-registrasi",
                                            'data' => [
                                                'confirm' => 'Apakah data yang anda masukkan sudah benar?'
                                            ]
                                        ]) ?>
                                        <!-- <button class="btn btn-primary btn-xs btn-registrasi">
                                            <?= Yii::t("cruds", "Daftar Sekarang") ?>
                                        </button> -->
                                    </div>
                                </div>
                            </div>

                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                </div><!-- /.slide-content -->
            </div><!-- /.col-lg-4 -->

            <div class="col-sm-12 col-md-12 col-lg-2">
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
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

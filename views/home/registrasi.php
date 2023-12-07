<?php

use yii\helpers\Html;
use app\models\Slides;
use yii\db\Expression;
use kartik\select2\Select2;
use app\components\Constant;

use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

$slides = Slides::find()->where(['status' => 1])->orderBy(new Expression('rand()'))->one();
// Ubah hasil query menjadi bentuk array menggunakan ArrayHelper::map()
$pondokArray = ArrayHelper::map($pondok, 'id', 'nama');

// Tambahkan pilihan "lainnya" secara manual
$otherOption = ['other' => 'Lainnya'];

// Gabungkan pilihan "lainnya" dengan data dari query
$finalData = $pondokArray + $otherOption;
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
        margin-top: 5%;
    }

    .control-label {
        z-index: 22;
        position: relative;
        bottom: -1.7rem;
        font-size: .8rem;
        left: 1.2rem;
        padding: .3rem;
        background: white;
        margin-top: 5%;
    }

    .field-registrasi-asal_pondok label.control-label {
        z-index: 22;
        position: relative;
        bottom: -0.7rem;
        font-size: .8rem;
        left: 1.2rem;
        padding: 0.3rem;
        background: white;
        margin-top: 5%;
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

    .card {
        /* z-index: 999999999; */
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

    .btn-registrasi {
        width: 100%;
        border-radius: 1rem
    }

    .select2-container--krajee .select2-selection--single .select2-selection__arrow {
        border: none;
        border-left: 1px solid #aaa;
        border-top-right-radius: 4px;
        border-bottom-right-radius: 4px;
        position: absolute;
        height: 26.5px;
        top: 1px;
        right: 1px;
        width: 20px;
    }

    .select2-container--krajee.select2-container--close.select2-container--below .select2-selection {
        width: fit-content;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        border-bottom-color: transparent;
    }

    .select2-container--open .select2-dropdown--below {
        border-top: none;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        width: 143px;
    }

    .select2-container--open .select2-dropdown--below::before {
        border-top: none;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        width: 143px;
    }

    .select2-container {
        box-sizing: border-box;
        display: inline-block;
        margin: 0;
        position: relative;
        vertical-align: middle;
        /* margin-left: -6%; */
        width: 110%;
    }
</style>

<div class="slide-item align-v-h bg-overlay">
    <div class="bannes">

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4" style="padding-top: 10%; padding-bottom: 10%;>
                    <div class=" slide__content">
                    <div class="card">
                        <div class="card-body">
                            <h3 align="center">Registrasi</h3>
                            <?php $form = ActiveForm::begin([
                                'id' => 'FormRegister',
                                'layout' => 'horizontal',
                                'enableClientValidation' => true,
                                'errorSummaryCssClass' => 'error-summary alert alert-error'
                            ]);
                            ?>
                            <div class="row">
                                <?= $form->field($model, "name", Constant::COLUMN(1))->textInput() ?>
                                <?= $form->field($model, "nomor_handphone", Constant::COLUMN(1))->textInput([
                                    "onkeydown" => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');",
                                    "onkeyup" => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');",
                                ])->label("No HP") ?>
                                <?= $form->field($model, "username", Constant::COLUMN(1))->textInput()->label("Email") ?>
                                <?= $form->field($model, "password", Constant::COLUMN(2))->passwordInput() ?>
                                <?= $form->field($model, "konfirmasi_password", Constant::COLUMN(2))->passwordInput() ?>
                                <?= $form->field($model, 'asal_pondok', Constant::COLUMN(1))->widget(Select2::classname(), [
                                    'data' => $finalData,
                                    'options' => [
                                        'placeholder' => 'Pilih Pondok'
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'tags' => true, // Ini memungkinkan penambahan pilihan baru
                                    ],
                                ])->label("Pondok"); ?>
                                <!-- Menampilkan input teks untuk "Lainnya" -->
                                <div id="otherOptionInput" style="display: none;flex: 0 0 100%;max-width: 100%; margin-top: -5%; padding-bottom: 5%;">
                                    <?= $form->field($model, 'other_asal_pondok', Constant::COLUMN(1))->textInput(['placeholder' => 'Masukkan pilihan lainnya'])->label("Pondok lain") ?>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        // Tangkap elemen select2
                                        var select2Element = $("#<?= Html::getInputId($model, 'asal_pondok') ?>");

                                        // Ketika pilihan berubah
                                        select2Element.on('change', function() {
                                            // Periksa apakah pilihan "Lainnya" dipilih
                                            if ($(this).val() === 'other') {
                                                // Tampilkan input teks "Lainnya"
                                                $("#otherOptionInput").show();
                                            } else {
                                                // Sembunyikan input teks "Lainnya"
                                                $("#otherOptionInput").hide();
                                            }
                                        });
                                    });
                                </script>

                                <?= $form->field($model, 'reCaptcha', ["template" => "{input}"])->widget(
                                    \app\components\ReCaptcha3::className(),
                                    [
                                        'siteKey' => Yii::$app->params['recaptcha3.clientKey'], // unnecessary is reCaptcha component was set up
                                        'action' => 'registrasi',
                                    ]
                                ) ?>

                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <button class="btn btn-danger btn-xs btn-registrasi">
                                            <?= Yii::t("cruds", "Registrasi Sekarang") ?>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                </div><!-- /.slide-content -->
            </div><!-- /.col-lg-4 -->

            <div class="col-sm-12 col-md-12 col-lg-4">
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</div>



</div><!-- /.carousel -->
<script>
    $(document).ready(function() {
        $('select').niceSelect('destroy');
    });
</script>
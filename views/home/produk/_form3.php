<?php

use app\components\Constant;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use kartik\file\FileInput;
use wbraganca\dynamicform\DynamicFormWidget;


/**
 * @var yii\web\View $this
 * @var app\models\Produk $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJsFile(Yii::getAlias("@web/tinymce/tinymce.min.js"));
// $uploadlink = Url::to(['site/upload-image']);
// $csrf = Yii::$app->request->csrfToken;

$this->registerJs("
      tinymce.init({
        selector: '.tinymce-form',
        height: '400',
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount',
        ],

        toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
      });
");
?>



<hr class="mt-0">
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
            <?= $this->render('../component/sidemenu-toko') ?>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section pb-20">
            <h3 class="text-isalam-1 font-weight-bold text-detail-program pl-20"><?= $model->isNewRecord ? 'Tambah' : 'Update' ?> Produk</h3>
            <!-- <div class="row"> -->
            <div class="box box-info">
                <div class="box-body">
                    <?php $form = ActiveForm::begin(
                        [
                            'id' => 'produk',
                            'layout' => 'horizontal',
                            'enableClientValidation' => true,
                            'errorSummaryCssClass' => 'error-summary alert alert-error'
                        ]
                    );
                    DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper',
                        'widgetBody' => '.container-items',
                        'widgetItem' => '.house-item',
                        'limit' => 10,
                        'min' => 1,
                        'insertButton' => '.add',
                        'deleteButton' => '.remove',
                        'model' => $modelsProductDetail[0],
                        'formId' => 'produk',
                        'formFields' => [
                            'stok',
                        ],
                    ]); ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Stok</th>
                                <th style="width: 450px;">Variant</th>
                                <th class="text-center" style="width: 90px;">
                                    <button type="button" class="add btn btn-success btn-xs"><span class="fa fa-plus"></span></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="container-items">
                            <?php foreach ($modelsProductDetail as $indexProductDetail => $modelProductDetail) : ?>
                                <tr class="house-item">
                                    <td class="vcenter">
                                        <?php
                                        // necessary for update action.
                                        if (!$modelProductDetail->isNewRecord) {
                                            echo Html::activeHiddenInput($modelProductDetail, "[{$indexProductDetail}]id");
                                        }
                                        ?>
                                        <?= $form->field($modelProductDetail, "[{$indexProductDetail}]stok")->label(false)->textInput(['maxlength' => true]) ?>
                                    </td>
                                    <td>
                                        <?= $this->render('../product-variant/_form', [
                                            'form' => $form,
                                            'indexProductDetail' => $indexProductDetail,
                                            'modelsProductVariant' => $modelsProductVariant[$indexProductDetail],
                                        ]) ?>
                                    </td>
                                    <td class="text-center vcenter" style="width: 90px; verti">
                                        <button type="button" class="remove-house btn btn-danger btn-xs"><span class="fa fa-minus"></span></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php DynamicFormWidget::end(); ?>

                    <?= $form->field($model, 'nama', Constant::COLUMN(1))->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'harga', Constant::COLUMN(1))->textInput(['type' => 'number']) ?>
                    <?= $form->field($model, 'stok', Constant::COLUMN(1))->textInput(['type' => 'number']) ?>
                    <?= // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::activeField
                    $form->field($model, 'kategori_produk_id', Constant::COLUMN(1))->dropDownList(
                        \yii\helpers\ArrayHelper::map(app\models\KategoriProduk::find()->all(), 'id', 'nama'),
                        [
                            'prompt' => 'Select',
                            'disabled' => (isset($relAttributes) && isset($relAttributes['kategori_produk_id'])),
                        ]
                    ); ?>
                    <br>
                    <?= $form->field($model, 'deskripsi_singkat', Constant::COLUMN(1))->textarea(['class' => 'tinymce-form form-control']) ?>
                    <?= $form->field($model, 'deksripsi_lengkap', Constant::COLUMN(1))->textarea(['class' => 'tinymce-form form-control']) ?>
                    <?= $form->field($model, 'status_online', Constant::COLUMN(1))->dropDownList(
                        ['0' => 'Tidak Aktif', '1' => 'Aktif']
                    ); ?>
                    <?= $form->field($model, 'foto_banner', Constant::COLUMN(1))->fileInput([
                        'options' => ['accept' => 'image/*'],
                        'pluginOptions' => [
                            'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'gif', 'bmp'],
                            'maxFileSize' => 250,
                        ],
                    ]) ?>
                    <?= $form->field($model, 'diskon_status', Constant::COLUMN(1))->dropDownList(
                        ['0' => 'Tidak Aktif', '1' => 'Aktif']
                    ); ?>
                    <?= $form->field($model, 'diskon', Constant::COLUMN(1))->textInput(['type' => 'number']) ?>
                    <hr />
                    <?php echo $form->errorSummary($model); ?>
                    <div class="row">
                        <div class="col-md-offset-3 col-md-10">
                            <div style="text-align:center">
                                <?= Html::submitButton($modelProductDetail->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->
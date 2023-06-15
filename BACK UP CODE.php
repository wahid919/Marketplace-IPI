<!-- Code dibawah merupakan back up dari code yang sebelum diperbarui -->
<?php
class HomeController extends Controller
{
    public function actionUpdateProduk($id)
    {
        // $modelPerson = $this->findModel($id);
        $model = $this->findModelProduk($id);
        $modelsProductDetail = $model->productDetail;
        $modelsProductVariant = [];
        $oldProductVariants = [];

        if (!empty($modelsProductDetail)) {
            foreach ($modelsProductDetail as $indexProductDetail => $modelProductDetail) {
                $productvariants = $modelProductDetail->productVariants;
                $modelsProductVariant[$indexProductDetail] = $productvariants;
                $oldProductVariants = ArrayHelper::merge(ArrayHelper::index($productvariants, 'id'), $oldProductVariants);
            }
        }

        $oldBanner = $model->foto_banner;
        if ($model->load($_POST)) {

            // reset
            $modelsProductVariant = [];

            $oldProductDetailIDs = ArrayHelper::map($modelsProductDetail, 'id', 'id');
            $modelsProductDetail = Model::createMultiple(ProductDetail::classname(), $modelsProductDetail);
            Model::loadMultiple($modelsProductDetail, Yii::$app->request->post());
            $deletedProductDetailIDs = array_diff($oldProductDetailIDs, array_filter(ArrayHelper::map($modelsProductDetail, 'id', 'id')));

            // validate person and houses models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsProductDetail) && $valid;

            $productvariantsIDs = [];
            if (isset($_POST['ProductVariant'][0][0])) {
                foreach ($_POST['ProductVariant'] as $indexProductDetail => $productvariants) {
                    $productvariantsIDs = ArrayHelper::merge($productvariantsIDs, array_filter(ArrayHelper::getColumn($productvariants, 'id')));
                    foreach ($productvariants as $indexProductVariant => $productvariant) {
                        $data['ProductVariant'] = $productvariant;
                        $modelProductVariant = (isset($productvariant['id']) && isset($oldProductVariants[$productvariant['id']])) ? $oldProductVariants[$productvariant['id']] : new ProductVariant;
                        $modelProductVariant->load($data);
                        $modelsProductVariant[$indexProductDetail][$indexProductVariant] = $modelProductVariant;
                        $valid = $modelProductVariant->validate();
                    }
                }
            }

            $oldProductVariantsIDs = ArrayHelper::getColumn($oldProductVariants, 'id');
            $deletedProductVariantsIDs = array_diff($oldProductVariantsIDs, $productvariantsIDs);

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {

                        if (!empty($deletedRoomsIDs)) {
                            ProductVariant::deleteAll(['id' => $deletedProductVariantsIDs]);
                        }

                        if (!empty($deletedHouseIDs)) {
                            ProductDetail::deleteAll(['id' => $deletedProductDetailIDs]);
                        }

                        foreach ($modelsProductDetail as $indexProductDetail => $modelProductDetail) {

                            if ($flag === false) {
                                break;
                            }

                            $modelProductDetail->id_product = $model->id;

                            if (!($flag = $modelProductDetail->save(false))) {
                                break;
                            }

                            if (isset($modelsRoom[$indexProductDetail]) && is_array($modelsProductVariant[$indexProductDetail])) {
                                foreach ($modelsProductVariant[$indexProductDetail] as $indexProductVariant => $modelProductVariant) {
                                    $modelProductVariant->product_detail_id = $modelProductDetail->id;
                                    if (!($flag = $modelProductVariant->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }
                    // var_dump($modelProductDetail);
                    // die;
                } catch (Exception $e) {
                    $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
                    $model->addError('_exception', $msg);
                    $transaction->rollBack();
                }
            }


            $foto_banners = UploadedFile::getInstance($model, 'foto_banner');
            if ($foto_banners != NULL) {
                # store the source file name
                $model->foto_banner = $foto_banners->name;
                $arr = explode(".", $foto_banners->name);
                $extension = end($arr);

                # generate a unique file name
                $model->foto_banner = Yii::$app->security->generateRandomString() . ".{$extension}";

                # the path to save file
                if (file_exists(Yii::getAlias("@app/web/uploads/banner_produk/")) == false) {
                    mkdir(Yii::getAlias("@app/web/uploads/banner_produk/"), 0777, true);
                }
                $path = Yii::getAlias("@app/web/uploads/banner_produk/") . $model->foto_banner;
                if ($oldBanner != NULL) {

                    $foto_banners->saveAs($path);
                    // unlink(Yii::$app->basePath . '/web/uploads/pendanaan/foto_banner/' . $oldBukti);
                } else {
                    $foto_banners->saveAs($path);
                }
            } else {
                $model->foto_banner = $oldBanner;
            }
            if ($model->save()) {

                if ($flag) {
                    $transaction->commit();
                    return $this->redirect(['view-produk', 'id' => $model->id]);
                } else {
                    $transaction->rollBack();
                }
                // return $this->redirect(Url::previous());
            }
        } else {
            return $this->render('produk/update', [
                'model' => $model,
                'modelsProductDetail' => (empty($modelsProductDetail)) ? [new ProductDetail] : $modelsProductDetail,
                'modelsProductVariant' => (empty($modelsProductVariant)) ? [[new ProductVariant]] : $modelsProductVariant
            ]);
        }
    }
}

// produk form
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-6 col-sm-12 col-12 profile-section pb-20">
            <h3 class="text-isalam-1 font-weight-bold text-detail-program pl-20"><?= $model->isNewRecord ? 'Tambah' : 'Update' ?> Produk</h3>
            <!-- <div class="row"> -->
            <div class="box box-info">
                <div class="box-body">
                    <?php $form = ActiveForm::begin(
                        [
                            'id' => 'dynamic-form',
                            'layout' => 'horizontal',
                            'enableClientValidation' => true,
                            'errorSummaryCssClass' => 'error-summary alert alert-error'
                        ]
                    ); ?>
                    <div class="row">
                        <div class="col-6">
                            <?= $form->field($model, 'nama', Constant::COLUMN(1))->textInput(['maxlength' => true]) ?>
                        </div>
                        <!-- <div class="col-6">
                            <?= $form->field($model, 'harga', Constant::COLUMN(1))->textInput(['type' => 'number']) ?>
                        </div>
                        <div class="col-6">
                            <?= $form->field($model, 'stok', Constant::COLUMN(1))->textInput(['type' => 'number']) ?>
                        </div> -->
                        <div class="col-6">
                            <?= $form->field($model, 'foto_banner', Constant::COLUMN(1))->fileInput([
                                'options' => ['accept' => 'image/*'],
                                'pluginOptions' => [
                                    'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'gif', 'bmp'],
                                    'maxFileSize' => 250,
                                ],
                            ]) ?>
                        </div>
                        <div class="col-6">
                            <?= // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::activeField
                            $form->field($model, 'kategori_produk_id', Constant::COLUMN(1))->dropDownList(
                                \yii\helpers\ArrayHelper::map(app\models\KategoriProduk::find()->all(), 'id', 'nama'),
                                [
                                    'prompt' => 'Select',
                                    'disabled' => (isset($relAttributes) && isset($relAttributes['kategori_produk_id'])),
                                ]
                            ); ?>
                        </div>
                        <div class="col-6">
                            <?= // generated by schmunk42\giiant\generators\crud\providers\core\RelationProvider::activeField
                            $form->field($model, 'toko_id', Constant::COLUMN(1))->dropDownList(
                                \yii\helpers\ArrayHelper::map(app\models\Toko::find()->all(), 'id', 'nama'),
                                [
                                    'prompt' => 'Select',
                                    'disabled' => (isset($relAttributes) && isset($relAttributes['toko_id'])),
                                ]
                            ); ?>
                        </div>


                    </div>
                    <?php DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper',
                        'widgetBody' => '.container-items',
                        'widgetItem' => '.house-item',
                        'limit' => 4,
                        'min' => 1,
                        'insertButton' => '.add-house',
                        'deleteButton' => '.remove-house',
                        'model' => $modelsProductDetail[0],
                        'formId' => 'dynamic-form',
                        'formFields' => [
                            'berat',
                            'stok',
                            'harga'
                        ],
                    ]); ?>
                    <label class="control-label" for="table-bordered" style="margin-left: 3%; padding-top:3%">Variasi Produk</label>
                    <table class="dynamicform_wrapper table table-bordered table-striped " style="margin-left: 3%;padding-right:4%;">
                        <thead>
                            <tr>
                                <th style="">Variant</th>
                                <th style="">Harga</th>
                                <th style="">Stok</th>
                                <th>Berat</th>
                                <th class="text-center" style="width: 90px;">
                                    <button type="button" class="add-house btn btn-success btn-xs"><span class="fa fa-plus"></span></button>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="container-items">
                            <?php foreach ($modelsProductDetail as $indexProductDetail => $modelProductDetail) : ?>
                                <tr class="house-item">

                                    <td>
                                        <?= $this->render('../product-variant/_form', [
                                            'form' => $form,
                                            'indexProductDetail' => $indexProductDetail,
                                            'modelsProductVariant' => $modelsProductVariant[$indexProductDetail],
                                        ]) ?>
                                    </td>
                                    <td class="vcenter">
                                        <?php
                                        // necessary for update action.
                                        if (!$modelProductDetail->isNewRecord) {
                                            echo Html::activeHiddenInput($modelProductDetail, "[{$indexProductDetail}]id");
                                        }
                                        ?>
                                        <?= $form->field($modelProductDetail, "[{$indexProductDetail}]harga")->label(false)->textInput(['maxlength' => true]) ?>
                                    </td>
                                    <td class="vcenter">
                                        <?php
                                        // necessary for update action.
                                        if (!$modelProductDetail->isNewRecord) {
                                            echo Html::activeHiddenInput($modelProductDetail, "[{$indexProductDetail}]id");
                                        }
                                        ?>
                                        <?= $form->field($modelProductDetail, "[{$indexProductDetail}]stok")->label(false)->textInput(['maxlength' => true]) ?>
                                    </td>
                                    <td class="vcenter">
                                        <?php
                                        // necessary for update action.
                                        if (!$modelProductDetail->isNewRecord) {
                                            echo Html::activeHiddenInput($modelProductDetail, "[{$indexProductDetail}]id");
                                        }
                                        ?>
                                        <?= $form->field($modelProductDetail, "[{$indexProductDetail}]berat")->label(false)->textInput(['maxlength' => true]) ?>
                                    </td>
                                    <td class="text-center vcenter" style="width: 90px; verti">
                                        <button type="button" class="remove-house btn btn-danger btn-xs"><span class="fa fa-minus"></span></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php DynamicFormWidget::end(); ?>
                    <div class="row">
                        <!-- <div class="col-3">
                            <?= $form->field($model, 'status_online', Constant::COLUMN(1))->dropDownList(
                                ['0' => 'Tidak Aktif', '1' => 'Aktif']
                            ); ?>
                        </div> -->
                        <div class="col-3">
                            <?= $form->field($model, 'diskon_status', Constant::COLUMN(1))->dropDownList(
                                ['0' => 'Tidak Aktif', '1' => 'Aktif']
                            ); ?>
                        </div>
                        <div class="col-3">

                        </div>
                        <div class="col-3">

                        </div>
                    </div>

                    <br>

                    <br>
                    <?= $form->field($model, 'diskon', Constant::COLUMN(1))->textInput(['type' => 'number']) ?>
                    <br>
                    <?= $form->field($model, 'deskripsi_singkat', Constant::COLUMN(1))->textarea(['class' => 'tinymce-form form-control']) ?>
                    <?= $form->field($model, 'deksripsi_lengkap', Constant::COLUMN(1))->textarea(['class' => 'tinymce-form form-control']) ?>
                    <?php echo $form->errorSummary($model); ?>
                    <!--  -->
                    <div class="row">
                        <div class="col-md-offset-3 col-12">
                            <div style="text-align:center">
                                <?= Html::submitButton($modelProductDetail->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

public function actionUpdateProduk($id)
    {
        $model = $this->findModelProduk($id);
        $modelsProductDetail = $model->productDetail;
        $modelsProductVariant = [];
        $oldProductVariants = [];

        if (!empty($modelsProductDetail)) {
            foreach ($modelsProductDetail as $indexProductDetail => $modelProductDetail) {
                $productvariants = $modelProductDetail->productVariants;
                $modelsProductVariant[$indexProductDetail] = $productvariants;
                $oldProductVariants = ArrayHelper::merge(ArrayHelper::index($productvariants, 'id'), $oldProductVariants);
            }
        }

        $oldBanner = $model->foto_banner;
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                // Reset product variants
                $modelsProductVariant = [];

                $oldProductDetailIDs = ArrayHelper::map($modelsProductDetail, 'id', 'id');
                $modelsProductDetail = Model::createMultiple(ProductDetail::classname(), $modelsProductDetail);
                Model::loadMultiple($modelsProductDetail, Yii::$app->request->post());
                $deletedProductDetailIDs = array_diff($oldProductDetailIDs, array_filter(ArrayHelper::map($modelsProductDetail, 'id', 'id')));

                // Validate models
                $valid = $model->validate();
                $valid = Model::validateMultiple($modelsProductDetail) && $valid;

                $productvariantsIDs = [];
                if (isset($_POST['ProductVariant'][0][0])) {
                    foreach ($_POST['ProductVariant'] as $indexProductDetail => $productvariants) {
                        $productvariantsIDs = ArrayHelper::merge($productvariantsIDs, array_filter(ArrayHelper::getColumn($productvariants, 'id')));
                        foreach ($productvariants as $indexProductVariant => $productvariant) {
                            $data['ProductVariant'] = $productvariant;
                            $modelProductVariant = (isset($productvariant['id']) && isset($oldProductVariants[$productvariant['id']])) ? $oldProductVariants[$productvariant['id']] : new ProductVariant;
                            $modelProductVariant->load($data);
                            $modelsProductVariant[$indexProductDetail][$indexProductVariant] = $modelProductVariant;
                            $valid = $modelProductVariant->validate();
                        }
                    }
                }

                $oldProductVariantsIDs = ArrayHelper::getColumn($oldProductVariants, 'id');
                $deletedProductVariantsIDs = array_diff($oldProductVariantsIDs, $productvariantsIDs);

                if ($valid) {
                    // Handle foto_banner
                    $foto_banners = UploadedFile::getInstance($model, 'foto_banner');
                    if ($foto_banners != NULL) {
                        # store the source file name
                        $model->foto_banner = $foto_banners->name;
                        $arr = explode(".", $foto_banners->name);
                        $extension = end($arr);

                        # generate a unique file name
                        $model->foto_banner = Yii::$app->security->generateRandomString() . ".{$extension}";

                        # the path to save file
                        if (file_exists(Yii::getAlias("@app/web/uploads/banner_produk/")) == false) {
                            mkdir(Yii::getAlias("@app/web/uploads/banner_produk/"), 0777, true);
                        }
                        $path = Yii::getAlias("@app/web/uploads/banner_produk/") . $model->foto_banner;
                        if ($oldBanner != NULL) {

                            $foto_banners->saveAs($path);
                            // unlink(Yii::$app->basePath . '/web/uploads/pendanaan/foto_banner/' . $oldBukti);
                        } else {
                            $foto_banners->saveAs($path);
                        }
                    } else {
                        $model->foto_banner = $oldBanner;
                    }
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedProductVariantsIDs)) {
                            ProductVariant::deleteAll(['id' => $deletedProductVariantsIDs]);
                        }

                        if (!empty($deletedProductDetailIDs)) {
                            ProductDetail::deleteAll(['id' => $deletedProductDetailIDs]);
                        }

                        foreach ($modelsProductDetail as $indexProductDetail => $modelProductDetail) {
                            if ($flag === false) {
                                break;
                            }

                            $modelProductDetail->id_product = $model->id;

                            if (!($flag = $modelProductDetail->save(false))) {
                                break;
                            }

                            if (isset($modelsProductVariant[$indexProductDetail]) && is_array($modelsProductVariant[$indexProductDetail])) {
                                foreach ($modelsProductVariant[$indexProductDetail] as $indexProductVariant => $modelProductVariant) {
                                    $modelProductVariant->product_detail_id = $modelProductDetail->id;
                                    if (!($flag = $modelProductVariant->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }

                if ($flag) {
                    $transaction->commit();
                    return $this->redirect(['view-produk', 'id' => $model->id]);
                } else {
                    $transaction->rollBack();
                }
            } catch (Exception $e) {
                $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
                $model->addError('_exception', $msg);
                $transaction->rollBack();
            }
        }

        return $this->render('produk/update', [
            'model' => $model,
            'modelsProductDetail' => (empty($modelsProductDetail)) ? [new ProductDetail] : $modelsProductDetail,
            'modelsProductVariant' => (empty($modelsProductVariant)) ? [[new ProductVariant]] : $modelsProductVariant
        ]);
    }



    // Model keranjang before update
    <?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\db\Expression;

use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "keranjang".
 *
 * @property integer $id
 * @property integer $produk_id
 * @property integer $user_id
 * @property string $variant1
 * @property string $variant2
 * @property string $harga
 * @property integer $jumlah
 * @property integer $id_transaksi
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \app\models\Produk $produk
 * @property \app\models\User $user
 * @property string $aliasModel
 */
abstract class Keranjang extends \yii\db\ActiveRecord
{


    public function fields()
    {
        $parent = parent::fields();

        unset($parent['updated_at']);
        unset($parent['created_at']);


        return $parent;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keranjang';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['produk_id', 'user_id', 'variant1', 'variant2', 'harga', 'jumlah'], 'required'],
            [['produk_id', 'user_id', 'jumlah', 'id_transaksi'], 'integer'],
            [['variant1', 'variant2', 'harga'], 'string', 'max' => 255],
            [['produk_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Produk::className(), 'targetAttribute' => ['produk_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\User::className(), 'targetAttribute' => ['user_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'produk_id' => 'Produk ID',
            'user_id' => 'User ID',
            'variant1' => 'Variant1',
            'variant2' => 'Variant2',
            'harga' => 'Harga',
            'jumlah' => 'Jumlah',
            'id_transaksi' => 'Id Transaksi',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduk()
    {
        return $this->hasOne(\app\models\Produk::className(), ['id' => 'produk_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }
}

<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "ProdukController".
 */

use app\models\FotoProduk;
use app\models\ProductVariant;

use app\models\Produk;
use Yii;

use app\models\ProductDetail;
use app\models\ReviewProduk;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use app\models\Toko;



class ProdukController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Produk';
    public $validation  = null;
    public function behaviors()
    {
        $parent = parent::behaviors();
        $parent['authentication'] = [
            "class" => "\app\components\CustomAuth",
            "except" => ["index", 'detail-produk', 'list-produk']
        ];

        return $parent;
    }

    public function verbs()
    {
        return [
            'index' => ['GET'],
            'view' => ['GET'],
            'add-cart' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
            'list-keranjang' => ['GET'],
            'product-cart' => ['GET'],
        ];
    }

    // public function actionTokoProduk($id){
    //     try{
    //         $mode
    //     }
    // }

    public function actionListProduk($id_kat = null)
    {
        $result = [];
        try {
            if ($id_kat != null) {
                $modelProduk = Produk::find()->where(['kategori_produk_id' => $id_kat])->all();
                if ($modelProduk != null) {
                    $result["success"] = true;
                    $result["message"] = "success";
                    $result["products"] = $modelProduk;
                } else {
                    $result["success"] = true;
                    $result["message"] = "success";
                    $result["products"] = $modelProduk;
                }
            } else {
                $modelProduk = Produk::find()->all();
                $result["success"] = true;
                $result["message"] = "success";
                $result["products"] = $modelProduk;
            }
            $result["productsCount"] = count($modelProduk);
        } catch (\Exception $e) {
            $result["success"] = false;
            $result["message"] = "gagal";
            $result["products"] = $modelProduk;
            //$result[""] = null;
        }
        return $result;
        //dd($modelProduk);
    }
    public function actionDetailProduk($id = null, $toko_id)
    {
        // Yii::$app->response->format = Response::FORMAT_JSON;
        $result = [];
        try {
            if ($id != null) {
                $modelDetailProduk = ProductDetail::find()->where(['id_product' => $id])->all();
                $minimumprice = ProductDetail::find()->where(['id_product' => $id])->min('harga');
                $maximumprice = ProductDetail::find()->where(['id_product' => $id])->max('harga');
                $averageprice = ProductDetail::find()->where(['id_product' => $id])->average('harga');
                $totalstok = ProductDetail::find()->where(['id_product' => $id])->sum('stok');
                $photogaleri = FotoProduk::find()->where(['produk_id' => $id])->all();
                $avgrating = ReviewProduk::find()->where(['produk_id' => $id])->average('rating');
                $countreview = ReviewProduk::find()->where(['produk_id' => $id])->count();
                // $produk = Produk::find()->where(['id' => $id]);
                $toko = Toko::find()->where(['id' => $toko_id])->one();
                $getwarnas = ProductVariant::find()
                    ->select('product_variant.*')
                    ->innerJoin('product_detail', "product_detail_id = product_detail.id")
                    ->where(['product_detail.id_product' => $id, 'type' => "color"])
                    ->all();

                $getsizes = ProductVariant::find()
                    ->select('product_variant.*')
                    ->innerJoin('product_detail', "product_detail_id = product_detail.id")
                    ->where(['product_detail.id_product' => $id, 'type' => "size"])
                    ->all();
                if ($modelDetailProduk != null) {
                    $result["success"] = true;
                    $result["message"] = "success";
                    $result["averageprice"] = $averageprice;
                    $result["maximumprice"] = $maximumprice;
                    $result["minimumprice"] = $minimumprice;
                    $result["totalstok"] = $totalstok;
                    $result["photogaleri"] = $photogaleri;
                    $result["getwarnas"] = $getwarnas;
                    $result["getsizes"] = $getsizes;
                    $result["avgrating"] = $avgrating;
                    $result["countreview"] = $countreview;
                    $result["toko"] = $toko;
                    $result["data"] = $modelDetailProduk;
                } else {
                    $result["success"] = false;
                    $result["message"] = "produk tidak ditemukan";
                    $result["averageprice"] = $averageprice;
                }
            } else {
                $modelDetailProduk = ProductDetail::find()->all();
                $result["success"] = true;
                $result["message"] = "success";
                $result["products"] = $modelDetailProduk;
            }
            $result["detailProductsCount"] = count($modelDetailProduk);
        } catch (\Exception $e) {
            $result["success"] = false;
            $result["message"] = "gagal";
            $result["products"] = $modelDetailProduk;
            //$result[""] = null;
        }
        return $result;
        //dd($modelProduk);
    }



    // public function actionIndex2()
    // {
    //     $query = $this->modelClass::find();
    //     return $this->dataProvider($query);
    // }

    // public function actionView($id)
    // {
    //     $model = $this->findModel($id);
    //     return ["success" => true, "data" => $model];
    // }


    // public function actionCreate()
    // {
    //     $model = new $this->modalClass;
    //     $model->scenario = $model::SCENARIO_CREATE;

    //     try {
    //         if ($model->load(\Yii::$app->request->post(), '')) {
    //             if ($model->validate()) {
    //                 $model->save();

    //                 return [
    //                     "success" => true,
    //                     "message" => "Data berhasil dihapus"
    //                 ];
    //             }

    //             throw new \yii\web\HttpException(422);
    //         }
    //         throw new \yii\web\HttpException(400);
    //     } catch (\Throwable $th) {
    //         throw new \yii\web\HttpException($th->getMessage());
    //     }
    // }

    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);
    //     $model->scenario = $model::SCENARIO_UPDATE;

    //     try {
    //         if ($model->load(\Yii::$app->request->post(), '')) {
    //             if ($model->validate()) {
    //                 $model->save();

    //                 return [
    //                     "success" => true,
    //                     "message" => "Data berhasil dihapus"
    //                 ];
    //             }

    //             throw new \yii\web\HttpException(422);
    //         }
    //         throw new \yii\web\HttpException(400);
    //     } catch (\Throwable $th) {
    //         throw new \yii\web\HttpException($th->getMessage());
    //     }
    // }

    // public function actionDelete($id)
    // {
    //     $model = $this->findModel($id);

    //     try {
    //         $model->delete();
    //         return [
    //             "success" => true,
    //             "message" => "Data berhasil dihapus"
    //         ];
    //     } catch (\Throwable $th) {
    //         throw new \yii\web\HttpException($th->getMessage());
    //     }
    // }
}

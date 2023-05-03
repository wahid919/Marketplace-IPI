<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "ProdukController".
 */

use app\models\Produk;
use app\models\ProductDetail;

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use app\models\Toko;



class ProdukController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Produk';
    public function behaviors()
    {
        $parent = parent::behaviors();
        // $parent['authentication'] = [
        //     "class" => "\app\components\CustomAuth",
        //     "only" => ["user-view","update-profile"],
        // ];

        return $parent;
    }
    protected function verbs()
    {
        return [
            'indexs' => ['GET'],
            'login' => ['POST'],
            'register' => ['POST'],
            'check-otp' => ['POST'],
            'refresh-otp' => ['POST'],
            'lupa-password' => ['POST'],
            'update-profile' => ['POST'],
        ];
    }
    public function actions()
    {
        $actions = parent::actions();
        // unset($actions['index']);
        // unset($actions['view']);
        // unset($actions['create']);
        // unset($actions['update']);
        // unset($actions['delete']);
        return $actions;
    }

    public function actionIndexs()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $produk = Produk::find()->all();

        return [
            'success' => true,
            'message' => 'success',
            'products' => $produk,
            'productsCount' => count($produk),
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
    public function actionDetailProduk($id = null)
    {
        $result = [];
        try {
            if ($id != null) {
                $minimumprice = ProductDetail::find()->where(['id_product' => $id])->min('harga');
                $maximumprice = ProductDetail::find()->where(['id_product' => $id])->max('harga');
                $averageprice = ProductDetail::find()->where(['id_product' => $id])->average('harga');
                if ($averageprice != null) {
                    $result["success"] = true;
                    $result["message"] = "success";
                    $result["products"] = $averageprice;
                } else {
                    $result["success"] = true;
                    $result["message"] = "success";
                    $result["products"] = $averageprice;
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

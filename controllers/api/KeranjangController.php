<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "KeranjangController".
 */

use yii\filters\AccessControl;
use Yii;
use yii\web\Response;

use app\traits\MessageTrait;

use app\models\Keranjang;
use app\models\Produk;
use yii\helpers\ArrayHelper;

// use function igorw\retry;    

class KeranjangController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Keranjang';
    public function behaviors()
    {
        $parent = parent::behaviors();
        $parent['authentication'] = [
            "class" => "\app\components\CustomAuth",
            "except" => ["list-keranjang", "view", 'add-cart', 'product-cart', 'order-cart']
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
    public function actionListKeranjang($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = [];
        try {
            if ($id != null) {
                $cart = Keranjang::find()->where(['user_id' => $id, 'id_transaksi' => 0])->all();
                $productcart = Produk::find()->all();
                if ($cart != null) {
                    $result["success"] = true;
                    $result["message"] = "success";
                    $result["cart"] = $cart;
                    $result['procart'] = $productcart;
                } else {
                    $result["success"] = false;
                    $result["message"] = "Keranjang Anda Kosong";
                    $result["cart"] = null;
                    $result['procart'] = null;
                }
            } else {
                $cart = Keranjang::find()->all();
                $result["success"] = false;
                $result["message"] = "error";
                $result["cart"] = null;
            }
            $result["productsCount"] = count($cart);
        } catch (\Exception $e) {
            $result["success"] = false;
            $result["message"] = "gagal";
            $result["cart"] = null;
        }
        return $result;
    }

    public function actionProductCart($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = [];
        try {
            $productcart = Produk::find()->where(['id' => $id])->one();
            if ($productcart != null) {
                $result["success"] = true;
                $result["message"] = "success";
                $result['procart'] = $productcart;
            } else {
                $result["success"] = false;
                $result["message"] = "error";
                $result["procart"] = $productcart;
            }
        } catch (\Exception $e) {
            $result["success"] = false;
            $result["message"] = "gagal";
            $result["procart"] = $productcart;
        }
        return $result;
    }


    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        // $this->validation = new \app\validations\Validation();
    }

    public function actionAddCart()
    {
        $cart = new $this->modelClass;

        // Load data dari permintaan POST
        // $request = Yii::$app->getRequest();
        Yii::$app->response->format = Response::FORMAT_JSON;
        // $cart->produk_id = Yii::$app->request->post('produk_id');
        // $cart->user_id = Yii::$app->request->post('user_id');
        // $cart->variant1 = Yii::$app->request->post('variant1');
        // $cart->variant2 = Yii::$app->request->post('variant2');
        // $cart->harga = Yii::$app->request->post('harga');
        // $cart->jumlah = Yii::$app->request->post('jumlah');
        if ($cart->load(Yii::$app->request->post(), '')) {
            $cart->id_transaksi = 0;
            $cart->status_id = 0;
            if ($cart->validate()) {

                $cart->save();

                return [
                    'success' => true,
                    'message' => 'Item added to cart successfully.',
                    'cart' => $cart
                ];
            }
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $cart->errors,
            ];
        } else {
            // Jika validasi gagal, kirim respon dengan kesalahan
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'success' => false,
                'errors' => $cart->errors,
            ];
        }
    }
}

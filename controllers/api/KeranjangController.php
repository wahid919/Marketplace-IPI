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
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\HttpException;

// use function igorw\retry;    

class KeranjangController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Keranjang';
    public function behaviors()
    {
        $parent = parent::behaviors();
        $parent['authentication'] = [
            "class" => "\app\components\CustomAuth",
            "except" => ["list-keranjang", "view", 'add-cart', 'product-cart', 'order-cart', 'remove-cart']
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
            // 'remove-cart' => ['GET'],
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

    // public function actionProductCart($id)
    // {
    //     Yii::$app->response->format = Response::FORMAT_JSON;
    //     $result = [];

    //     try {
    //         $productcart = Produk::find()->where(['id' => $id])->one();
    //         if ($productcart != null) {
    //             $result["success"] = true;
    //             $result["message"] = "success";
    //             $result['procart'] = $productcart;
    //         } else {
    //             $result["success"] = false;
    //             $result["message"] = "error";
    //             $result["procart"] = $productcart;
    //         }
    //     } catch (\Exception $e) {
    //         $result["success"] = false;
    //         $result["message"] = "gagal";
    //         $result["procart"] = $productcart;
    //     }
    //     return $result;
    // }

    public function actionProductCart($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $result = [];
        $productcart = (new Query())
            ->select(["p.*, CONCAT('http://" . $_SERVER['HTTP_HOST'] . "/ipi4/web/uploads/banner_produk/', p.foto_banner) as banner_produk, t.nama toko_nama, t.id toko_id, t.idkec toko_idkec"],)
            ->from('produk p')
            ->join('JOIN', 'toko t', 't.id = p.toko_id')
            ->where(['p.id' => $id])
            ->one();
        try {
            // $productcart = Produk::find()->where(['id' => $id])->one();
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
            $cart->status_id = 3;
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
    public function actionRemoveCart($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            \Yii::$app->getSession()->addFlash('error', $msg);
            return $this->redirect(Url::previous());
        }

        // TODO: improve detection
        $isPivot = strstr('$id', ',');
        if ($isPivot == true) {
            return $this->redirect(Url::previous());
        } elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
            Url::remember(null);
            $url = \Yii::$app->session['__crudReturnUrl'];
            \Yii::$app->session['__crudReturnUrl'] = null;

            return $this->redirect($url);
        } else {
            return [
                'success' => true,
                'message' => 'Item remove to cart successfully.',
                // 'cart' => $cart
            ];
            // return $this->redirect(['index']);

        }
    }

    protected function findModel($id)
    {
        if (($model = Keranjang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }
}

<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "PesananController".
 */

use app\models\Pesanan;
use app\models\Keranjang;

use yii\web\Response;

use app\models\Produk;

use yii\data\Pagination;

use Yii;

use yii\helpers\Url;

use dmstr\bootstrap\Tabs;

use app\models\search\PesananSearch;

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class PesananController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Pesanan';
    public $validation  = null;
    public function behaviors()
    {
        $parent = parent::behaviors();
        $parent['authentication'] = [
            "class" => "\app\components\CustomAuth",
            "except" => ["index", 'pesanan', 'find-midtrans', 'order-cart', 'product-order']
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
            'list-alamat' => ['GET'],
        ];
    }

    // public function actionTokoProduk($id){
    //     try{
    //         $mode
    //     }
    // }

    public function actionPesanan($id = null)
    {
        // $searchModel  = new PesananSearch;
        // $dataProvider = $searchModel->search($_GET);

        // Tabs::clearLocalStorage();

        // Url::remember();
        // \Yii::$app->session['__crudReturnUrl'] = null;

        // $confirm = Yii::$app->user->identity->confirm;
        // $status = Yii::$app->user->identity->status;
        // if ($confirm != 1 || $status != 1) {
        //     return $this->redirect(["home/index"]);
        // }
        // $request = Yii::$app->request;
        // $stt = $request->get('transaction_status');
        // var_dump($stt);
        // die;
        $result = [];
        $data_all = Pesanan::find()->where(['usrid' => $id])->orderBy(['id' => SORT_DESC])->all();

        $query = Pesanan::find()->where(['usrid' => $id]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 6]);
        $pesanans = $query->offset($pagination->offset)
            ->where(['usrid' => $id])
            ->limit($pagination->limit)
            ->orderBy(['id' => SORT_DESC])
            ->all();
        foreach ($data_all as $data) {
            $wf = Pesanan::find()->where(['id' => $data->id])->one();
            // $a = $this->findMidtrans($wf->kode_transaksi);
            $a = $this->findMidtrans($wf->invoice);
            // var_dump($a);
            // die;

            if ($a->status_code == "404") {
                $wf->status_id = $wf->status_id;
                $sts = "Tidak Ada";
            } else {
                if ($a->transaction_status == "pending") {
                    $wf->status_id = 3;
                    $sts = "Ada";
                } elseif ($a->transaction_status == "capture" || $a->transaction_status == "settlement") {
                    $wf->status_id = 2;
                    $wf->selesai = date('Y-m-d H:i:s');
                    $sts = "Ada";
                } elseif ($a->transaction_status == "deny") {
                    $wf->status_id = 4;
                    $wf->selesai = date('Y-m-d H:i:s');
                    $sts = "Ada";
                } elseif ($a->transaction_status == "cancel") {
                    $wf->status_id = 5;
                    $wf->selesai = date('Y-m-d H:i:s');
                    $sts = "Ada";
                } elseif ($a->transaction_status == "expire") {
                    $wf->status_id = 6;
                    $wf->selesai = date('Y-m-d H:i:s');
                    $wf->keterangan = "Melewati Batas Waktu Pembayaran";
                    $sts = "Ada";
                }
            }
            // var_dump($wf);
            // die;
            if ($a->status_code == "404") {
                // $wf->jenis_pembayaran_id = "Tidak Ditemukan";
            } else {
                if ($a->payment_type == "cstore") {
                    // $wf->jenis_pembayaran_id = $a->store;
                } else {
                    // $wf->jenis_pembayaran_id = $a->payment_type;
                }
            }
            $wf->save();
        }
        $result["success"] = true;
        $result["message"] = "success";
        $result["pesanan"] = $data_all;
        return $result;
    }

    protected function findMidtrans($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/" . $id . "/status",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "\n\n",
            CURLOPT_HTTPHEADER => array(
                "Accept: application/json",
                "Content-Type: application/json",
                "Authorization: Basic U0ItTWlkLXNlcnZlci1LZk9IdElZUWRNLW1aY1IwR2xzbEprMjg6"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $a = json_decode($response);
        return $a;
    }
    public function actionOrderCart($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = [];
        try {
            $ordercart = Keranjang::find()->where(['user_id' => $id])->all();
            if ($ordercart != null) {
                $result["success"] = true;
                $result["message"] = "success";
                $result['ordercart'] = $ordercart;
            } else {
                $result["success"] = false;
                $result["message"] = "error";
                $result["ordercart"] = $ordercart;
            }
        } catch (\Exception $e) {
            $result["success"] = false;
            $result["message"] = "gagal";
            $result["ordercart"] = $ordercart;
        }
        return $result;
    }
    public function actionProductOrder()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $result = [];
        try {
            $productorder = Produk::find()->all();

            if ($productorder != null) {
                $result["success"] = true;
                $result["message"] = "success";
                $result['productorder'] = $productorder;
            } else {
                $result["success"] = false;
                $result["message"] = "error";
                $result["productorder"] = $productorder;
            }
        } catch (\Exception $e) {
            $result["success"] = false;
            $result["message"] = "gagal";
            $result["productorder"] = $productorder;
        }
        return $result;
    }
}

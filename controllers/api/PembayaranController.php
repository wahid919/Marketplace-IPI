<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "PembayaranController".
 */

use yii\filters\AccessControl;
use Midtrans\Notification;

use app\models\Pesanan;

use app\models\Keranjang;

use Yii;

use app\components\ActionMidtransConfig;

use yii\web\Response;

use yii\helpers\ArrayHelper;

class PembayaranController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Pembayaran';
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

    public function actionCreatePayment()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Set Midtrans credentials
        ActionMidtransConfig::$serverKey = 'SB-Mid-server-KfOHtIYQdM-mZcR0GlslJk28';
        ActionMidtransConfig::$clientKey = 'SB-Mid-client-O9CttO-48I-qx0KO';


        // non-relevant function only used for demo/example purpose

        // Uncomment for production environment
        ActionMidtransConfig::$isProduction = false;

        // Enable sanitization
        ActionMidtransConfig::$isSanitized = true;

        // Enable 3D-Secure
        ActionMidtransConfig::$is3ds = true;


        $amount = Yii::$app->request->post('amount');
        $orderId = Yii::$app->request->post('orderId');
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Create transaction token
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $amount,
            ],
        ];

        $token = \app\components\ActionMidtransSnap::getSnapToken($params);

        $model = new Pesanan();

        $model->invoice = $orderId;
        $model->nama = 'wahid';
        $model->nominal = $amount;
        $model->usrid  = (int)58;
        $model->alamat_pembeli = 'soetomo';
        $model->alamat_penjual = 'akslakas';
        $model->berat = (int)500;
        $model->ongkir = (int)20000;
        $model->kurir = 'JNE';
        $model->paket = 'Express';
        $model->dari = (int)11;
        $model->tujuan = (int)150;
        $model->resi =  "TRX" . $orderId;
        $model->id_bayar = 2;
        $model->ajukanbatal = 1;
        $model->keterangan = "Proses";
        $model->status_id = 3;
        $model->token_midtrans = $token;
        try {
            if ($model->validate()) {
                // var_dump($model->validate());
                // die;
                $model->save();
                // $this->layout= false;
                $idsr = 58;
                Keranjang::updateAll(['id_transaksi' => $model->id], "user_id = $idsr && id_transaksi = 0 ");
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['token' => $token];
                // return $this->render('pesanan/halo', [
                //     'snapToken' => $snapToken,
                //     'order'
                // ]);
                // return $this->render(['pesanan/halo']);
                // return ['success' => true, 'message' => 'success', 'data' => $model, 'code' => $hasil_code,'url'=>$hasil];
            } else if (!$model->validate()) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'token' => $model->getErrors()
                ];
            } else {

                return [
                    'token' => $model->getErrors()
                ];
                // return ['success' => false, 'message' => 'gagal', 'data' => $model->getErrors()];

                // Yii::$app->response->format = Response::FORMAT_JSON;

                // return [
                //     'success' => true,
                //     'url' => $paymentUrl
                // ];
                // }
            }
            // $token = \app\components\ActionMidtransSnap::getSnapToken($params);
            // return ['token' => $token];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
    public function actionNotification()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Set Midtrans credentials
        ActionMidtransConfig::$serverKey = 'SB-Mid-server-KfOHtIYQdM-mZcR0GlslJk28';
        ActionMidtransConfig::$isProduction = false;

        // Handle notification
        $notification = new Notification();

        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;

        // Update order status based on transaction status
        $order = Pesanan::findOne(['invoice' => $orderId]);
        if ($order) {
            if ($transactionStatus == 'capture') {
                // Pembayaran berhasil
                $order->status_id = 2;
                // Lakukan tindakan lain yang diperlukan
            } elseif ($transactionStatus == 'settlement') {
                // Pembayaran selesai, tetapi masih dalam proses verifikasi
                $order->status_id = 2;
                // Lakukan tindakan lain yang diperlukan
            } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
                // Pembayaran gagal atau dibatalkan
                $order->status_id = 5;
                // Lakukan tindakan lain yang diperlukan
            }

            $order->save();

            return ['success' => true];
        }

        return ['success' => false];
    }
}

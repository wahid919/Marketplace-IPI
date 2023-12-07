<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "PembayaranController".
 */

use yii\filters\AccessControl;
use app\models\Toko;

use yii\db\Query;

use app\models\Pesanan;

use Midtrans\Notification;

use app\models\DetailPesanan;

use app\models\Keranjang;

use Yii;

use app\components\ActionMidtransConfig;
use app\models\User;
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
        $amount = Yii::$app->request->post('amount');
        $orderId = Yii::$app->request->post('orderId');
        $idsr = Yii::$app->request->post('IdUser');
        $user = User::find()->where(['id' => $idsr])->one();
        // var_dump($kurir);
        // die;
        // $totalbayar = $_POST['totalbayar'];
        // $kodepospembeli = $_POST['kodepospembeli'];
        // $alamatpembeli = $_POST['alamatpembeli'];

        //production
        // ActionMidtransConfig::$serverKey = 'SB-Mid-server-LWT_5RGvHlROlIbmaE8K0ntb';
        // ActionMidtransConfig::$clientKey = 'SB-Mid-client-lrPe45BCGoT9yG2O';

        //sandbox
        ActionMidtransConfig::$serverKey = 'SB-Mid-server-KfOHtIYQdM-mZcR0GlslJk28';
        ActionMidtransConfig::$clientKey = 'SB-Mid-client-O9CttO-48I-qx0KO';


        // non-relevant function only used for demo/example purpose

        // Uncomment for production environment
        ActionMidtransConfig::$isProduction = false;

        // Enable sanitization
        ActionMidtransConfig::$isSanitized = true;

        // Enable 3D-Secure
        ActionMidtransConfig::$is3ds = true;

        // $confirm = Yii::$app->user->identity->confirm;
        // $status = Yii::$app->user->identity->status;
        // $idsr = Yii::$app->user->identity->id;
        // if ($confirm != 1 || $status != 1) {
        //     return $this->redirect(["home/index"]);
        // }



        // Required
        $items = Keranjang::find()->where(['id_transaksi' => 0])->all();
        // var_dump($items);
        // die;
        $items = array(
            array(
                'id'       => 'item1',
                'price'    => 100000,
                'quantity' => 1,
                'name'     => 'Adidas f50'
            ),
            array(
                'id'       => 'item2',
                'price'    => 50000,
                'quantity' => 2,
                'name'     => 'Nike N90'
            )
        );

        // Populate customer's billing address
        $billing_address = array(
            'first_name'   => "Andri",
            'last_name'    => "Setiawan",
            'address'      => "Karet Belakang 15A, Setiabudi.",
            'city'         => "Jakarta",
            'postal_code'  => "51161",
            'phone'        => "081322311801",
            'country_code' => 'IDN'
        );

        // Populate customer's shipping address
        $shipping_address = array(
            'first_name'   => "John",
            'last_name'    => "Watson",
            'address'      => "Bakerstreet 221B.",
            'city'         => "Jakarta",
            'postal_code'  => "51162",
            'phone'        => "081322311801",
            'country_code' => 'IDN'
        );

        // Populate customer's info
        $customer_details = array(
            'first_name'       => $user->name,
            'last_name'        => " Customer",
            'email'            => $user->username,
            'phone'            => $user->nomor_handphone,
            'billing_address'  => "Sby",
            'shipping_address' => $shipping_address,
        );
        $order_id_midtrans = $orderId;
        $transaction_details = [
            'order_id' => $orderId,
            'gross_amount' => $amount,
        ];


        $params = [
            "transaction_details" => $transaction_details,
            "customer_details" => $customer_details,
        ];


        $snapToken = \app\components\ActionMidtransSnap::getSnapToken($params);
        // var_dump($snapToken); die;
        // if ($totalbayar = !null) {
        $pesanan = new Pesanan();
        $pesanan->created_at = date('Y-m-d H:i:s');
        $pesanan->user_id = $idsr;
        $pesanan->invoice = $order_id_midtrans;
        $pesanan->token_midtrans = $snapToken;
        $pesanan->nominal = $amount;
        $pesanan->save();

        // die(var_dump($result))
        // $keranjang = Keranjang::find()->where(["user_id = $idsr && id_transaksi = 0"])->all();
        $query = (new Query())
            ->select('*')
            ->from('keranjang k')
            ->join('JOIN', 'produk p', 'k.produk_id = p.id')
            ->join('JOIN', 'product_detail pd', 'p.id = pd.id_product')
            ->where(['k.user_id' => $idsr, 'k.id_transaksi' => 0]);

        $keranjang = $query->all();

        $mapByToko = null;

        foreach ($keranjang as $ker) {
            $mapByToko[$ker['toko_id']][] = $ker;
        }

        foreach ($mapByToko as $toko_id => $listProduk) {
            $totalbayar = 0;
            $berat = 0;
            $idkec_penjual = Toko::find()->select('idkec')->where(['id' => $toko_id])->one();
            // var_dump($idkec_penjual->idkec);
            // die;
            foreach ($listProduk as $produk) {
                $totalbayar = $totalbayar + $produk['harga'];
            }
            $model = new DetailPesanan();
            $model->toko_id = $toko_id;
            $model->pesanan_id = $pesanan->id;
            $model->invoice = $order_id_midtrans;
            $model->nama = $user->name;
            $model->nominal = $totalbayar;
            $model->usrid  = $user->id;
            $model->alamat_pembeli = 'saassasa';
            $model->alamat_penjual = $idkec_penjual->idkec;
            $model->berat = (int)$berat;
            $model->ongkir = (int)23400;
            $model->kurir = 'JNE';
            $model->paket = 'Eexpress';
            $model->dari = (int)11;
            $model->tujuan = (int)150;
            $model->resi =  null;
            $model->id_bayar = 2;
            $model->ajukanbatal = 1;
            $model->keterangan = "Proses";
            $model->status_id = 3;
            $model->token_midtrans = $snapToken;

            if ($model->validate()) {
                // var_dump($model->validate());
                // die;
                $model->save();
                // $this->layout= false;

                Yii::$app->db->createCommand("
                UPDATE keranjang k
                JOIN produk p ON k.produk_id = p.id
                JOIN toko t ON t.id = p.toko_id
                SET id_transaksi = " . $model->id . "
                WHERE k.user_id = " . $idsr . "
                AND k.id_transaksi = 0
                AND t.id = " . $toko_id)->execute();
            } else if (!$model->validate()) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'success' => false,
                    'message' => $model->getErrors()
                ];
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return [
                    'success' => false,
                    'message' => $model->getErrors()
                ];
            }
            // $model->save();

            // var_dump($model);
            // die;
            // var_dump($model->id);
            // var_dump($mapByToko);
            // var_dump($toko_id);
            // die;
            // Yii::$app->db->createCommand("
            // UPDATE keranjang k
            // JOIN produk p ON k.produk_id = p.id
            // JOIN toko t ON t.id = p.toko_id
            // SET id_transaksi = " . $model->id . "
            // WHERE k.user_id = " . $idsr . "
            // AND k.id_transaksi = 0
            // AND t.id = " . $toko_id)->execute();

            //             $sql = "
            //     UPDATE keranjang k
            //     JOIN produk p ON k.produk_id = p.id
            //     JOIN toko t ON t.id = p.toko_id
            //     SET k.id_transaksi = :id_transaksi
            //     WHERE k.user_id = :user_id
            //     AND k.id_transaksi = 0
            //     AND t.id = :toko_id
            // ";

            //             Yii::$app->db->createCommand($sql)
            //                 ->bindValue(':id_transaksi', $model->id)
            //                 ->bindValue(':user_id', $idsr)
            //                 ->bindValue(':toko_id', $toko_id)
            //                 ->execute();
            // Keranjang::updateAll(['id_transaksi' => $model->id, 'created_at2' => date('Y-m-d H:i:s')], "user_id = $idsr && id_transaksi = 0 ");
        }
        return ['token' => $snapToken];
        // echo  json_encode([
        //     'success' => true,
        //     'data' => 'okee',
        // ]);

        // Yii::$app->getResponse()->redirect(['pesanan'])->send();
    }
    // public function actionCreatePayment()
    // {
    //     Yii::$app->response->format = Response::FORMAT_JSON;

    //     // Set Midtrans credentials
    //     ActionMidtransConfig::$serverKey = 'SB-Mid-server-KfOHtIYQdM-mZcR0GlslJk28';
    //     ActionMidtransConfig::$clientKey = 'SB-Mid-client-O9CttO-48I-qx0KO';


    //     // non-relevant function only used for demo/example purpose

    //     // Uncomment for production environment
    //     ActionMidtransConfig::$isProduction = false;

    //     // Enable sanitization
    //     ActionMidtransConfig::$isSanitized = true;

    //     // Enable 3D-Secure
    //     ActionMidtransConfig::$is3ds = true;


    //     $amount = Yii::$app->request->post('amount');
    //     $orderId = Yii::$app->request->post('orderId');
    //     Yii::$app->response->format = Response::FORMAT_JSON;

    //     // Create transaction token
    //     $params = [
    //         'transaction_details' => [
    //             'order_id' => $orderId,
    //             'gross_amount' => $amount,
    //         ],
    //     ];

    //     $token = \app\components\ActionMidtransSnap::getSnapToken($params);

    //     $model = new DetailPesanan();

    //     $model->invoice = $orderId;
    //     $model->nama = 'Akbar';
    //     $model->nominal = $amount;
    //     $model->usrid  = (int)58;
    //     $model->alamat_pembeli = 'soetomo';
    //     $model->alamat_penjual = 161;
    //     $model->berat = (int)500;
    //     $model->ongkir = (int)20000;
    //     $model->kurir = 'JNE';
    //     $model->paket = 'Express';
    //     $model->dari = (int)11;
    //     $model->tujuan = (int)150;
    //     $model->resi =  "TRX" . $orderId;
    //     $model->id_bayar = 2;
    //     $model->ajukanbatal = 1;
    //     $model->keterangan = "Proses";
    //     $model->status_id = 3;
    //     $model->token_midtrans = $token;
    //     try {
    //         if ($model->validate()) {
    //             // var_dump($model->validate());
    //             // die;
    //             $model->save();
    //             // $this->layout= false;
    //             $idsr = 58;
    //             Keranjang::updateAll(['id_transaksi' => $model->id], "user_id = $idsr && id_transaksi = 0 ");
    //             Yii::$app->response->format = Response::FORMAT_JSON;
    //             return ['token' => $token];
    //             // return $this->render('pesanan/halo', [
    //             //     'snapToken' => $snapToken,
    //             //     'order'
    //             // ]);
    //             // return $this->render(['pesanan/halo']);
    //             // return ['success' => true, 'message' => 'success', 'data' => $model, 'code' => $hasil_code,'url'=>$hasil];
    //         } else if (!$model->validate()) {
    //             Yii::$app->response->format = Response::FORMAT_JSON;
    //             return [
    //                 'token' => $model->getErrors()
    //             ];
    //         } else {

    //             return [
    //                 'token' => $model->getErrors()
    //             ];
    //             // return ['success' => false, 'message' => 'gagal', 'data' => $model->getErrors()];

    //             // Yii::$app->response->format = Response::FORMAT_JSON;

    //             // return [
    //             //     'success' => true,
    //             //     'url' => $paymentUrl
    //             // ];
    //             // }
    //         }
    //         // $token = \app\components\ActionMidtransSnap::getSnapToken($params);
    //         // return ['token' => $token];
    //     } catch (\Exception $e) {
    //         return ['error' => $e->getMessage()];
    //     }
    // }
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
        $order = DetailPesanan::findOne(['invoice' => $orderId]);
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

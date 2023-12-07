<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "PembayaranController".
 */

use yii\filters\AccessControl;
use app\models\DetailPesanan;

use Yii;

use yii\helpers\ArrayHelper;

class MidtransCallback extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\DetailPesanan';
    public function callback()
    // https://834b-182-1-75-92.ap.ngrok.io -> http://localhost:8080
    {
        $request = Yii::$app->request;
        $serverKey = 'SB-Mid-server-KfOHtIYQdM-mZcR0GlslJk28';
        $hashed = hash("sha15", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $pesanan = new DetailPesanan();
                $pesanan = DetailPesanan::find()->where(['invoice' => $request->order_id]);
                $pesanan->status_id = 2;
                $pesanan->save();
            }
        }
    }
}

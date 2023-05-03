<?php

namespace app\controllers\api;

/**
* This is the class for REST controller "PembayaranController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class PembayaranController extends \yii\rest\ActiveController
{
public $modelClass = 'app\models\Pembayaran';
}

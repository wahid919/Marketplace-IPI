<?php

namespace app\controllers\api;

/**
* This is the class for REST controller "PesananController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class PesananController extends \yii\rest\ActiveController
{
public $modelClass = 'app\models\Pesanan';
}

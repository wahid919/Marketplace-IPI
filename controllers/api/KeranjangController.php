<?php

namespace app\controllers\api;

/**
* This is the class for REST controller "KeranjangController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class KeranjangController extends \yii\rest\ActiveController
{
public $modelClass = 'app\models\Keranjang';
}

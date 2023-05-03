<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "KategoriProdukController".
 */

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class KategoriProdukController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\KategoriProduk';
}
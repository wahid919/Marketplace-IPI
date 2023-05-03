<?php

namespace app\controllers\api;

/**
* This is the class for REST controller "ProductDetailController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class ProductDetailController extends \yii\rest\ActiveController
{
public $modelClass = 'app\models\ProductDetail';
}

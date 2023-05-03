<?php

namespace app\controllers\api;

/**
* This is the class for REST controller "ProductVariantController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class ProductVariantController extends \yii\rest\ActiveController
{
public $modelClass = 'app\models\ProductVariant';
}

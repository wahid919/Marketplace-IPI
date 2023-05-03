<?php

namespace app\controllers\api;

/**
* This is the class for REST controller "ReviewProdukController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class ReviewProdukController extends \yii\rest\ActiveController
{
public $modelClass = 'app\models\ReviewProduk';
}

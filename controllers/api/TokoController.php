<?php

namespace app\controllers\api;

/**
* This is the class for REST controller "TokoController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class TokoController extends \yii\rest\ActiveController
{
public $modelClass = 'app\models\Toko';
}

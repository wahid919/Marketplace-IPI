<?php

namespace app\controllers\api;

/**
* This is the class for REST controller "KeuntunganController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class KeuntunganController extends \yii\rest\ActiveController
{
public $modelClass = 'app\models\Keuntungan';
}

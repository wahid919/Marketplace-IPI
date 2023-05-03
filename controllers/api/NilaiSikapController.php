<?php

namespace app\controllers\api;

/**
* This is the class for REST controller "NilaiSikapController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class NilaiSikapController extends \yii\rest\ActiveController
{
public $modelClass = 'app\models\NilaiSikap';
}

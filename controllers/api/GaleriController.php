<?php

namespace app\controllers\api;

/**
* This is the class for REST controller "GaleriController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class GaleriController extends \yii\rest\ActiveController
{
public $modelClass = 'app\models\Galeri';
}

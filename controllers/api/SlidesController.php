<?php

namespace app\controllers\api;

/**
* This is the class for REST controller "SlidesController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class SlidesController extends \yii\rest\ActiveController
{
public $modelClass = 'app\models\Slides';
}

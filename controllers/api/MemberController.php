<?php

namespace app\controllers\api;

/**
* This is the class for REST controller "MemberController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class MemberController extends \yii\rest\ActiveController
{
public $modelClass = 'app\models\Member';
}

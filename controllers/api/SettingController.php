<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "SettingController".
 */

use app\models\Setting;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class SettingController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Setting';
    public function behaviors()
    {
        $parent = parent::behaviors();
        // $parent['authentication'] = [
        //     "class" => "\app\components\CustomAuth",
        //     "only" => ["user-view","update-profile"],
        // ];

        return $parent;
    }
    protected function verbs()
    {
        return [
            'indexs' => ['GET'],
            'login' => ['POST'],
            'register' => ['POST'],
            'check-otp' => ['POST'],
            'refresh-otp' => ['POST'],
            'lupa-password' => ['POST'],
            'update-profile' => ['POST'],
        ];
    }
    public function actions()
    {
        $actions = parent::actions();
        // unset($actions['index']);
        // unset($actions['view']);
        // unset($actions['create']);
        // unset($actions['update']);
        // unset($actions['delete']);
        return $actions;
    }

    public function actionIndexs()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $setting = setting::find()->all();

        return [
            'success' => true,
            // 'message' => 'success',
            'data' => $setting,
            'homesCount' => count($setting)
        ];
    }
}
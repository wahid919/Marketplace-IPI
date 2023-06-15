<?php

namespace app\controllers\api;

/**
 * This is the class for REST controller "AlamatController".
 */

use app\models\Alamat;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class AlamatController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Alamat';
    public $validation  = null;
    public function behaviors()
    {
        $parent = parent::behaviors();
        $parent['authentication'] = [
            "class" => "\app\components\CustomAuth",
            "except" => ["index", 'list-alamat']
        ];

        return $parent;
    }

    public function verbs()
    {
        return [
            'index' => ['GET'],
            'view' => ['GET'],
            'add-cart' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
            'list-alamat' => ['GET'],
        ];
    }

    // public function actionTokoProduk($id){
    //     try{
    //         $mode
    //     }
    // }

    public function actionListAlamat($id = null)
    {
        $result = [];
        try {
            if ($id != null) {
                $alamat = Alamat::find()->where(['usrid' => $id])->all();
                if ($alamat != null) {
                    $result["success"] = true;
                    $result["message"] = "success";
                    $result["alamat"] = $alamat;
                } else {
                    $result["success"] = true;
                    $result["message"] = "success";
                    $result["alamat"] = $alamat;
                }
            } else {
                $alamat = Alamat::find()->all();
                $result["success"] = true;
                $result["message"] = "success";
                $result["alamat"] = $alamat;
            }
            $result["productsCount"] = count($alamat);
        } catch (\Exception $e) {
            $result["success"] = false;
            $result["message"] = "gagal";
            $result["alamat"] = $alamat;
            //$result[""] = null;
        }
        return $result;
        //dd($modelProduk);
    }
}

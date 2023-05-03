<?php

namespace app\models;

use Yii;
use \app\models\base\Produk as BaseProduk;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "produk".
 */
class Produk extends BaseProduk
{

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
}

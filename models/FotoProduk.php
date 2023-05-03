<?php

namespace app\models;

use Yii;
use \app\models\base\FotoProduk as BaseFotoProduk;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "foto_produk".
 */
class FotoProduk extends BaseFotoProduk
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

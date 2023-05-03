<?php

namespace app\models;

use Yii;
use \app\models\base\Keranjang as BaseKeranjang;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "keranjang".
 */
class Keranjang extends BaseKeranjang
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

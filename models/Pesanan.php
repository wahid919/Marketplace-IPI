<?php

namespace app\models;

use Yii;
use \app\models\base\Pesanan as BasePesanan;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pesanan".
 */
class Pesanan extends BasePesanan
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

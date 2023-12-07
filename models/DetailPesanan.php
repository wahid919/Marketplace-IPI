<?php

namespace app\models;

use Yii;
use \app\models\base\DetailPesanan as BaseDetailPesanan;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pesanan".
 */
class DetailPesanan extends BaseDetailPesanan
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

<?php

namespace app\models;

use Yii;
use \app\models\base\StatusPesanan as BaseStatusPesanan;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "status_pesanan".
 */
class StatusPesanan extends BaseStatusPesanan
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

<?php

namespace app\models;

use Yii;
use \app\models\base\Notifikasi as BaseNotifikasi;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "notifikasi".
 */
class Notifikasi extends BaseNotifikasi
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

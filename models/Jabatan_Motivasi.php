<?php

namespace app\models;

use Yii;
use \app\models\base\Jabatan_Motivasi as BaseJabatan_Motivasi;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jabatan_motivasi".
 */
class Jabatan_Motivasi extends BaseJabatan_Motivasi
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

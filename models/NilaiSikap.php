<?php

namespace app\models;

use Yii;
use \app\models\base\NilaiSikap as BaseNilaiSikap;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "nilai_sikap".
 */
class NilaiSikap extends BaseNilaiSikap
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

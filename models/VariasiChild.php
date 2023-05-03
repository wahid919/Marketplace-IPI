<?php

namespace app\models;

use Yii;
use \app\models\base\VariasiChild as BaseVariasiChild;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "variasi_child".
 */
class VariasiChild extends BaseVariasiChild
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

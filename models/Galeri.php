<?php

namespace app\models;

use Yii;
use \app\models\base\Galeri as BaseGaleri;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "galeri".
 */
class Galeri extends BaseGaleri
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

<?php

namespace app\models;

use Yii;
use \app\models\base\Slides as BaseSlides;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "slides".
 */
class Slides extends BaseSlides
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

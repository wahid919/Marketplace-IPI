<?php

namespace app\models;

use Yii;
use \app\models\base\Setting as BaseSetting;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "setting".
 */
class Setting extends BaseSetting
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
    public function getDescription()
    {
        if (strlen($this->tentang_kami) <= 250) $text = strip_tags($this->tentang_kami);
        else $text = strip_tags(substr($this->tentang_kami, 0, 200) . "...");
        return $text;
    }
}

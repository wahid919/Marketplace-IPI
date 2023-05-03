<?php

namespace app\models;

use Yii;
use \app\models\base\HubungiKami as BaseHubungiKami;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "hubungi_kami".
 */
class HubungiKami extends BaseHubungiKami
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

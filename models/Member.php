<?php

namespace app\models;

use Yii;
use \app\models\base\Member as BaseMember;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "member".
 */
class Member extends BaseMember
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

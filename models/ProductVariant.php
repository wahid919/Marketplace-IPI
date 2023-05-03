<?php

namespace app\models;

use Yii;
use \app\models\base\ProductVariant as BaseProductVariant;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product_variant".
 */
class ProductVariant extends BaseProductVariant
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

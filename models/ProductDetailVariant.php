<?php

namespace app\models;

use Yii;
use \app\models\base\ProductDetailVariant as BaseProductDetailVariant;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product_detail_variant".
 */
class ProductDetailVariant extends BaseProductDetailVariant
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

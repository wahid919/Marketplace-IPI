<?php

namespace app\models;

use Yii;
use \app\models\base\ProductDetail as BaseProductDetail;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product_detail".
 */
class ProductDetail extends BaseProductDetail
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

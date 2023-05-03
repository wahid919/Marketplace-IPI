<?php

namespace app\models;

use Yii;
use \app\models\base\ReviewProduk as BaseReviewProduk;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "review_produk".
 */
class ReviewProduk extends BaseReviewProduk
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

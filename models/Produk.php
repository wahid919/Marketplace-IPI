<?php

namespace app\models;

use Yii;
use \app\models\base\Produk as BaseProduk;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "produk".
 */
class Produk extends BaseProduk
{
    public function fields()
    {
        $parent = parent::fields();

        if (isset($parent['view_count'])) {
            unset($parent['view_count']);
            $parent['view_count'] = function ($model) {
                if ($model->view_count == null) {
                    $view = 0;
                } else {
                    $view = $model->view_count;
                }
                return $view;
            };
        }

        return $parent;
    }
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

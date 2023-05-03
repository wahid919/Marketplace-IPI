<?php

namespace app\models;

use Yii;
use \app\models\base\KategoriProduk as BaseKategoriProduk;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "kategori_produk".
 */
class KategoriProduk extends BaseKategoriProduk
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

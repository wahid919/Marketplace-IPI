<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\db\Expression;

use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "keranjang".
 *
 * @property integer $id
 * @property integer $produk_id
 * @property integer $user_id
 * @property string $variant1
 * @property string $variant2
 * @property string $intv1
 * @property string $intv2
 * @property string $harga
 * @property integer $jumlah
 * @property integer $id_transaksi
 * @property string $resi
 * @property string $created_at
 * @property string $created_at2
 * @property string $updated_at
 * @property integer $status_id
 *
 * @property \app\models\Produk $produk
 * @property \app\models\User $user
 * @property \app\models\StatusPesanan $status
 * @property string $aliasModel
 */
abstract class Keranjang extends \yii\db\ActiveRecord
{



    public function fields()
    {
        $parent = parent::fields();

        unset($parent['updated_at']);
        unset($parent['created_at']);
        unset($parent['created_at2']);


        return $parent;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keranjang';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['produk_id', 'user_id', 'variant1', 'variant2', 'harga', 'jumlah'], 'required'],
            [['produk_id', 'user_id', 'jumlah', 'id_transaksi', 'status_id', 'intv1', 'intv2'], 'integer'],
            [['variant1', 'variant2', 'harga', 'resi'], 'string', 'max' => 255],
            [['produk_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Produk::className(), 'targetAttribute' => ['produk_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\StatusPesanan::className(), 'targetAttribute' => ['status_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'produk_id' => 'Produk ID',
            'user_id' => 'User ID',
            'variant1' => 'Variant1',
            'variant2' => 'Variant2',
            'intv1' => 'Intv1',
            'intv2' => 'Intv2',
            'harga' => 'Harga',
            'jumlah' => 'Jumlah',
            'id_transaksi' => 'Id Transaksi',
            'resi' => 'Resi',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_at2' => 'Created At2',
            'status_id' => 'Status ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduk()
    {
        return $this->hasOne(\app\models\Produk::className(), ['id' => 'produk_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(\app\models\StatusPesanan::className(), ['id' => 'status_id']);
    }
}

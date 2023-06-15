<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property integer $role_id
 * @property string $photo_url
 * @property string $last_login
 * @property string $last_logout
 * @property \app\models\Role $role
 */
class User extends \yii\db\ActiveRecord
{

    public function fields()
    {
        $parent = parent::fields();




        if (isset($parent['role_id'])) {
            unset($parent['role_id']);
            $parent['_role_id'] = function ($model) {
                return $model->role_id;
            };
            $parent['role'] = function ($model) {
                return $model->role->name;
            };
        }

        if (isset($parent['photo_url'])) {
            unset($parent['photo_url']);
            $parent['photo_url'] = function ($model) {
                return Yii::getAlias("@file/user_image/$model->photo_url");
            };
        }
        if (!isset($parent['aktif'])) {
            unset($parent['aktif']);
            $parent['aktif'] = function ($model) {
                if ($model->confirm == 0 && $model->status == 0) {
                    return false;
                } else {
                    return true;
                }
            };
        }


        // if (isset($parent['last_login'])) {
        //     unset($parent['last_login']);
        //     $parent['last_login'] = function ($model) {
        //         return Tanggal::toReadableDate($model->last_login);
        //     };
        // }

        // if (isset($parent['last_logout'])) {
        //     unset($parent['last_logout']);
        //     $parent['last_logout'] = function ($model) {
        //         return Tanggal::toReadableDate($model->last_logout);
        //     };
        // }

        return $parent;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'name', 'role_id'], 'required'],
            [['role_id', 'confirm'], 'integer'],
            [['last_login', 'last_logout'], 'safe'],
            [['konfirmasi_pin', 'konfirmasi_password'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['pin'], 'string', 'max' => 8],
            ['username', 'email'],
            [['nomor_handphone'], 'string', 'max' => 15],
            // [[], 'string', 'max' => 32],
            [['password', 'photo_url'], 'string', 'max' => 255],
            [['username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama',
            'username' => 'Email',
            'password' => 'Password',
            'role_id' => 'Role',
            'photo_url' => 'Photo Url',
            'pin' => 'Pin',
            'secret_token' => 'Secret Token',
            'nomor_handphone' => 'Nomor Handphone',
            'last_login' => 'Last Login',
            'last_logout' => 'Last Logout',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(\app\models\Role::className(), ['id' => 'role_id']);
    }

    public function getAlamat()
    {
        return $this->hasMany(\app\models\Alamat::className(), ['usrid' => 'id']);
    }
}

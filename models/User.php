<?php

namespace app\models;

use Yii;

class User extends \app\models\base\User implements \yii\web\IdentityInterface
{
    public $konfirmasi_password, $konfirmasi_pin;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return User::find()->where(["id" => $id])->one();
    }

    public static function findIdentityStatus($id)
    {
        return User::find()->where(["id" => $id, 'status' => 1, 'confirm' => 1])->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        // var_dump($username);die;
        return User::find()->where(["username" => $username])->one();
    }

    public static function findByUsernameAndStatus($username)
    {
        return User::find()->where(["username" => $username, 'status' => 1, 'confirm' => 1])->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return FALSE;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        // return $this->password === md5($password);
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function getPelatihanPesertas()
    {
        return $this->hasMany(\app\models\PelatihanPeserta::class, ['user_id' => 'id']);
    }
}

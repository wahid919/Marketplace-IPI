<?php

namespace app\models\home;

use app\components\Constant;
use app\models\User;
use Yii;
use yii\base\Model;

class Registrasi extends Model
{
    public $name;
    public $nomor_handphone;
    public $asal_pondok;
    public $other_asal_pondok;
    public $username;
    public $password;
    public $konfirmasi_password;
    public $pin;
    public $konfirmasi_pin;
    public $reCaptcha;

    public function rules()
    {
        return [
            [[
                'name',
                'nomor_handphone',
                'username',
                'password',
                'konfirmasi_password',
                'asal_pondok',
                // 'reCaptcha'
            ], 'required'],
            [['nomor_handphone'], 'string', 'min' => 10, 'max' => 14],
            [['username'], 'email'],
            [['password'], 'string', 'min' => 4],
            [['asal_pondok', 'other_asal_pondok'], 'string', 'max' => 255],
            [['konfirmasi_password'], 'string', 'min' => 4],
            // [['pin'], 'string', 'min' => 4, 'max' => 6],
            // [['konfirmasi_pin'], 'string', 'min' => 4, 'max' => 6],
            // [
            //     ['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator3::className(),
            //     'secret' => Yii::$app->params['recaptcha3.secretKey'], // unnecessary if reСaptcha is already configured
            //     'threshold' => 0.5,
            //     // 'action' => 'register',
            //     'action' => 'registrasi',
            // ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama',
            'username' => 'Email',
            'password' => 'Password',
            'role_id' => 'Role',
            'photo_url' => 'Foto',
            'pin' => 'PIN',
            'secret_token' => 'Secret Token',
            'nomor_handphone' => 'Nomor Handphone',
            'asal_pondok' => 'Asal Pondok',
            'last_login' => 'Last Login',
            'last_logout' => 'Last Logout',
            'konfirmasi_pin' => 'Konfirmasi PIN'
        ];
    }


    public function registrasi()
    {
        $transaction = Yii::$app->db->beginTransaction();

        if ($this->validate() == false) {
            $this->addErrors($this->getErrors());
            return false;
        }

        $user = new User;
        $user->load($this->getAttributes(), "");

        $user->role_id = 3; // Regular
        $user->confirm = 1;
        $user->status = 1;
        $user->nomor_handphone = Constant::purifyPhone($user->nomor_handphone);
        // if ($this->pin != $this->konfirmasi_pin) {
        //     Yii::$app->session->setFlash("error", "Pendaftaran gagal. Pin anda tidak sama");
        //     return false;
        // } else if ($this->password != $this->konfirmasi_password) {
        //     Yii::$app->session->setFlash("error", "Pendaftaran gagal. Pin anda tidak sama");
        //     return false;
        // }
        if ($this->password != $this->konfirmasi_password) {
            Yii::$app->session->setFlash("error", "Pendaftaran gagal. Password anda tidak sama");
            return false;
        }

        $user->password = Yii::$app->security->generatePasswordHash($user->password);
        if ($user->validate() == false) {
            $this->addErrors($this->getErrors());
            return 0;
        }

        $user->save();
        $transaction->commit();
        return true;
    }
}

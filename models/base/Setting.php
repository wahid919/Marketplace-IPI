<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "setting".
 *
 * @property integer $id
 * @property string $logo
 * @property string $judul_web
 * @property string $tentang_kami
 * @property string $judul_tentang_kami
 * @property string $foto_tentang_kami
 * @property string $foto_member
 * @property string $facebook
 * @property string $instagram
 * @property string $telepon
 * @property string $email
 * @property string $twitter
 * @property string $telegram
 * @property string $nama_web
 * @property string $alamat
 * @property string $visi
 * @property string $misi
 * @property string $slogan_web
 * @property string $banner
 * @property string $aliasModel
 */
abstract class Setting extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tentang_kami', 'alamat', 'visi', 'misi', 'slogan_web', 'embed_ig'], 'string'],
            [['nama_web', 'alamat', 'slogan_web'], 'required'],
            [['logo', 'judul_web', 'judul_tentang_kami', 'foto_tentang_kami', 'foto_member', 'facebook', 'instagram', 'telepon', 'email', 'twitter', 'telegram', 'nama_web', 'banner'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'logo' => 'Logo',
            'judul_web' => 'Judul Web',
            'tentang_kami' => 'Tentang Kami',
            'judul_tentang_kami' => 'Judul Tentang Kami',
            'foto_tentang_kami' => 'Foto Tentang Kami',
            'foto_member' => 'Foto Member',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'telepon' => 'Telepon',
            'email' => 'Email',
            'twitter' => 'Twitter',
            'telegram' => 'Telegram',
            'nama_web' => 'Nama Web',
            'alamat' => 'Alamat',
            'visi' => 'Visi',
            'misi' => 'Misi',
            'slogan_web' => 'Slogan Web',
            'banner' => 'Banner',
            'embed_ig' => 'Embed Instagram'
        ];
    }
}
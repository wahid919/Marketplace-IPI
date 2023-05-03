<?php
namespace app\components;

use yii\helpers\Url;
use app\models\HutangPiutang;
use app\models\Pengajuan;
use yii\db\Expression;
class Notif {
    // public static function create($url, $params, $to_user, $title, $description = "-"){
    //     $has_fcm_token = FcmToken::find()->where(['user_id' => $to_user])->select(['fcm_token'])->all();
    //     if($has_fcm_token){
    //         $prepare_token = [];
    //         foreach($has_fcm_token as $row) array_push($prepare_token, $row->fcm_token);
    //         SendFcm::exec($prepare_token, $title);
    //     }
    //     $notification = new notification();
    //     $notification->controller = $url;
    //     $notification->params = json_encode($params);
    //     $notification->to_user = $to_user;
    //     $notification->title = $title;
    //     $notification->description = $description;
    //     $notification->save();
    // }
    

    public static function notifList($listHtml =true){
          }
}
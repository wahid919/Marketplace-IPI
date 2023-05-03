<?php
namespace app\components;

use Yii;
use app\models\LogPresence;
use app\models\MasterPresence;

class Log {
    public static function presence($data, $additional, $message){
        $real_path = Yii::getAlias("@webroot". str_replace(Yii::getAlias("@web"), "", $additional['photo']));
        if($additional['is_success'] == false){
            if(file_exists($real_path)) unlink($real_path);
        }

        $masterPresence = MasterPresence::findOne(["id" => 1]);
        $date = date("Y-m-d");
        $time = date("H:i:s");
        // $time = "23:45:12";
        $now = "{$date} {$time}";
        $tomorrow = date("Y-m-d", strtotime($date. " + 1 day"));
        $tomorrow = "{$tomorrow} 00:00:00";
        $time_in_range1 = "{$date} {$masterPresence->time_in_min}";
        $time_in_range2 = "{$date} {$masterPresence->time_in_max}";
        $time_out_range1 = "{$date} {$masterPresence->time_out_min}";
        $action = "";
        if (Tanggal::isInsideRange($now, $time_in_range1, $time_out_range1)) {
            $action = "in";
        }else{
            if (Tanggal::isInsideRange($now, $time_out_range1, $tomorrow)) {
                $action = "out";
            }else{
                $action = "in";
            }
        }
        $log = new LogPresence();
        $log->qr_code = isset($data->qr_code) ? $data->qr_code : null;
        $log->user_id = isset($data->user_id) ? $data->user_id : null;
        $log->name = isset($data->name) ? $data->name : null;
        $log->temperature = isset($additional['temperature']) ? $additional['temperature'] : null;
        $log->photo = isset($additional['photo']) ? $additional['photo'] : null;
        $log->is_success = isset($additional['is_success']) ? (int)$additional['is_success'] : null;
        // $log->is_guest = isset($data->is_guest) ? (int)$data->is_guest : null;
        $log->is_guest = 0; // default bukan guest
        $log->date = date("Y-m-d");
        $log->time = date("H:i:s");
        $log->action = $action;
        $log->message = $message;
        $log->timestamp = date("Y-m-d H:i:s");

        if($log->validate()){
            $log->save();
        }else{
            var_dump($log->getErrors());
            die;
        }
    }
}
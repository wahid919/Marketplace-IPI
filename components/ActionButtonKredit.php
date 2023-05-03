<?php
/**
 * Created by PhpStorm.
 * User: feb
 * Date: 30/05/16
 * Time: 00.14
 */

namespace app\components;

use app\models\Pelatihan;
use yii\helpers\Html;

class ActionButtonKredit
{
    public static function getButtons($btn_pengajuan_selanjutnya = false)
    {
        $btn = [
            'view' => function ($url, $model, $key) {
                return Html::a("<i class='fa fa-eye'></i>", ["view", "id_kredit"=>$model->id_kredit], ["class"=>"btn btn-success", "title"=>"Lihat Data"]);
            },
            'update' => function ($url, $model, $key) {
                return Html::a("<i class='fa fa-pencil'></i>", ["update", "id_kredit"=>$model->id_kredit], ["class"=>"btn btn-warning", "title"=>"Edit Data"]);
            },
            'delete' => function ($url, $model, $key) {
                return Html::a("<i class='fa fa-trash'></i>", ["delete", "id_kredit"=>$model->id_kredit], [
                    "class"=>"btn btn-danger",
                    "title"=>"Hapus Data",
                    "data-confirm" => "Apakah Anda yakin ingin menghapus data ini ?",
                    //"data-method" => "GET"
                ]);
            },
        ];
        $template = '{view} {update} {delete}';
        $width = "120px";


        return [
            'class' => 'yii\grid\ActionColumn',
            'template' => $template,
            'buttons' => $btn,
            'contentOptions' => ['nowrap'=>'nowrap', 'style'=>"text-align:center;width:$width"]
        ];
    }
}
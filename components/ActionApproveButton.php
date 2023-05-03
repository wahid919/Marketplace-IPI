<?php
/**
 * Created by PhpStorm.
 * User: feb
 * Date: 30/05/16
 * Time: 00.14
 */

namespace app\components;


$keuangan=\Yii::$app->user->identity->role_id ==1;
use yii\helpers\Html;
    class ActionApproveButton
    {
        
        public static function getButtons()
        {
            return [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{approve-pendanaan} {cancel} {pendanaan-selesai} {pendanaan-cair} {export} {penyaluran_pendanaan}',
                'header' => 'Pendanaan',
                'visible'=>\Yii::$app->user->identity->role_id ==1,
                'buttons' => [
                  'approve-pendanaan' => function ($url, $model, $key) {
                    if($model->status_id ==1){
                      return Html::a("<i class='fa fa-check'></i>", ["approve-pendanaan", "id"=>$model->id], [
                          "class"=>"btn btn-success",
                          "title"=>"Approve Pendanaan",
                          "data-confirm" => "Apakah Anda yakin ingin menyetujui pendanaan ini ?",
                      ]);
                    }
                  },
                  'cancel' => function ($url, $model, $key) {
                    if($model->status_id ==1){
                    return Html::a("<i class='fa fa-times'></i>", ["pendanaan-tolak", "id"=>$model->id], [
                        "class"=>"btn btn-danger",
                        "title"=>"Cancel",
                        "data-confirm" => "Apakah Anda yakin ingin menolak pendanaan ini ?",
                    ]);
                    }
                },

                'pendanaan-selesai' => function ($url, $model, $key) {
                    if($model->status_id ==2){
                      return Html::a("<i class='fa fa-check'></i>", ["pendanaan-selesai", "id"=>$model->id], [
                          "class"=>"btn btn-success",
                          "title"=>"Approve Pendanaan Selesai",
                          "data-confirm" => "Apakah Anda yakin pendanaan sudah selesai ?",
                      ]);
                    }
                  },
                  'pendanaan-cair' => function ($url, $model, $key) {
                    if($model->status_id ==4){
                      return Html::a("<i class='fa fa-money'></i>", ["pendanaan-cair", "id"=>$model->id], [
                          "class"=>"btn btn-success",
                          "title"=>"Approve Pencairan Pendanaan",
                          "data-confirm" => "Apakah Anda yakin ingin mencairkan pendanaan ?",
                      ]);
                    }
                  },
                  'export' => function ($url, $model, $key) {
                    if($model->status_id ==11){
                      return Html::a("<i class='fa fa-file-excel-o'></i>", ["export", "id"=>$model->id], [
                          "class"=>"btn btn-success",
                          'target'=>'_blank',
                          "title"=>"Export Pendanaan",
                          "data-confirm" => "Apakah Anda yakin ingin Export Data Pendanaan ini ?",
                      ]);
                    }
                  },
                  'penyaluran_pendanaan' => function ($url, $model, $key) {
                    if($model->status_id ==3){
                      return Html::a("<i class='fa fa-check'></i>", ["pendanaan-penyaluran", "id"=>$model->id], [
                          "class"=>"btn btn-success",
                          "title"=>"Approve Penyaluran",
                          "data-confirm" => "Apakah Anda Uang Pendanaan ini sudah disalurkan ?",
                      ]);
                    }
                  },
    
                ],
                'contentOptions' => ['nowrap'=>'nowrap', 'style'=>'text-align:center;width:140px']
            ];
        }

        public static function getButtonsPembayaran()
        {
            return [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{approve-pembayaran} {tolak}',
                'header' => 'Pembayaran',
                'visible'=>\Yii::$app->user->identity->role_id ==1,
                'buttons' => [
                  'approve-pembayaran' => function ($url, $model, $key) {
                    if($model->status_id ==10){
                      return Html::a("<i class='fa fa-check'></i>", ["approve-pembayaran", "id"=>$model->id], [
                          "class"=>"btn btn-success",
                          "title"=>"Approve Pembayaran",
                          "data-confirm" => "Apakah Anda yakin ingin menyetujui Pembayaran ini ?",
                      ]);
                    }
                  },
                  'tolak' => function ($url, $model, $key) {
                    if($model->status_id ==10){
                    return Html::a("<i class='fa fa-times'></i>", ["pembayaran-tolak", "id"=>$model->id], [
                        "class"=>"btn btn-danger",
                        "title"=>"Cancel",
                        "data-confirm" => "Apakah Anda yakin ingin menolak pembayaran ini ?",
                    ]);
                    }
                },
    
                ],
                'contentOptions' => ['nowrap'=>'nowrap', 'style'=>'text-align:center;width:140px']
            ];
        }

    }


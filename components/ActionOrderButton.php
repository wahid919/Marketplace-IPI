<?php
/**
 * Created by PhpStorm.
 * User: feb
 * Date: 30/05/16
 * Time: 00.14
 */

namespace app\components;


$direktur=\Yii::$app->user->identity->role_id ==4;
$keuangan=\Yii::$app->user->identity->role_id ==1;
use yii\helpers\Html;
    class ActionOrderButton
    {
        
        public static function getButtons()
        {
            return [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{approve} {cancel}',
                'visible'=>\Yii::$app->user->identity->role_id ==7,
                'buttons' => [
                  'approve' => function ($url, $model, $key) {
                    if($model->status ==1){
                      return Html::a("<i class='fa fa-check'></i>", ["approve", "id"=>$model->id], [
                          "class"=>"btn btn-success",
                          "title"=>"Approve",
                          "data-confirm" => "Apakah Anda yakin ingin menyetujui data ini ?",
                      ]);
                    }
                  },
                  'cancel' => function ($url, $model, $key) {
                    if($model->status ==1){
                    return Html::a("<i class='fa fa-times'></i>", ["cancel", "id"=>$model->id], [
                        "class"=>"btn btn-danger",
                        "title"=>"Cancel",
                        "data-confirm" => "Apakah Anda yakin ingin menolak data ini ?",
                    ]);
                    }
                },
    
                ],
                'contentOptions' => ['nowrap'=>'nowrap', 'style'=>'text-align:center;width:140px']
            ];
        }
        public static function getDelivery()
        {
            return [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delivery}',
                'visible'=>\Yii::$app->user->identity->role_id ==7,
                'buttons' => [
                  'delivery' => function ($url, $model, $key) {
                    if($model->status ==2){
                      return Html::a("<i class='fa fa-check'></i>", ["delivery", "id"=>$model->id], [
                          "class"=>"btn btn-success",
                          "title"=>"delivery",
                          "data-confirm" => "Apakah Anda yakin Sudah Melaksanakan Pengiriman ?",
                      ]);
                    }
                  },
                ],
                'contentOptions' => ['nowrap'=>'nowrap', 'style'=>'text-align:center;width:140px']
            ];
        }
        public static function getReceived()
        {
            return [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{received}',
                'visible'=>\Yii::$app->user->identity->role_id ==7,
                'buttons' => [
                  'received' => function ($url, $model, $key) {
                    if($model->status ==3){
                      return Html::a("<i class='fa fa-check'></i>", ["received", "id"=>$model->id], [
                        "class"=>"btn btn-success",
                        "title"=>"Received",
                        "data-confirm" => "Apakah Anda yakin Sudah Barang Sudah Diterima ?",
                    ]);
                    }
                  },
                ],
                'contentOptions' => ['nowrap'=>'nowrap', 'style'=>'text-align:center;width:140px']
            ];
        }
    }


<?php

/**
 * Created by PhpStorm.
 * User: feb
 * Date: 30/05/16
 * Time: 00.14
 */

namespace app\components;

use yii\helpers\Html;

class ActionHubungiButton
{

  public static function getButtons()
  {
    return [
      'class' => 'yii\grid\ActionColumn',
      'template' => '{sudah-dihubungi}',
      'header' => 'Sudah dihubungi?',
      // 'visible'=>\Yii::$app->user->identity->role_id ==1,
      'buttons' => [
        'sudah-dihubungi' => function ($url, $model, $key) {
          if($model->status ==0){
            return Html::a("<i class='fa fa-check'></i>", ["sudah-dihubungi", "id"=>$model->id], [
                "class"=>"btn btn-success",
                "title"=>"Telah Dihubungi",
                "data-confirm" => "Apakah Anda yakin telah menghubungi ?",
            ]);
          }
        },
        

      ],
      'contentOptions' => ['nowrap'=>'nowrap', 'style'=>'text-align:center;width:140px']
  ];
  }
}

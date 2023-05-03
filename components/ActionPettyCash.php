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

class ActionPettyCash
{
        public static function getButtonPrintBukti()
        {
            return [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Print',
                'template' => '{cetak}',
                'buttons' => [
                    'cetak' => function ($url, $model, $key) {
                            return Html::a("<i class='fa fa-print'></i>", ["cetak", "id"=>$model->id], ["class"=>"btn btn-success", "title"=>"Cetak Petty Cash dengan Terdapat Bukti",'target' => '_blank']);
                    },
                ],
                'contentOptions' => ['nowrap'=>'nowrap', 'style'=>'text-align:center;width:150px']
            ];
        }

        public static function getButtonPrintNonBukti()
        {
            return [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Print',
                'template' => '{cetak}',
                'buttons' => [
                    'cetak' => function ($url, $model, $key) {
                            return Html::a("<i class='fa fa-print'></i>", ["cetak", "id"=>$model->id], ["class"=>"btn btn-success", "title"=>"Cetak Petty Cash dengan Non Bukti",'target' => '_blank']);
                    },
                ],
                'contentOptions' => ['nowrap'=>'nowrap', 'style'=>'text-align:center;width:150px']
            ];
        }
        
}
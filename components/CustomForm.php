<?php
namespace app\components;

class CustomForm {
    const COLUMN_2 = [
        'template' => '
           <div class="col-lg-12">
               <div class="col-md-4"><label class="control-label">{label}</label></div>
               <div class="col-md-8">{input}{error}</div>
           </div>
               ',
        'options' => ['class' => 'col-md-6', 'style' => 'padding:0px;'],
    ];
    const COLUMN_VERTICAL_2 = [
        'template' => '
           <div class="col-lg-12">
               <div class="col-md-12"><label class="control-label">{label}</label></div>
               <div class="col-md-12">{input}{error}</div>
           </div>
               ',
        'options' => ['class' => 'col-md-6', 'style' => 'padding:0px;'],
        'labelOptions' => ['class' => 'col-md-12']
    ];
}
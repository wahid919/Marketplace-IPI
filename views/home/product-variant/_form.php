<?php

use yii\helpers\Html;
use \dmstr\bootstrap\Tabs;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/**
 * @var yii\web\View $this
 * @var app\models\ProductVariant $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-rooms',
    'widgetItem' => '.room-item',
    'limit' => 4,
    'min' => 1,
    'insertButton' => '.add-room',
    'deleteButton' => '.remove-room',
    'model' => $modelsProductVariant[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'type',
        'value'
    ],
]); ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>variasi</th>
            <!-- <th></th> -->
            <th class="text-center">
                <button type="button" class="add-room btn btn-success btn-xs"><span class="fa fa-plus"></span></button>
            </th>
        </tr>
    </thead>
    <tbody class="container-rooms">
        <?php foreach ($modelsProductVariant as $indexProductVariant => $modelProductVariant) : ?>
            <tr class="room-item">
                <?php
                if (!$modelProductVariant->isNewRecord) {
                    echo Html::activeHiddenInput($modelProductVariant, "[{$indexProductDetail}][{$indexProductVariant}]id");
                }
                ?>
                <td class="vcenter">
                    <!-- // necessary for update action. -->
                    <!-- <span>Color</span> -->
                    <?= $form->field($modelProductVariant, "[{$indexProductDetail}][{$indexProductVariant}]type")->label(false)->textInput(['maxlength' => true]) ?>
                    <?= $form->field($modelProductVariant, "[{$indexProductDetail}][{$indexProductVariant}]value")->label(false)->textInput(['maxlength' => true]) ?>
                </td>
                <td class="text-center vcenter" style="width: 90px;">
                    <button type="button" class="remove-room btn btn-danger btn-xs"><span class="fa fa-minus"></span></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php DynamicFormWidget::end(); ?>
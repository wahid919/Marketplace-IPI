<hr class="mt-0">
<div class="container">
    <?php

    use richardfan\widget\JSRegister;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

    if (!\Yii::$app->user->isGuest) {
        $confirm = Yii::$app->user->identity->confirm;
        $status = Yii::$app->user->identity->status;
        if ($confirm != 1 || $status != 1) {
    ?>
            <div class="modal fade" id="verifakun" tabindex="-1" role="dialog" aria-labelledby="verifakun" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="verifakun">Verifikasi Akun Anda!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <?php

                                $form = ActiveForm::begin([
                                    'id' => 'otp',
                                    'layout' => 'horizontal',
                                    'enableClientValidation' => true,
                                    'errorSummaryCssClass' => 'error-summary alert alert-error',
                                    'enableClientScript' => false,
                                ]);
                                ?>
                                <?php echo $form->errorSummary($model); ?>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <?= $form->field(
                                            $model,
                                            'kode_otp',
                                            [
                                                'template' => '
                    {label}
                    {input}
                    {error}
                ',
                                                'inputOptions' => [
                                                    'class' => 'form-control'
                                                ],
                                                'labelOptions' => [
                                                    'class' => 'control-label'
                                                ],
                                                'options' => ['tag' => false]
                                            ]
                                        )->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <a href="<?= \Yii::$app->request->BaseUrl . "/home/kirim-otp/" ?>" class="btn btn-sm btn-program btn-info btn-block" style="padding:10px!important;">Kirim OTP</a>
                                    </div>
                                    <div class="col-6">
                                        <?= Html::submitButton('Submit', ['class' => 'btn btn-sm btn-program btn-block', 'style' => 'padding:10px!important;width:100%']); ?>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->
                    </div>
                </div>
            </div>
    <?php }
    } ?>
</div>

<?php
if (!\Yii::$app->user->isGuest) {
    $confirm = Yii::$app->user->identity->confirm;
    $status = Yii::$app->user->identity->status;
    if ($confirm != 1 || $status != 1) {
?>
        <?php JSRegister::begin(); ?>
        <script>
            $(document).ready(function() {
                $('#verifakun').modal('show');
            });
        </script>
        <?php JSRegister::end(); ?>
<?php
    }
}
?>
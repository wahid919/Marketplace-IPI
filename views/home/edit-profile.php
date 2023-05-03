    <hr class="mt-0">
    <div class="container pb-20">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                <?= $this->render('component/sidemenu-profile') ?>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section">
                <h3 class="text-isalam-1 font-weight-bold text-detail-program">Edit Profile</h3>
                <?php

                use yii\bootstrap\ActiveForm;
                use yii\helpers\Html;

                $form = ActiveForm::begin([
                    'id' => 'user',
                    'layout' => 'horizontal',
                    'enableClientValidation' => true,
                    'errorSummaryCssClass' => 'error-summary alert alert-error',
                    'enableClientScript' => false,
                ]);
                ?>
                <?php echo $form->errorSummary($model); ?>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <?= $form->field(
                            $model,
                            'name',
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
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <?= $form->field(
                            $model,
                            'username',
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
                        )->textInput(['maxlength' => true, 'type' => 'email']) ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <?= $form->field(
                            $model,
                            'nomor_handphone',
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
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <?= $form->field($model, 'password',  [
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
                        ])->passwordInput(['maxlength' => true, 'autocomplete' => "off"]) ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <?= $form->field(
                            $alamat,
                            'alamat',
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
                    <div class="col-md-12 col-12">
                        <?= $form->field($model, 'photo_url',  [
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
                        ])->fileInput([
                            'options' => ['accept' => 'image/*'],
                            'pluginOptions' => [
                                'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'gif', 'bmp'],
                                'maxFileSize' => 250,
                            ],
                        ]) ?>
                    </div>
                </div>

                <?= Html::submitButton('Simpan', ['class' => 'btn btn-sm btn-program btn-block', 'style' => 'padding:10px!important;width:100%']); ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

<style>
  .form-control {
    border: 3px solid #ffffff;
    color: #ffffff;
  }
  .form-control::-webkit-input-placeholder {
    color: #ffffff;
}
</style>
<?php if (Yii::$app->session->hasFlash('success')) : ?>
            <div class="alert alert-success alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
              <p><i class="icon fa fa-check"></i>Saved!</p>
              <?= Yii::$app->session->getFlash('success') ?>
            </div>
          <?php endif; ?>
 <?php if (Yii::$app->session->hasFlash('error')) : ?>
            <div class="alert alert-danger alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
              <h4><i class="icon fa fa-close"></i>Not Saved!</h4>
              <?= Yii::$app->session->getFlash('error') ?>
            </div>
          <?php endif; ?>
<?php

use richardfan\widget\JSRegister;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
$form = ActiveForm::begin(
    [
      'id' => 'Member',
      'layout' => 'horizontal',
      'enableClientValidation' => true,
      'errorSummaryCssClass' => 'error-summary alert alert-error'
    ]
  );
?>
<section id="banner3" class="banner banner-3 p-0 bg-theme">
      <div class="container-fluid col-padding-0">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-6 background-banner bg-overlay">
            <div class="bg-img"><img src="<?= Yii::$app->request->baseUrl . '/uploads/slides/' . $slides->gambar ?>" alt="background"></div>
            <div class="video__btn video__btn-white video__btn-right-center">
            </div><!-- /.video -->
          </div><!-- /.col-lg-6 -->
          <div class="col-sm-12 col-md-12 col-lg-6" style="background-color: #db6a00">
            <div class="inner-padding">
              <div class="heading heading-3 heading-white mb-50">
                <h2 class="heading__title">Formulir Membership</h2>
                <div class="form-row">

  <div class="col-12 col-md-12">
      <div class="form-group">
      <?= $form->field($model_member, 'nama', [
        'template' => '
            {label}
            {input}
            {error}
        ',
        'inputOptions' => [
          'class' => 'form-control'
        ],
        'labelOptions' => [
          'class' => 'text-white'
        ],
        'options' => ['tag' => false]
      ])->textInput(['maxlength' => true,'placeholder'=>'Nama']) ?>
    </div>
  </div>
  <div class="col-12 col-md-6">
    <div class="form-group">
      <?= $form->field($model_member, 'handphone', [
        'template' => '
            {label}
            {input}
            {error}
        ',
        'inputOptions' => [
          'class' => 'form-control'
        ],
        'labelOptions' => [
          'class' => 'text-white'
        ],
        'options' => ['tag' => false]
      ])->textInput(['maxlength' => true,'placeholder'=>'Nomor Handphone']) ?>
    </div>
  </div>
  <div class="col-12 col-md-6">
    <div class="form-group">
      <?= $form->field($model_member, 'email', [
        'template' => '
            {label}
            {input}
            {error}
        ',
        'inputOptions' => [
          'class' => 'form-control'
        ],
        'labelOptions' => [
          'class' => 'text-white'
        ],
        'options' => ['tag' => false]
      ])->textInput(['maxlength' => true,'placeholder'=>'Email']) ?>
    </div>
  </div>
  <div class="col-12 col-md-12">
    <div class="form-group">
      <?= $form->field($model_member, 'alamat', [
        'template' => '
            {label}
            {input}
            {error}
        ',
        'inputOptions' => [
          'class' => 'form-control'
        ],
        'labelOptions' => [
          'class' => 'text-white'
        ],
        'options' => ['tag' => false]
      ])->textarea(['rows' => 6,'placeholder' => 'Alamat']) ?>
    </div>
  </div>
  <div class="col-12 col-md-6">
    <div class="form-group">
      <?= $form->field($model_member, 'cabang_olahraga', [
        'template' => '
            {label}
            {input}
            {error}
        ',
        'inputOptions' => [
          'class' => 'form-control'
        ],
        'labelOptions' => [
          'class' => 'text-white'
        ],
        'options' => ['tag' => false]
      ])->textInput(['maxlength' => true,'placeholder'=>'Cabang Olahraga']) ?>
    </div>
  </div>
  <div class="col-12 col-md-6">
    <div class="form-group">
      <?= $form->field($model_member, 'komunitas_olahraga', [
        'template' => '
            {label}
            {input}
            {error}
        ',
        'inputOptions' => [
          'class' => 'form-control'
        ],
        'labelOptions' => [
          'class' => 'text-white'
        ],
        'options' => ['tag' => false]
      ])->textInput(['maxlength' => true,'placeholder'=>'Komunitas Olahraga']) ?>
    </div>
  </div>
 
  <?php echo $form->errorSummary($model_member); ?>

  <div class="col-12 text-center">
    <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn-primary']); ?>
  </div>
</div>

<?php ActiveForm::end(); ?>
        </div><!-- /.col-xl-7 -->

      </div><!-- /.row -->
              </div><!-- /.heading -->
            </div>
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.banner 3 -->
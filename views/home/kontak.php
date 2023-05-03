<style>
  .form-control {
    padding: 1.375rem 0.75rem;
  }
</style>
<!-- Contact Section Begin -->
<hr class="mt-0">
<section class="contact spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6 text-center">
        <div class="contact__widget">
          <span class="icon_phone"></span>
          <h4>Phone</h4>
          <p><?= $setting->telepon ?></p>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 text-center">
        <div class="contact__widget">
          <span class="icon_pin_alt"></span>
          <h4>Address</h4>
          <p><?= $setting->alamat ?></p>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 text-center">
        <div class="contact__widget">
          <span class="icon_clock_alt"></span>
          <h4>Open time</h4>
          <p>10:00 am to 23:00 pm</p>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6 text-center">
        <div class="contact__widget">
          <span class="icon_mail_alt"></span>
          <h4>Email</h4>
          <p><?= $setting->email ?></p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Contact Section End -->

<!-- Map Begin -->
<div class="map">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49116.39176087041!2d-86.41867791216099!3d39.69977417971648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886ca48c841038a1%3A0x70cfba96bf847f0!2sPlainfield%2C%20IN%2C%20USA!5e0!3m2!1sen!2sbd!4v1586106673811!5m2!1sen!2sbd" height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
  <div class="map-inside">
    <i class="icon_pin"></i>
    <div class="inside-widget">
      <h4>New York</h4>
      <ul>
        <li>Phone: +12-345-6789</li>
        <li>Add: 16 Creek Ave. Farmingdale, NY</li>
      </ul>
    </div>
  </div>
</div>
<!-- Map End -->

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
    'id' => 'HubungiKami',
    'layout' => 'horizontal',
    'enableClientValidation' => true,
    'errorSummaryCssClass' => 'error-summary alert alert-error'
  ]
);
?>


<section id="services" class="services contact-form spad">
  <div class="container ">
    <div class="row">
      <div class="col-lg-12">
        <div class="contact__form__title">
          <h2>Leave Message</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-1">
      </div>
      <div class="col-sm-12 col-md-12 col-lg-12" style="margin-right: 1rem;">
        <div class="slide__content">
          <div class="card" style="border: none;">
            <div class="card-body">
              <!-- <div class="inner-padding"> -->
              <div class="">
                <div class="heading heading-3 heading-white mb-50">
                  <div class="form-row">

                    <div class="col-6 col-md-6">
                      <div class="form-group">
                        <?= $form->field($model, 'nama', [
                          'template' => '
                              {input}
                              {error}
                          ',
                          'inputOptions' => [
                            'class' => 'form-control'
                          ],
                          'labelOptions' => [
                            'class' => 'text-grey'
                          ],
                          'options' => ['tag' => false]
                        ])->textInput(['maxlength' => true, 'placeholder' => 'Nama']) ?>
                      </div>
                    </div>
                    <div class="col-6 col-md-6">
                      <div class="form-group">
                        <?= $form->field($model, 'email', [
                          'template' => '
                              
                              {input}
                              {error}
                          ',
                          'inputOptions' => [
                            'class' => 'form-control'
                          ],
                          'labelOptions' => [
                            'class' => 'text-grey'
                          ],
                          'options' => ['tag' => false]
                        ])->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>
                      </div>
                    </div>
                    <div class="col-12 col-md-12">
                      <div class="form-group">
                        <?= $form->field($model, 'pesan', [
                          'template' => '
                              
                              {input}
                              {error}
                          ',
                          'inputOptions' => [
                            'class' => 'form-control'
                          ],
                          'labelOptions' => [
                            'class' => 'text-grey'
                          ],
                          'options' => ['tag' => false]
                        ])->textarea(['rows' => 6, 'placeholder' => 'Subject']) ?>
                      </div>
                    </div>

                    <?php echo $form->errorSummary($model); ?>

                    <div class="col-12 text-center">
                      <?= Html::submitButton(' Simpan', ['class' => 'site-btn']); ?>
                    </div>
                  </div>

                  <?php ActiveForm::end(); ?>
                </div><!-- /.col-xl-7 -->

              </div><!-- /.row -->
            </div><!-- /.heading -->
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.col-lg-6 -->
  </div><!-- /.row -->
  </div><!-- /.container -->
</section><!-- /.banner 3 -->
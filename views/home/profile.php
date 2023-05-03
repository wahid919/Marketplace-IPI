<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\Alamat;
use yii\grid\GridView;
use dmstr\bootstrap\Tabs;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Alamat $model
 */
?>
<hr class="mt-0">
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

<div class="container pb-20">

  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
      <?= $this->render('component/sidemenu-profile') ?>
    </div>
    <div class="col-lg-8 col-md-6 col-sm-12 col-12 profile-section">
      <h3 class="text-isalam-1 font-weight-bold text-detail-program"></h3>
      <div class="row">
        <div class="table-responsive">
          <div class="giiant-crud profil-view">
            <!-- flash message -->
            <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
              <span class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <?= \Yii::$app->session->getFlash('deleteError') ?>
              </span>
            <?php endif; ?>
            <!-- <div class="box box-info"><div class="box-body"> -->
            <?php $this->beginBlock('Alamat'); ?>
            <div style='position: relative'>
              <div style='position:relative;margin-top:1%; right: 0px; top 0px;'>
                <?= Html::a(
                  '<span class="glyphicon glyphicon-plus"></span> ' . ' Alamat',
                  ['create-alamat', 'Alamat' => ['usrid' => Yii::$app->user->identity->id]],
                  ['class' => 'btn btn-success btn-xs']
                ); ?>
              </div>
            </div>
            <?php Pjax::begin(['id' => 'pjax-Alamat', 'enableReplaceState' => false, 'linkSelector' => '#pjax-FotoProduks ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
            <?= '<div class="table-responsive">'
              . \yii\grid\GridView::widget([
                'layout' => '{summary}{pager}<br/>{items}{pager}',
                'dataProvider' => new \yii\data\ActiveDataProvider([
                  'query' => $model_alamat,
                  'pagination' => [
                    'pageSize' => 20,
                    'pageParam' => 'page-alamat',
                  ]
                ]),
                'pager'        => [
                  'class'          => yii\widgets\LinkPager::className(),
                  'firstPageLabel' => 'First',
                  'lastPageLabel'  => 'Last'
                ],
                'columns' => [
                  'judul',
                  'alamat',
                  'kodepos',
                  [
                    'class'      => 'yii\grid\ActionColumn',
                    'template'   => '{update} {delete}',
                    'contentOptions' => ['nowrap' => 'nowrap'],
                    'urlCreator' => function ($action, $model_alamat, $key, $index) {
                      // using the column name as key, not mapping to 'id' like the standard generator
                      $params = is_array($key) ? $key : [$model_alamat->primaryKey()[0] => (string) $key];
                      $params[0] = 'home/' . $action . '-alamat';
                      $params['Alamat'] = ['usrid' => $model_alamat->usrid];
                      return $params;
                    },
                    'buttons'    => [],
                    'controller' => 'alamat'
                  ],
                ]
              ])
              . '</div>' ?>
            <?php Pjax::end() ?>
            <?php $this->endBlock() ?>

            <?= Tabs::widget(
              [
                'id' => 'relation-tabs',
                'encodeLabels' => false,
                'items' => [
                  [
                    'content' => $this->blocks['Alamat'],
                    'label'   => '<small>Alamat <span class="badge badge-default">' . count($model_alamat->asArray()->all()) . '</span></small>',
                    'active'  => true,
                  ],
                ]
              ]
            );
            ?>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
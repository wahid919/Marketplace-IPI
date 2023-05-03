<?php

use yii\grid\GridView;
?>
<hr class="mt-0">
<section id="services" class="services pb-90" style="margin-left: 4rem">
  <div class="container">
    <div class="row heading heading-2 mb-40">
      <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="table-responsive">
          <h2 class="mx-auto text-left pb-3" style="color:orange;font-size:1.5rem;line-height: 1;margin-bottom:-1px;">Daftar Rekening Resmi Yayasan I-Salam</h2>
          <?= GridView::widget([
            'layout' => "{items}<div class='d-flex justify-content-center'>{pager}</div>",
            'dataProvider' => $dataProvider,
            'pager'        => [
              'class'          => yii\widgets\LinkPager::className(),
              'firstPageLabel' => 'First',
              'lastPageLabel'  => 'Last'
            ],
            // 'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-hover'],
            'headerRowOptions' => ['class' => 'x', 'style' => 'text-align: center; font-size:14px;'],
            // 'headerOptions' => [],
            'options' => ['style' => 'text-align: center;font-style: poppins;'],
            'columns' => [


              // 'jenis_bank',
              [
                'attribute' => 'jenis_bank',
                'contentOptions' => ['style' => 'font-size:12px;'],
              ],
              [
                'attribute' => 'jenis_rekening',
                'contentOptions' => ['style' => 'font-size:12px;'],
              ],
              [
                'attribute' => 'nama_rekening',
                'contentOptions' => ['style' => 'font-size:12px;'],
              ],
              [
                'attribute' => 'nomor_rekening',
                'contentOptions' => ['style' => 'font-size:12px;'],
              ],
              // 'jenis_rekening',
              // 'nama_rekening',
              // 'nomor_rekening',

            ],
          ]); ?>
        </div>

      </div><!-- /.col-lg-5 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</section><!-- /.Services -->
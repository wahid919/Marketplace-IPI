<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\SlidesSearch $searchModel
 */

$this->title = 'Slides';
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= Html::a('<i class="fa fa-plus"></i> Tambah Baru', ['create'], ['class' => 'btn btn-success']) ?>
</p>


<?php \yii\widgets\Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>

<div class="box box-info">
    <div class="box-body">
        <div class="table-responsive">
            <?= GridView::widget([
                'layout' => '{summary}{pager}{items}{pager}',
                'dataProvider' => $dataProvider,
                'pager'        => [
                    'class'          => yii\widgets\LinkPager::className(),
                    'firstPageLabel' => 'First',
                    'lastPageLabel'  => 'Last'
                ],
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
                'headerRowOptions' => ['class' => 'x'],
                'columns' => [

                    \app\components\ActionButton::getButtons(),

                    'judul',
                    'sub_judul',
                    [
                        'attribute' => 'loc_text',
                        'value' => function($model){
                            if($model->loc_text == "left"){
                                return "Kiri";
                            }elseif($model->loc_text == "right"){
                                return "Kanan";
                            }elseif($model->loc_text == "center"){
                                return "Tengah";
                            }
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'format' => 'html',
                        'value' => function ($model) {
                            if ($model == 1) {
                                return "Aktif";
                            } else {
                                return "Nonaktif";
                            }
                        },
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

<?php \yii\widgets\Pjax::end() ?>
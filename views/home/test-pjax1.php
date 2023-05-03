<?php
use \yii\widgets\Pjax;
use yii\helpers\Html;
?>

timestamp <code><?= $time ?></code>
<hr>

<?php Pjax::begin([
    'id'                 => 'pjax1',
    'enablePushState'    => false,
    'enableReplaceState' => false,
    'linkSelector'       => '#pjax1 a',
    'timeout'            => 10000,
]) ?>

timestamp <code><?= $time ?></code> (in pjax container)

<?php if (empty($like)) { ?>

<hr>
<?= Html::a('<i class="fa fa-thumbs-up" aria-hidden="true"></i>', ['home/test-pjax1','post_id'=>21 ,'like' => 1, ]) ?>

<?= Html::a('<i class="fa fa-thumbs-down" aria-hidden="true"></i>', ['home/test-pjax1', 'like' => -1, ]) ?>

<?php } else { ?>

    <hr>
    <p>
        <?= ($like == 1) ? 'you like me :)' : 'you do not like me :('; ?>
    </p>

<?php } ?>


<?php Pjax::end() ?>
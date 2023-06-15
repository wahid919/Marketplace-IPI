<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">ISL</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
            <li class="dropdown notifications-menu">
            <?php if(\Yii::$app->user->identity->role_id==1){ ?>
                    <?=\app\components\Notif::notifList()?>
            <?php } ?>
            
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?= Html::img(["uploads/user_image/".Yii::$app->user->identity->photo_url], ["class"=>"user-image"]) ?>
                        <span class="hidden-xs"><?= Yii::$app->user->identity->name; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?= Html::img(["uploads/user_image/".Yii::$app->user->identity->photo_url], ["class"=>"img-circle"]) ?>

                            <p>
                                <?= Yii::$app->user->identity->name; ?>
                                -
                                <?= Yii::$app->user->identity->role->name; ?>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    'Profile',
                                    ['site/profile'],
                                    ['class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

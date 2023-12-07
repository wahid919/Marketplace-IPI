<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<!-- <style>
    .skin-blue-light .main-header .navbar {
        background-color: #009b02;
    }

    .skin-blue-light .main-header .logo {
        background-color: #009b02;
        color: #fff;
        border-bottom: 0 solid transparent;
    }
</style> -->
<!-- Page Header Start-->
<div class="page-main-header">
  <div class="main-header-right row m-0">
    <div class="main-header-left">
      <div class="logo-wrapper">
        <a href="https://laravel.pixelstrap.com/viho/dashboard"><img class="img-fluid" src="https://laravel.pixelstrap.com/viho/assets/images/logo/logo.png" alt="" /></a>
      </div>
      <div class="dark-logo-wrapper">
        <a href="https://laravel.pixelstrap.com/viho/dashboard"><img class="img-fluid" src="https://laravel.pixelstrap.com/viho/assets/images/logo/dark-logo.png" alt="" /></a>
      </div>
      <div class="toggle-sidebar">
        <i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle">
        </i>
      </div>
    </div>
    <div class="left-menu-header col">
      <ul>
        <li>
          <form class="form-inline search-form">
            <div class="search-bg">
              <i class="fa fa-search"></i>
              <input class="form-control-plaintext" placeholder="Search here....." />
            </div>
          </form>
          <span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
        </li>
      </ul>
    </div>
    <div class="nav-right col pull-right right-menu p-0">
      <ul class="nav-menus">
        <li>
          <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a>
        </li>
        <li class="onhover-dropdown">
          <div class="bookmark-box"><i data-feather="star"></i></div>
          <div class="bookmark-dropdown onhover-show-div">
            <div class="form-group mb-0">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div>
                <input class="form-control" type="text" placeholder="Search for bookmark..." />
              </div>
            </div>
            <ul>
              <li class="add-to-bookmark">
                <i class="bookmark-icon" data-feather="inbox"></i>Email<span class="pull-right"><i data-feather="star"></i></span>
              </li>
              <li class="add-to-bookmark">
                <i class="bookmark-icon" data-feather="message-square"></i>Chat<span class="pull-right"><i data-feather="star"></i></span>
              </li>
              <li class="add-to-bookmark">
                <i class="bookmark-icon" data-feather="command"></i>Feather Icon<span class="pull-right"><i data-feather="star"></i></span>
              </li>
              <li class="add-to-bookmark">
                <i class="bookmark-icon" data-feather="airplay"></i>Widgets<span class="pull-right"><i data-feather="star"> </i></span>
              </li>
            </ul>
          </div>
        </li>
        <li class="onhover-dropdown">
          <div class="notification-box">
            <i data-feather="bell"></i><span class="dot-animated"></span>
          </div>
          <ul class="notification-dropdown onhover-show-div">
            <li>
              <p class="f-w-700 mb-0">
                You have 3 Notifications<span class="pull-right badge badge-primary badge-pill">4</span>
              </p>
            </li>
            <li class="noti-primary">
              <div class="media">
                <span class="notification-bg bg-light-primary"><i data-feather="activity"> </i></span>
                <div class="media-body">
                  <p>Delivery processing</p>
                  <span>10 minutes ago</span>
                </div>
              </div>
            </li>
            <li class="noti-secondary">
              <div class="media">
                <span class="notification-bg bg-light-secondary"><i data-feather="check-circle"> </i></span>
                <div class="media-body">
                  <p>Order Complete</p>
                  <span>1 hour ago</span>
                </div>
              </div>
            </li>
            <li class="noti-success">
              <div class="media">
                <span class="notification-bg bg-light-success"><i data-feather="file-text"> </i></span>
                <div class="media-body">
                  <p>Tickets Generated</p>
                  <span>3 hour ago</span>
                </div>
              </div>
            </li>
            <li class="noti-danger">
              <div class="media">
                <span class="notification-bg bg-light-danger"><i data-feather="user-check"> </i></span>
                <div class="media-body">
                  <p>Delivery Complete</p>
                  <span>6 hour ago</span>
                </div>
              </div>
            </li>
          </ul>
        </li>
        <li>
          <div class="mode"><i class="fa fa-moon-o"></i></div>
        </li>
        <li class="onhover-dropdown">
          <i data-feather="message-square"></i>
          <ul class="chat-dropdown onhover-show-div">
            <li>
              <div class="media">
                <img class="img-fluid rounded-circle me-3" src="https://laravel.pixelstrap.com/viho/assets/images/user/4.jpg" alt="" />
                <div class="media-body">
                  <span>Ain Chavez</span>
                  <p class="f-12 light-font">
                    Lorem Ipsum is simply dummy...
                  </p>
                </div>
                <p class="f-12">32 mins ago</p>
              </div>
            </li>
            <li>
              <div class="media">
                <img class="img-fluid rounded-circle me-3" src="https://laravel.pixelstrap.com/viho/assets/images/user/1.jpg" alt="" />
                <div class="media-body">
                  <span>Erica Hughes</span>
                  <p class="f-12 light-font">
                    Lorem Ipsum is simply dummy...
                  </p>
                </div>
                <p class="f-12">58 mins ago</p>
              </div>
            </li>
            <li>
              <div class="media">
                <img class="img-fluid rounded-circle me-3" src="https://laravel.pixelstrap.com/viho/assets/images/user/2.jpg" alt="" />
                <div class="media-body">
                  <span>Kori Thomas</span>
                  <p class="f-12 light-font">
                    Lorem Ipsum is simply dummy...
                  </p>
                </div>
                <p class="f-12">1 hr ago</p>
              </div>
            </li>
            <li class="text-center">
              <a class="f-w-700" href="javascript:void(0)">See All </a>
            </li>
          </ul>
        </li>
        <li class="onhover-dropdown p-0">
          <button class="btn btn-primary-light" type="button">
            <i data-feather="log-out"></i>Log out
          </button>
        </li>
      </ul>
    </div>
    <div class="d-lg-none mobile-toggle pull-right w-auto">
      <i data-feather="more-horizontal"></i>
    </div>
  </div>
</div>
<!-- Page Header Ends -->
<header class="main-header">

  <?= Html::a('<span class="logo-mini">ISL</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

  <nav class="navbar navbar-static-top" role="navigation">

    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">

      <ul class="nav navbar-nav">
        <li class="dropdown notifications-menu">
          <?php if (\Yii::$app->user->identity->role_id == 1) { ?>
            <?= \app\components\Notif::notifList() ?>
          <?php } ?>

        </li>
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?= Html::img(["uploads/user_image/" . Yii::$app->user->identity->photo_url], ["class" => "user-image"]) ?>
            <span class="hidden-xs"><?= Yii::$app->user->identity->name; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <?= Html::img(["uploads/user_image/" . Yii::$app->user->identity->photo_url], ["class" => "img-circle"]) ?>

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
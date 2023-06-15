<?php

use yii\helpers\Html;


?>
<aside class="main-sidebar">
    <section class="sidebar">
        <header class="main-nav">
            <div class="sidebar-user text-center">
                <a class="setting-primary" href="<?= Yii::$app->urlManager->baseUrl . "/site/profile" ?>"><i data-feather="settings"></i></a><?= Html::img(["uploads/user_image/" . Yii::$app->user->identity->photo_url], ["class" => "img-90 rounded-circle"]) ?>
                <div class="badge-bottom">
                    <span class="badge badge-primary">New</span>
                </div>
                <a href="user-profile">
                    <h6 class="mt-3 f-14 f-w-600"><?= Yii::$app->user->identity->name ?></h6>
                </a>
                <p class="mb-0 font-roboto">Human Resources Department</p>
                <ul>
                    <li>
                        <span><span class="counter">19.8</span>k</span>
                        <p>Follow</p>
                    </li>
                    <li>
                        <span>2 year</span>
                        <p>Experince</p>
                    </li>
                    <li>
                        <span><span class="counter">95.2</span>k</span>
                        <p>Follower</p>
                    </li>
                </ul>
            </div>
            <nav>
                <div class="main-navbar">
                    <div class="left-arrow" id="left-arrow">
                        <i data-feather="arrow-left"></i>
                    </div>
                    <div id="mainnav">
                        <ul class="nav-menu custom-scrollbar">
                            <li class="back-btn">
                                <div class="mobile-back text-end">
                                    <span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                                </div>
                            </li>

                            <!-- <li class="sidebar-main-title">
                                <div>
                                    <h6>General</h6>
                                </div>
                            </li> -->
                            <?php
                            $items = \app\components\SidebarMenu::getMenu(Yii::$app->user->identity->role_id);

                            ?>
                            <?= dmstr\widgets\Menu::widget(
                                [
                                    'options' => ['class' => 'sidebar-menu'],
                                    'items' => $items,
                                ]
                            ) ?>
                        </ul>
                    </div>
                    <div class="right-arrow" id="right-arrow">
                        <i data-feather="arrow-right"></i>
                    </div>
                </div>
            </nav>
        </header>
    </section>
</aside>
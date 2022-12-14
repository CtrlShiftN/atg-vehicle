<?php

/* @var $this \yii\web\View */

/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

$cdnUrl = Yii::$app->params['backend'];
$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?= $this->render('_adminlte3Head') ?>
</head>

<body class="hold-transition sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= $cdnUrl ?>" class="nav-link"><?= Yii::t('app', 'Home') ?></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link"><?= Yii::t('app', 'Contact') ?></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= $cdnUrl ?>" class="brand-link align-self-center">
                <img src="<?= $cdnUrl ?>/upload/media/images/AdminLTELogo.png" alt="My Website Logo" class="brand-image img-circle elevation-3 bg-light" style="opacity: .8">
                <span class="brand-text font-weight-bold">My Website</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <?php if (!Yii::$app->user->isGuest) : ?>
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="<?= $cdnUrl ?>/upload/media/images/avatar.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <div class="d-block font-weight-bold text-white"><?= Yii::$app->user->identity->name ?></div>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 1) : ?>
                            <li class="nav-item">
                                <a href="<?= Url::toRoute('user/') ?>" class="nav-link <?= ($controller == 'user') ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-user-astronaut"></i>
                                    <p><?= Yii::t('app', 'Accounts') ?></p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <!-- Order -->
                        <li class="nav-item">
                            <a href="<?= Url::toRoute('order/') ?>" class="nav-link <?= ($controller == 'order') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-cash-register"></i>
                                <p><?= Yii::t('app', 'Orders') ?></p>
                            </a>
                        </li>
                        <!-- Vehicle -->
                        <li class="nav-item">
                            <a href="<?= Url::toRoute('vehicle/') ?>" class="nav-link <?= ($controller == 'vehicle') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-car-side"></i>
                                <p><?= Yii::t('app', 'Vehicle') ?></p>
                            </a>
                        </li>
                        <!-- Manufacturer -->
                        <li class="nav-item">
                            <a href="<?= Url::toRoute('manufacturer/') ?>" class="nav-link <?= ($controller == 'manufacturer') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-industry"></i>
                                <p><?= Yii::t('app', 'Manufacturers') ?></p>
                            </a>
                        </li>
                        <!-- Color -->
                        <li class="nav-item">
                            <a href="<?= Url::toRoute('color/') ?>" class="nav-link <?= ($controller == 'color') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-palette"></i>
                                <p><?= Yii::t('app', 'Colors') ?></p>
                            </a>
                        </li>
                        <!-- Media -->
                        <li class="nav-item">
                            <a href="<?= Url::toRoute('media/') ?>" class="nav-link <?= ($controller == 'media') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-photo-video"></i>
                                <p><?= Yii::t('app', 'Media') ?></p>
                            </a>
                        </li>


                        <li class="nav-header text-uppercase font-weight-bold"><?= Yii::t('app', 'Others') ?></li>

                        <li class="nav-item">
                            <a href="<?= Url::toRoute('site/logout') ?>" class="nav-link">
                                <i class="nav-icon fas fa-power-off"></i>
                                <p><?= Yii::t('app', 'Logout') ?></p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <?= $content ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong><?= Yii::t('app', 'Copyright') ?> &copy; <?= date('Y') ?> <a href="<?= Yii::$app->params['frontend'] ?>">My Website</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b><?= Yii::t('app', 'Version') ?></b> 2.4.4
            </div>
        </footer>
    </div>
    <?php $this->endBody() ?>
    <script src="<?= $cdnUrl ?>/adminlte3/dist/js/adminlte.js"></script>
</body>

</html>
<?php $this->endPage();

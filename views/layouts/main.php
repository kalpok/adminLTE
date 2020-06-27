<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\Breadcrumbs;
use theme\widgets\FlashMessages;
use theme\widgets\AdminSidebarMenu;
use theme\assetbundles\IEAssetBundle;
use theme\assetbundles\ModalFormAsset;
use theme\assetbundles\AjaxButtonsAsset;
use theme\assetbundles\ThemeAssetBundle;
use theme\widgets\NotificationsContainer;

ThemeAssetBundle::register($this);
IEAssetBundle::register($this);

ModalFormAsset::register($this);
AjaxButtonsAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?= Url::home() ?>favicon.ico" type="image/x-icon"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="skin-purple">
    <?php $this->beginBody() ?>
        <div class="flash-message-container">
            <?= FlashMessages::widget() ?>
        </div>
        <div class="wrapper">
            <header class="main-header">
                <?= Html::a(Yii::$app->name, ['/'], ['class' => 'logo']) ?>
                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu pull-right">
                        <ul class="nav navbar-nav"></ul>
                    </div>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <?= NotificationsContainer::widget() ?>
                        </ul>
                    </div>
                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <?= AdminSidebarMenu::widget([
                        'options' => ['class' => "sidebar-menu"],
                        'submenuTemplate' => '<ul class="treeview-menu">{items}</ul>',
                        'linkTemplate' => '<a href="{url}">{icon} <span>{label}</span> {tag}</a>'
                    ]) ?>
                </section>
            </aside>
            <div class="content-wrapper">
                <section class="content-header">
                    <?= Breadcrumbs::widget([
                        'tag' => 'ol',
                        'homeLink' => [
                            'label' => 'خانه',
                            'url' => yii::$app->homeUrl,
                            'template' => '<li><i class="fa fa-dashboard"></i> {link}</li>'
                        ],
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
                    ]) ?>
                    <h1>
                        <?= $this->title ?>
                    </h1>
                </section>
                <section class="content">
                    <?= $content ?>
                    <?php Modal::begin([
                        'id' => 'admin-modal',
                        'clientOptions' => ['backdrop' => true]
                    ]) ?>
                        <div class="modal-inner"></div>
                    <?php Modal::end() ?>
                </section>
            </div>
            <footer class="main-footer"></footer>
        </div>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

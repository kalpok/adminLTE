<?php

use yii\helpers\Url;
use yii\helpers\Html;
use theme\widgets\FlashMessages;
use theme\assetbundles\IEAssetBundle;
use theme\assetbundles\ThemeAssetBundle;

ThemeAssetBundle::register($this);
IEAssetBundle::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?= Url::home() ?>favicon.ico" type="image/x-icon"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
        <div class="flash-message-container">
            <?= FlashMessages::widget() ?>
        </div>
        <div class="container">
            <div class="row">
                <br><br>
                <div class="login-logo">
                    <p><b><?= Yii::$app->name ?></b></p>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <?= $content ?>
                </div>
            </div>
        </div>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

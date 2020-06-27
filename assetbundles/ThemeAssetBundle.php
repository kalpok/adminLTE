<?php

namespace theme\assetbundles;

use yii\web\AssetBundle;

class ThemeAssetBundle extends AssetBundle
{
    public $sourcePath = '@themes/adminLTE/assets';

    public $css = [
        'css/AdminLTE.min.css',
        'css/skins/_all-skins.min.css',
        'css/custom.css'
    ];

    public $js = [
        'plugins/slimScroll/jquery.slimscroll.min.js',
        'js/app.min.js',
        'js/custom.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'core\assetbundles\BootstrapRTLAsset',
        'core\assetbundles\FontAwesomeRtlAsset'
    ];
}

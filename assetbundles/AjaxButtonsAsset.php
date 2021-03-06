<?php

namespace theme\assetbundles;

use yii\web\AssetBundle;

class AjaxButtonsAsset extends AssetBundle
{
    public $sourcePath = '@theme/assets';

    public $js = [
        'js/ajaxbuttons.js'
    ];

    public $css = [
        'css/ajaxbuttons.css'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}

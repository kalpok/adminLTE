<?php

namespace theme\assetbundles;

class FontAwesomeRtlAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@theme/assets';

    public $css = [
        'css/font-awesome-rtl.css'
    ];

    public $depends = [
        'theme\assetbundles\FontAwesomeAsset'
    ];
}

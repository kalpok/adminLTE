<?php

namespace theme\widgets;

use yii\helpers\Html;

class BoxWidget extends \yii\base\Widget
{
    public $class = 'col-lg-4';
    public $color = 'light-blue';
    public $inner;
    public $icon;
    public $link;

    public function run()
    {
        $html = Html::beginTag('div', ['class' => "$this->class col-xs-6"]);
        $html .= Html::beginTag('div', ['class' => "small-box bg-$this->color"]);
        $html .= Html::tag('div', $this->inner, ['class' => 'inner']);
        $html .= Html::beginTag('div', ['class' => 'icon', 'style' => 'padding: 10px; right: 70%;']);
        $html .= Html::tag('i', '', ['class' => "fa fa-$this->icon"]);
        $html .= Html::endTag('div');
        $html .= $this->link;
        $html .= Html::endTag('div');
        $html .= Html::endTag('div');
        echo $html;
    }
}

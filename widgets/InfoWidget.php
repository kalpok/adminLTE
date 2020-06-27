<?php

namespace theme\widgets;

use yii\helpers\Html;

class InfoWidget extends \yii\base\Widget
{
    public $class = 'col-lg-4';
    public $color = 'light-blue';
    public $icon;
    public $number;
    public $text;

    public function run()
    {
        $html = Html::beginTag('div', ['class' => "$this->class col-sm-6 col-xs-12"]);
        $html .= Html::beginTag('div', ['class' => 'info-box']);
        $html .= Html::tag(
            'span',
            Html::tag('i', '', ['class' => "fa fa-$this->icon"]),
            ['class' => "info-box-icon bg-$this->color"]
        );
        $html .= Html::beginTag('div', ['class' => 'info-box-content']);
        $html .= Html::tag('span', $this->number, ['class' => 'info-box-number']);
        $html .= Html::tag('span', $this->text, ['class' => 'info-box-text']);
        $html .= Html::endTag('div');
        $html .= Html::endTag('div');
        $html .= Html::endTag('div');
        echo $html;
    }
}

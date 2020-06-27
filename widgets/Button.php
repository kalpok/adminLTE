<?php

namespace theme\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\base\InvalidConfigException;

class Button extends Widget
{
    public $url = false;
    public $label = 'دکمه';
    public $icon = 'heart';
    public $options = [];
    public $type = 'success';
    public $color;
    public $visible = true;
    public $visibleFor;

    public function init()
    {
        if (isset($this->visibleFor) and !is_array($this->visibleFor)) {
            throw new InvalidConfigException('
                visibleFor property should be an Array of authorization items (roles or permissions)
            ');
        }
        $this->checkIfVisible();
        Html::addCssClass($this->options, 'btn');
        if ($this->color) {
            Html::addCssClass($this->options, 'bg-' . $this->color);
        }
        if (empty($this->type)) {
            Html::addCssClass($this->options, 'btn-default');
        } else {
            Html::addCssClass($this->options, 'btn-' . $this->type);
        }
        parent::init();
    }

    public function run()
    {
        if (!$this->visible) {
            return;
        }
        if ($this->icon) {
            $this->label = '<i class="fa fa-'.$this->icon.'"></i> ' . $this->label;
        }
        echo Html::a($this->label, $this->url, $this->options);
    }

    private function checkIfVisible()
    {
        if (!$this->visible) {
            return;
        }
        if (isset($this->visibleFor)) {
            $this->visible = false;
            foreach ($this->visibleFor as $permission) {
                if (Yii::$app->user->can($permission)) {
                    $this->visible = true;
                    return;
                }
            }
        }
    }
}

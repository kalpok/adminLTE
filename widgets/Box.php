<?php

namespace theme\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class Box extends Widget
{
    public $title = false;
    public $tools;
    public $footer = false;
    public $options = [];
    public $visible = true;
    public $isSolid = true;
    private $content;
    public $showCloseButton = false;
    public $showCollapseButton = false;

    public function init()
    {
        if ($this->isSolid) {
            $boxClass = 'box box-solid ';
        } else {
            $boxClass = 'box ';
        }
        if (empty($this->options['class'])) {
            Html::addCssClass($this->options, $boxClass . 'box-primary');
        } else {
            Html::addCssClass($this->options, $boxClass . $this->options['class']);
        }
        if ($this->showCloseButton) {
            $this->registerJsForCloseButton();
            $this->tools = $this->tools . Html::a(
                '<span class="glyphicon glyphicon-remove"></span>',
                null,
                [
                    'class' => 'close-box-button'
                ]
            );
        }
        if ($this->showCollapseButton) {
            $this->tools = $this->tools . Html::a(
                '<i class="fa fa-angle-up"></i>',
                null,
                [
                    'class' => 'collapse-link'
                ]
            );
        }
        ob_start();
        parent::init();
    }

    public function run()
    {
        $this->content = ob_get_clean();
        if (!$this->visible) {
            return;
        }
        echo Html::beginTag('div', $this->options);
        $this->renderHeader();
        $this->renderContent();
        $this->renderFooter();
        echo Html::endTag('div') . "\n";
    }

    public function renderHeader()
    {
        if ($this->title !== false) {
            echo Html::beginTag('div', ['class' => 'box-header with-border']);
            $this->renderTools();
            if ($this->title) {
                echo '<h3 class="box-title"> ' . $this->title . '</h3>';
            }
            echo Html::endTag('div');
        }
    }

    public function renderTools()
    {
        if ($this->tools) {
            echo Html::beginTag('div', ['class' => 'box-tools']);
            echo $this->tools;
            echo Html::endTag('div');
        }
    }

    public function renderContent()
    {
        echo Html::beginTag('div', ['class' => 'box-body']);
        if (!empty($this->content)) {
            echo $this->content;
        }
        echo Html::endTag('div');
    }

    public function renderFooter()
    {
        if ($this->footer !== false) {
            echo Html::beginTag('div', ['class' => 'box-footer']);
            if (!empty($this->footer)) {
                echo $this->footer;
            }
            echo Html::endTag('div');
        }
    }

    public function registerJsForCloseButton()
    {
        $this->addId();
        $view = $this->getView();
        $view->registerJs("
            $(document).on('click', 'a.close-box-button', function(event) {
                event.preventDefault();
                $('.box#{$this->id}').slideUp(500);
            });
        ");
    }

    public function addId()
    {
        if (isset($this->options['id'])) {
            $this->options['id'] .= " {$this->id}";
        } else {
            $this->options['id'] = $this->id;
        }
    }
}

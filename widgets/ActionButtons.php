<?php

namespace theme\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class ActionButtons extends Widget
{
    public $buttons;
    public $modelID = null;
    public $visibleFor = null;
    public $visible = true;
    private $defaultIcon = 'caret-square-o-left';
    private $defaultLabel = 'دکمه';

    public function run()
    {
        echo '<div class="row">';
        echo '<div class="col-sm-12">';
        foreach ($this->buttons as $action => $btnOptions) {
            $visibleFor = (empty($btnOptions['visibleFor'])) ? $this->visibleFor : $btnOptions['visibleFor'];
            $visible = isset($btnOptions['visible']) ? $btnOptions['visible'] : $this->visible;
            $options = (empty($btnOptions['options'])) ? [] : $btnOptions['options'];
            Html::addCssClass($options, 'btn-app');
            switch ($action) {
                case 'create':
                    $label = (empty($btnOptions['label'])) ? 'افزودن' : $btnOptions['label'];
                    $url = (empty($btnOptions['url'])) ? ['create'] : $btnOptions['url'];
                    echo Button::widget([
                        'url' => $url,
                        'label' => $label,
                        'icon' => 'plus',
                        'color' => 'green',
                        'visibleFor' => $visibleFor,
                        'visible' => $visible,
                        'options' => $options,
                    ]);
                    break;
                case 'update':
                    $label = (empty($btnOptions['label'])) ? 'ویرایش' : $btnOptions['label'];
                    echo Button::widget([
                        'url' => ['update', 'id' => $this->modelID],
                        'label' => $label,
                        'icon' => 'edit',
                        'color' => 'aqua',
                        'visibleFor' => $visibleFor,
                        'visible' => $visible,
                        'options' => $options,
                     ]);

                    break;
                case 'delete':
                    $label = (empty($btnOptions['label'])) ? 'حذف' : $btnOptions['label'];
                    echo Button::widget([
                        'url' => ['delete', 'id' => $this->modelID],
                        'label' => $label,
                        'icon' => 'times',
                        'color' => 'red',
                        'visibleFor' => $visibleFor,
                        'visible' => $visible,
                        'options' => array_merge(
                            $options,
                            [
                                'data' => [
                                    'confirm' => 'آیا برای حذف مطمئن هستید؟',
                                    'method' => 'post',
                                ],
                            ]
                        )
                     ]);
                    break;
                case 'index':
                     $label = (empty($btnOptions['label'])) ? 'مدیریت' : $btnOptions['label'];
                     $url = (empty($btnOptions['url'])) ? ['index'] : $btnOptions['url'];
                     echo Button::widget([
                        'url' => $url,
                        'label' => $label,
                        'icon' => 'tasks',
                        'color' => 'purple',
                        'visibleFor' => $visibleFor,
                        'visible' => $visible,
                        'options' => $options,
                     ]);
                    break;
                case 'gallery':
                    $label = (empty($btnOptions['label'])) ? 'گالری' : $btnOptions['label'] ;
                    echo Button::widget([
                        'url' => ['gallery', 'id' => $this->modelID],
                        'label' => $label,
                        'icon' => 'camera-retro',
                        'color' => 'teal',
                        'visibleFor' => $visibleFor,
                        'visible' => $visible,
                        'options' => $options,
                     ]);
                    break;
                case 'categoriesIndex':
                     $label = (empty($btnOptions['label'])) ? 'مدیریت دسته ها' : $btnOptions['label'];
                     echo Button::widget([
                        'url' => ['category/index'],
                        'label' => $label,
                        'icon' => 'tasks',
                        'color' => 'purple',
                        'visibleFor' => $visibleFor,
                        'visible' => $visible,
                        'options' => $options,
                     ]);
                    break;
                default:
                    $button = $this->setOptions($btnOptions);
                    echo Button::widget([
                        'url' => $button['url'],
                        'label' => $button['label'],
                        'icon' => $button['icon'],
                        'color' => $button['color'] ?? 'blue',
                        'visibleFor' => $visibleFor,
                        'visible' => $visible,
                        'options' => $options,
                     ]);
                    break;
            }
        }
        echo '</div>';
        echo '</div>';
    }

    private function setOptions($btnOptions)
    {
        $btnOptions['label'] = (isset($btnOptions['label'])) ? $btnOptions['label'] :
            $this->defaultLabel;
        $btnOptions['icon'] = (isset($btnOptions['icon'])) ? $btnOptions['icon'] :
            $this->defaultIcon;

        return $btnOptions;
    }
}

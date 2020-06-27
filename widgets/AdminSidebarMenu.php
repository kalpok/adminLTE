<?php

namespace theme\widgets;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class AdminSidebarMenu extends \yii\widgets\Menu
{
    public $iconTemplate = '<i class="fa fa-{icon}"></i>';
    public $tagTemplate = '<i class="{type} pull-right flip">{value}</i>';
    public $linkTemplate = '
    <a href="{url}">{icon}
        <span>{label}</span>
        <span class="pull-right-container">
            {tag}
        </span>
    </a>';
    public $itemOptions = ['class' => 'treeview'];

    public function run()
    {
        $this->items = $this->getMenuItems();
        parent::run();
    }

    protected function renderItems($items)
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {
            if (!empty($item['items'])) {
                $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            } else {
                $options = ArrayHelper::getValue($item, 'options', []);
            }
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }
            Html::addCssClass($options, $class);

            $menu = $this->renderItem($item);
            if (!empty($item['items'])) {
                $submenuTemplate = ArrayHelper::getValue($item, 'submenuTemplate', $this->submenuTemplate);
                $menu .= strtr($submenuTemplate, [
                    '{items}' => $this->renderItems($item['items']),
                ]);
            }
            $lines[] = Html::tag($tag, $menu, $options);
        }

        return implode("\n", $lines);
    }

    protected function renderItem($item)
    {
        if (isset($item['url']) or isset($item['items'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);
            $iconTemplate = $this->setIconTemplate($item);
            $tagTemplate = $this->setTagTemplate($item);
            $label = $item['label'];
            if (isset($item['badge'])) {
                $label .= "<span class='badge bg-red badge-menu'>{$item['badge']}</span>";
            }
            return strtr(
                $template,
                [
                    '{icon}' => $iconTemplate,
                    '{tag}' => $tagTemplate,
                    '{url}' => isset($item['url']) ? Html::encode(Url::to($item['url'])) : '#',
                    '{label}' => $label
                ]
            );
        } else {
            $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);
            return strtr(
                $template,
                [
                    '{label}' => $item['label'],
                ]
            );
        }
    }

    private function setIconTemplate($item)
    {
        $iconTemplate = ArrayHelper::getValue($item, 'iconTemplate', $this->iconTemplate);
        if (isset($item['icon'])) {
            $iconTemplate = strtr($iconTemplate, ['{icon}' => $item['icon']]);
        } else {
            $iconTemplate = strtr($iconTemplate, ['{icon}' => 'circle-o']);
        }

        return $iconTemplate;
    }

    private function setTagTemplate($item)
    {
        $tagTemplate = ArrayHelper::getValue($item, 'tagTemplate', $this->tagTemplate);
        if (isset($item['tag'])) {
            $tagTemplate = strtr(
                $tagTemplate,
                [
                    '{type}' => 'label label-' . $item['tag']['type'],
                    '{value}' => $item['tag']['value']
                ]
            );
        } elseif (isset($item['items'])) {
            $tagTemplate = strtr(
                $tagTemplate,
                [
                    '{type}' => 'fa fa-angle-left fa-angle-right',
                    '{value}' => ''
                ]
            );
        } else {
            $tagTemplate = '';
        }

        return $tagTemplate;
    }

    private function getMenuItems()
    {
        $items = [];
        $modules = array_keys(Yii::$app->getModules());
        foreach ($modules as $moduleId) {
            $module = Yii::$app->getModule($moduleId);
            if (!empty($module->menu)) {
                if (is_array(current($module->menu))){
                    $items = array_merge($items, $module->menu);
                } else {
                    $items[] = $module->menu;
                }
            }
        }

        return $items;
    }
}

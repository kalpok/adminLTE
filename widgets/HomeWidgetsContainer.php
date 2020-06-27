<?php

namespace theme\widgets;

use Yii;
use yii\helpers\Html;

class HomeWidgetsContainer extends \yii\base\Widget
{
    private $boxWidgetConfigs = [];
    private $infoWidgetConfigs = [];

    public function run()
    {
        $modulesHomeWidgetConfigs = $this->getModulesHomeWidgetConfigs();
        foreach ($modulesHomeWidgetConfigs as $homeWidgetConfigs) {
            foreach ($homeWidgetConfigs as $homeWidgetConfig) {
                if (!$homeWidgetConfig['visible']) {
                    continue;
                }
                if ($homeWidgetConfig['type'] == 'info') {
                    $this->infoWidgetConfigs[] = $homeWidgetConfig;
                } elseif ($homeWidgetConfig['type'] == 'box') {
                    $this->boxWidgetConfigs[] = $homeWidgetConfig;
                }
            }
        }
        echo Html::tag('div', $this->renderInfoWidgets(), ['class' => 'row']);
        echo '<br><br>';
        echo Html::tag('div', $this->renderBoxWidgets(), ['class' => 'row']);
    }

    protected function renderInfoWidgets()
    {
        foreach ($this->infoWidgetConfigs as $infoWidgetConfig) {
            echo InfoWidget::widget([
                'class' => $infoWidgetConfig['class'] ?? 'col-md-4',
                'icon' => $infoWidgetConfig['icon'],
                'color' => $infoWidgetConfig['color'],
                'number' => $infoWidgetConfig['number'],
                'text' => $infoWidgetConfig['text'],
            ]);
        }
    }

    protected function renderBoxWidgets()
    {
        foreach ($this->boxWidgetConfigs as $boxWidgetConfig) {
            echo BoxWidget::widget([
                'class' => $boxWidgetConfig['class'] ?? 'col-lg-4',
                'color' => $boxWidgetConfig['color'],
                'inner' => $boxWidgetConfig['inner'],
                'icon' => $boxWidgetConfig['icon'],
                'link' => $boxWidgetConfig['link'],
            ]);
        }
    }

    private function getModulesHomeWidgetConfigs()
    {
        $homeWidgetConfigs = [];
        $modules = array_keys(Yii::$app->getModules());
        foreach ($modules as $moduleId) {
            $module = Yii::$app->getModule($moduleId);
            if (!empty($module->homeWidgets)) {
                $homeWidgetConfigs[] = $module->homeWidgets;
            }
        }

        return $homeWidgetConfigs;
    }
}

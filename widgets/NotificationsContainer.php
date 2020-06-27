<?php

namespace theme\widgets;

use Yii;
use yii\base\InvalidConfigException;

class NotificationsContainer extends \yii\base\Widget
{
    public function run()
    {
        $modulesNotificationConfigs = $this->getModulesNotificationConfigs();
        foreach ($modulesNotificationConfigs as $notificationConfigs) {
            foreach ($notificationConfigs as $notificationConfig) {
                if (!$notificationConfig['class']) {
                    throw new InvalidConfigException('
                        Object configuration must be an array containing a "class" element.
                    ');
                }
                $widgetClass = $notificationConfig['class'];
                unset($notificationConfig['class']);
                echo $widgetClass::widget($notificationConfig);
            }
        }
    }

    private function getModulesNotificationConfigs()
    {
        $notificationConfigs = [];
        $modules = array_keys(Yii::$app->getModules());
        foreach ($modules as $moduleId) {
            $module = Yii::$app->getModule($moduleId);
            if (!empty($module->notifications)) {
                $notificationConfigs[] = $module->notifications;
            }
        }

        return $notificationConfigs;
    }
}

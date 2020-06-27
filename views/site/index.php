<?php

use theme\widgets\HomeWidgetsContainer;

$this->title = Yii::$app->name;
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <p class="site-welcome" >
            کاربر گرامی
            <br>
            برای مدیریت اطلاعات و امکانات سامانه از منوی سمت راست استفاده کنید.
        </p>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <?= HomeWidgetsContainer::widget() ?>
    </div>
</div>

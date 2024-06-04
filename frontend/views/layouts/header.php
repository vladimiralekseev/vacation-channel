<?php

use common\models\Category;
use yii\helpers\Url;
use yii\web\View;

$googleTagManagerIDs = Yii::$app->params['googleTagManager']['ids'] ?? [];
if (YII_ENV === 'prod' && !empty($googleTagManagerIDs)) {
    $this->registerJsFile(
        'https://www.googletagmanager.com/gtag/js?id=' . $googleTagManagerIDs[0],
        ['position' => View::POS_HEAD, 'async' => true]
    );
    $gTagConfig = '';
    foreach ($googleTagManagerIDs as $id) {
        $gTagConfig .= "gtag('config', '$id');";
    }
    $this->registerJs(
        "
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    " . $gTagConfig,
        View::POS_HEAD
    );
}

//if (YII_ENV === "prod") {

/** @var Category[] $categories */
$categories = Category::find()->where(['menu' => Category::MENU_ACTIVE])->orderBy('order')->all();

?>
<header>
    <div class="fixed">
        <div class="float-end pt-2 menu-main-right">
            <span class="dropdown-menu-custom me-1">
                <span class="btn btn-third d-none d-sm-inline-block cursor-default">
                    <span class="d-block d-xl-none">Schedules</span>
                    <span class="d-none d-xl-inline">Branson Schedules</span>
                </span>
                <span class="btn-list">
                    <a href="<?= Url::to(['schedule/show']) ?>" class="btn btn-secondary">Shows</a>
                    <a href="<?= Url::to(['schedule/attraction']) ?>" class="btn btn-secondary">Attractions</a>
                </span>
            </span>
            <a href="mailto:contact@tvcbranson.com" class="btn btn-primary d-none d-sm-inline-block">Contact us</a>
        </div>
        <a id="menu-up-control" class="menu-up-control menu-up-control-is-close">
            <span class="icon icon-menu"></span>
            <span class="icon icon-x"></span>
        </a>
        <a href="/" class="logo">
            <img src="/img/logo.png" alt="Ibranson"/>
        </a>
        <div id="menu-general" class="menu-general menu-general-control-is-close">
            <ul class="menu-main">
                <li <?php if ($this->context->id === 'site' && $this->context->action->id === 'index') {
                    ?>class="active"<?php } ?>><a href="/#search-block">Featured</a></li>
                <?php foreach ($categories as $category) { ?>
                    <li <?php if ($this->context->id === 'category' && $this->context->actionParams['code'] ===
                    $category->code) { ?>class="active"<?php }
                    ?>>
                        <a href="<?= Url::to(['category/detail', 'code' => $category->code]) ?>">
                            <?= $category->name ?>
                        </a>
                    </li>
                <?php } ?>
                <li class="d-inline-block d-lg-none">
                    <a href="<?= Url::to(['schedule/show']) ?>">Shows Schedules</a>
                </li>
                <li class="d-inline-block d-lg-none">
                    <a href="<?= Url::to(['schedule/attraction']) ?>">Attractions Schedules</a>
                </li>
            </ul>
        </div>
    </div>
</header>

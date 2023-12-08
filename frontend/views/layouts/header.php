<?php

use common\models\Category;
use yii\helpers\Url;

/** @var Category[] $categories */
$categories = Category::find()->orderBy('order')->all();
?>
<header>
    <div class="fixed">
        <div class="float-end pt-2 menu-main-right">
            <a href="#" class="btn btn-third me-1 d-none d-sm-inline-block">
                <span class="d-block d-xl-none">Shows</span>
                <span class="d-none d-xl-inline">Latest Show Schedules</span>
            </a>
            <a href="#" class="btn btn-primary d-none d-sm-inline-block">Contact us</a>
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
                <li class="active"><a href="#search-block">Featured</a></li>
                <?php foreach ($categories as $category) { ?>
                    <li>
                        <a href="<?= Url::to(['category/detail', 'code' => $category->code]) ?>">
                            <?= $category->name ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</header>

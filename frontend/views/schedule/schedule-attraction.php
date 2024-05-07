<?php

/** @var $url */

use yii\helpers\Url;

$this->title = 'Attraction Schedules';

?>
<div class="row">
    <div class="col-12 col-lg-8 text-center text-lg-start">
        <h1 class="mb-3 mb-lg-5"><?= $this->title ?></h1>
    </div>
    <div class="col-4 p-3 text-end d-none d-lg-block">
        <a href="<?= Url::to(['schedule/show']) ?>" class="link-next mt-1">
            Show Schedules <span class="icon"></span>
        </a>
    </div>
</div>
<?= $this->render('schedule-layout', compact('url')) ?>

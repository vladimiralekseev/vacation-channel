<?php

/** @var $url */

use yii\helpers\Url;

$this->title = 'Attractions schedule';

?>
<div class="row">
    <div class="col-8">
        <h1 class="mb-5"><?= $this->title ?></h1>
    </div>
    <div class="col-4">
        <a href="<?= Url::to(['schedule/show']) ?>" class="link-next">Shows schedule <span class="icon"></span></a>
    </div>
</div>
<?= $this->render('schedule-layout', compact('url')) ?>

<?php

/** @var $url */

use yii\helpers\Url;

$this->title = 'Shows schedule';

?>
<div class="row">
    <div class="col-8">
        <h1 class="mb-5"><?= $this->title ?></h1>
    </div>
    <div class="col-4">
        <a href="<?= Url::to(['schedule/attraction']) ?>" class="link-next">Attractions schedule <span class="icon"></span></a>
    </div>
</div>

<?= $this->render('schedule-layout', compact('url')) ?>

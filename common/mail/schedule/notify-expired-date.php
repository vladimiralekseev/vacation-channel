<?php

use common\models\BransonSchedule;

/** @var BransonSchedule[] $schedules */

$domain = 'https://' . Yii::$app->params['domainRoot'];
?>
<p>The ad will be disabled after tomorrow for next items:</p>
<ul>
    <?php foreach ($schedules as $schedule) { ?>
        <li>
            <a style="color:#09B3B0;" href="<?= $domain ?>/schedule/view?id=<?= $schedule->id ?>"
               target="_blank"><?= $schedule->title ?></a>
            <br/>
            <?php if ($schedule->getExpiredDate()) { ?>
                Expiry date: <?= $schedule->getExpiredDate()->format('Y-m-d 23:59:59') ?><br/>
            <?php } ?>
            Url: <a style="color:#09B3B0;" href="<?= $schedule->url ?>" target="_blank"><?= $schedule->url ?></a><br/>
            Type: <?= $schedule->type ?><br/>
            External ID: <?= $schedule->external_id ?><br/>
            Order: <?= $schedule->order ?><br/>
        </li>
    <?php } ?>
</ul>

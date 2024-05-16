<?php

use common\models\BransonSchedule;

/** @var BransonSchedule[] $schedules */

$domain = 'https://' . Yii::$app->params['domainRoot'];
?>
<p>The ad will be disabled after tomorrow for next items:</p>
<ul>
    <?php foreach ($schedules as $schedule) { ?>
        <li>
            <a href="<?= $domain ?>/schedule/view?id=<?= $schedule->id ?>" target="_blank"><?= $schedule->title ?></a>
            <br />
            Expiry date: <?= $schedule->expiry_date ?><br />
            Url: <?= $schedule->url ?><br />
            Type: <?= $schedule->type ?><br />
            External ID: <?= $schedule->external_id ?><br />
            Order: <?= $schedule->order ?><br />
        </li>
    <?php } ?>
</ul>

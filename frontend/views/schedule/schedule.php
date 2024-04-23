<?php

use frontend\models\forms\PopupScheduleSearch;
use yii\helpers\Url;

/**
 * @var PopupScheduleSearch $Search
 * @var array $scheduleByDay
 * @var array $scheduleForDay
 */

$tab = (int)Yii::$app->getRequest()->get('tab');
?>
<div class="popup-schedule">
    <div class="schedule-tab">
        <div class="row row-small-padding print-hide">
            <div class="col-5 d-none d-sm-block"></div>
            <div class="col-8 col-sm-5 text-left text-sm-end">
                <ul class="nav nav-tabs justify-content-center justify-content-sm-start" role="tablist">
                    <li role="presentation"><a class="js-tab <?php if ($tab === 0) { ?>active<?php
                        }?>" data-bs-target="#weekly" aria-controls="weekly" role="tab" data-bs-toggle="tab">Weekly</a></li>
                    <li role="presentation" ><a class="js-tab <?php if ($tab === 1) { ?>active<?php
                        }?>" data-bs-target="#daily" aria-controls="daily" role="tab" data-bs-toggle="tab">Daily</a></li>
                </ul>
            </div>
            <div class="col-4 col-sm-2">
                <a href="<?= Url::to(['schedule/show-print', 'date' => $Search->getDateTimeFrom()->format('Y-m-d'), 'tab' => 0])
                ?>" class="btn btn-primary w-100 btn-sm js-tab-print <?php if ($tab === 1) { ?>d-none<?php } ?>"
                   target="_blank">Print</a>
                <a href="<?= Url::to(['schedule/show-print', 'date' => $Search->getDateTimeFrom()->format('Y-m-d'), 'tab' => 1])
                ?>" class="btn btn-primary w-100 btn-sm js-tab-print <?php if ($tab === 0) { ?>d-none<?php } ?>"
                   target="_blank">Print</a>
            </div>
        </div>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane <?php if ($tab === 0) { ?>show active<?php } ?>" id="weekly">

                <div class="scrollbar-inner">

                    <div class="row row-small-padding my-2 my-sm-3 pt-2 pt-sm-3 info">
                        <div class="col-5 col-sm-4 text-center text-sm-start mb-2 mb-sm-3">
                            <b>Schedule for:</b><br>
                            <div class="d-inline-block mt-0 mt-sm-2">
                            <?= $Search->getDateTimeFrom()->format("m/d/Y")?> - <?= $Search->getDateTimeTo()->format
                                ("m/d/Y")?>
                            </div>
                        </div>
                        <div class="col-7 col-sm-4 text-center mb-2 mb-sm-3">
                            <b>Contact Phone:</b><br>
                            <a href="tel:(417) 294-6505" class="text-black d-inline-block mt-0 mt-sm-2">
                                <i class="icon icon-phone"></i> (417) 294-6505
                            </a>
                        </div>
                        <div class="col-12 col-sm-4 text-center text-sm-end mb-2 mb-sm-3">
                            <b>Sponsored by iBranson:</b><br>
                            <a href="https://ibranson.com" target="_blank">
                                <img src="/img/ib-logo-25y.png" alt="IBranson" class="logo" />
                            </a>
                        </div>
                    </div>

                    <div class="main-print print-schedule">
                        <div class="my-3">
                            <span class="it-m mb-1 me-2"><span class="it-box">A</span> Adult</span>
                            <span class="it-m mb-1 me-2"><span class="it-box">F</span> Family Pass</span>
                            <span class="it-m mb-1 me-2">
                                <span class="it-box"><span class="special-rate"></span></span> Special Savings
                            </span>
                            <span class="it-m mb-1 me-2"><span class="square morning">M</span> Morning</span>
                            <span class="it-m mb-1 me-2"><span class="square afternoon">A</span> Afternoon</span>
                            <span class="it-m mb-1"><span class="square evening">E</span> Evening</span>
                        </div>

                        <table class="table table-bordered table-header">
                            <thead>
                            <tr>
                                <th class="first-column"><b>Description of Item</b></th>
                                <?php for ($i=0; $i<7; $i++) {?>
                                    <th class="text-center"><?=
                                        date(
                                            "D",
                                            $Search->getDateTimeFrom()->format("U") + $i * 3600 * 24
                                        )
                                        ?></th>
                                <?php }?>
                            </tr>
                            </thead>
                            <tbody class="padding-unset">

                            <?php if ($scheduleByDay) {?>
                                <?php foreach ($scheduleByDay as $it) {?>
                                    <tr>
                                        <td class="first-column">
                                            <a href="<?= $it['url'] ?>" target="_blank"><?= $it['name'] ?></a>,
                                            <?php if($it["minAdultSpecial"]){?>
                                                <span class="cost">$ <?=$it["minAdultSpecial"]?></span> <span class="cost strike">$ <?= $it["minAdult"]?></span> <span class="it-m"><span class="it-box it-box-small">A</span></span>
                                            <?php } else if($it["minAdult"]) {?>
                                                <span class="cost">$ <?=$it["minAdult"]?></span> <span class="it-m"><span class="it-box it-box-small">A</span></span>
                                            <?php }?>
                                            <?php if ($it["minFamilySpecial"]) {?>
                                                <span class="cost">$ <?=$it["minFamilySpecial"]?></span> <span
                                                        class="cost strike">$ <?= $it["minFamily"]?></span> <span class="it-m"><span class="it-box it-box-small">F</span></span>
                                            <?php } else if ($it["minFamily"]) {?>
                                                <span class="cost">$ <?=$it["minFamily"]?></span> <span class="it-m"><span class="it-box it-box-small">F</span></span>
                                            <?php }?>
                                        </td>
                                        <?php if (!empty($it["schedule"])) {?>
                                            <?php foreach ($it["schedule"] as $w => $times) {?>
                                                <td class="text-center">
                                                    <?php if (is_array($times)) {
                                                        foreach ($times as $row) {
                                                            $d = new DateTime($row['start']);
                                                            $color = "afternoon";
                                                            if ($d->format("H") < 12) {
                                                                $color = "morning";
                                                            }
                                                            if ($d->format("H") > 16) {
                                                                $color = "evening";
                                                            }
                                                            $row['url'] = 'https://ibranson.com' . $row['url'];
                                                            ?>
                                                            <?php if (!empty($row['any_time'])) {?>
                                                                <div class="time"><a href="<?= $row['url'] ?>" target="_blank"><?=
                                                                        $row['special_rate'] ? '<b class="special-rate">$</b>' : ''?>Any Time</span></a></div>
                                                            <?php } else {?>
                                                                <div class="time <?= $color?>"><a href="<?= $row['url'] ?>" target="_blank"><?= $row['special_rate'] ? '<b class="special-rate">$</b>' : ''?><?= $d->format("h:i A")?></a></div>
                                                            <?php }?>
                                                        <?php }}?>
                                                </td>
                                            <?php }}?>
                                    </tr>
                                <?php }}?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane <?php if ((int)Yii::$app->getRequest()->get('tab') === 1)
            {?>show active<?php }?>" id="daily">

                <div class="scrollbar-inner">
                    <div class="row row-small-padding my-2 my-sm-3 pt-2 pt-sm-3 info">
                        <div class="col-5 col-sm-4 text-center text-sm-start mb-2 mb-sm-3">
                            <b>Schedule for:</b><br>
                            <div class="d-inline-block mt-0 mt-sm-2">
                                <?= $Search->getDateTimeFrom()->format("m/d/Y")?>
                            </div>
                        </div>
                        <div class="col-7 col-sm-4 text-center mb-2 mb-sm-3">
                            <b>Contact Phone:</b><br>
                            <a href="tel:(417) 294-6505" class="text-black d-inline-block mt-0 mt-sm-2">
                                <i class="icon icon-phone"></i> (417) 294-6505
                            </a>
                        </div>
                        <div class="col-12 col-sm-4 text-center text-sm-end mb-2 mb-sm-3">
                            <b>Sponsored by iBranson:</b><br>
                            <a href="https://ibranson.com" target="_blank">
                                <img src="/img/ib-logo-25y.png" alt="IBranson" class="logo" />
                            </a>
                        </div>
                    </div>

                    <div class="main-print print-schedule">
                        <div class="my-3">
                            <span class="it-m mb-1 me-2"><span class="it-box">A</span> Adult</span>
                            <span class="it-m mb-1 me-2"><span class="it-box">F</span> Family Pass</span>
                            <span class="it-m mb-1">
                                <span class="it-box"><span class="special-rate"></span></span> Special Savings
                            </span>
                        </div>
                        <table class="table table-bordered table-header">
                            <thead>
                            <tr>
                                <th width="25%">Time</th>
                                <th>Items</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($scheduleForDay as $mk => $ar) { ?>
                            <tr>
                                <td><div class="my-2"><?= $mk?></div></td>
                                <td>
                                    <ul class="decor my-2">
                                        <?php foreach ($ar as $it) {?>
                                        <li <?php if ($it['hasDiscount']) {?>class="color"<?php } ?>>
                                            <a href="<?= $it['url'] ?>" target="_blank"><?= $it['name'] ?></a>
                                            <?php if ($it['hasAdult']) { ?>
                                                <span class="it-m me-1"><span class="it-box it-box-small">A</span></span>
                                            <?php }?>
                                            <?php if ($it['hasFamilyPass']) { ?>
                                                <span class="it-m me-1"><span class="it-box it-box-small">F</span></span>
                                            <?php }?>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

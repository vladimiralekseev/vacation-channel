<?php

/** @var $url */

use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\web\JqueryAsset;

BootstrapPluginAsset::register($this);

$this->registerJsFile('js/bootstrap-datepicker.min.js', ['depends' => [JqueryAsset::class, BootstrapAsset::class]]);
$this->registerJsFile('js/schedule.js', ['depends' => [JqueryAsset::class, BootstrapAsset::class]]);
$this->registerJs('schedule.init("' . $url . '")');

$this->title = 'Attractions schedule';

?>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="white-block">
            <div class="schedule-filter">
                <div class="field field-datepicker">
                    <input name="date-from" type="text" class="form-control datepicker js-datepicker" autocomplete="off"
                           value="<?= date("m/d/Y") ?>"/>
                    <span class="icon ibranson-fontawesome-webfont"></span>
                </div>
                <i class="icon icon-calendar text-black"></i>
            </div>
            <div class="js-modal-content"></div>
        </div>
    </div>
    <div class="col-2"></div>
</div>


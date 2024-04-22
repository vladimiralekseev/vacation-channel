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

$this->registerJsFile('/js/jquery.scrollbar.min.js', ['depends' => [JqueryAsset::class, BootstrapAsset::class]]);
$this->registerCssFile('/css/jquery.scrollbar.css');
?>
<div class="row d-flex flex-column flex-lg-row">
    <div class="col-12 col-lg-2 order-1 order-lg-1 mb-3">
        <div class="ad-example">Your ad can be here!</div>
    </div>
    <div class="col-12 col-lg-8 order-3 order-lg-2 mb-3">
        <div class="white-block position-relative">
            <div class="schedule-filter mb-2 mb-sm-0">
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
    <div class="col-12 col-lg-2 order-2 order-lg-3 mb-3">
        <div class="ad-example">Your ad can be here!</div>
    </div>
</div>


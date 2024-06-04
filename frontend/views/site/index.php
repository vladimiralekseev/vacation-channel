<?php

use common\models\Video;
use yii\helpers\Url;

/**
 * @var Video     $mainVideo
 * @var Video[]   $mainSliderVideo
 * @var Video[][] $groupVideo
 */

?>
<div class="d-block d-sm-none text-center mb-3">
    <a href="<?= Url::to(['schedule/show']) ?>" class="btn btn-secondary">Shows</a>
    <a href="<?= Url::to(['schedule/attraction']) ?>" class="btn btn-secondary">Attractions</a>
</div>
<div class="main-block mb-3">
    <div class="row">
        <div class="col-lg-6 text-center text-md-start">
            <div class="site-name mb-3">Branson, Missouri&nbsp;TV</div>
            <div class="row">
                <div class="col-md-auto mt-1 mb-3 mb-lg-5">
                    <a class="btn btn-secondary" href="#search-block">Explore more</a>
                </div>
                <div class="col mb-3 mb-lg-5">
                    <span class="">
                        See all Branson’s announcements here.<br/>Search what you are interested in!
                    </span>
                </div>
            </div>
            <?= $this->render('main-slider', compact('mainSliderVideo')) ?>
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0">
            <?php if ($mainVideo && $mainVideo->youtube_code) { ?>
                <iframe class="youtube" src="https://www.youtube.com/embed/<?= $mainVideo->youtube_code ?>"
                        height="250"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; web-share"
                        allowfullscreen></iframe>
            <?php } ?>
        </div>
    </div>
</div>
<?= $this->render('search-on-main', compact('searchForm')) ?>
<div class="js-video-list">
    <?= $this->render('video-group-list', compact('groupVideo')) ?>
</div>
<?php $this->registerJsFile('/js/category-slider.js') ?>
<?php $this->registerJsFile('/js/main-search.js') ?>
<?php $this->registerJs('mainSearch.init();') ?>

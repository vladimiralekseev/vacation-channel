<?php

use common\models\Category;
use common\models\Video;

/**
 * @var Video      $mainVideo
 * @var Video[]    $mainSliderVideo
 * @var Video[]    $mainPageVideo
 * @var Category[] $categories
 */

?>
<div class="main-block mb-3">
    <div class="row">
        <div class="col-lg-6 text-center text-md-start">
            <div class="site-name">Branson, Missouri&nbsp;TV</div>
            <div class="row">
                <div class="col-md-auto mt-1 mb-3 mb-lg-5">
                    <a class="btn btn-secondary">Explore more</a>
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
<div class="search-main" id="search-block">
    <span class="icon icon-search"></span>
    <div class="form-group field-contactform-name required has-error">
        <input type="text" id="contactform-name" placeholder="Search video ..." class="form-control"
               name="ContactForm[name]"
               aria-required="true" aria-invalid="true">
        <p class="help-block help-block-error"></p>
    </div>
</div>
<?php foreach ($categories as $category) { ?>
    <?= $this->render(
        'slider',
        [
            'category' => $category,
            'videos'   => $mainPageVideo[$category->id] ?? [],
            'showMore' => true,
        ]
    ) ?>
<?php } ?>

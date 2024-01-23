<?php

use common\models\Video;
use yii\helpers\Url;

/**
 * @var Video $video
 */

$this->title = $video->name;
?>
<div class="mb-3 d-none d-lg-block">
    <a href="<?= Url::to(['category/detail', 'code' => $video->category->code]) ?>" class="link-back">
        <span class="icon"></span><?= $video->category->name ?? '' ?>
    </a>
</div>
<h1><?= $video->name ?></h1>
<div class="details-block">
    <div class="row">
        <div class="col-lg-8">
            <div class="video">
                <iframe id="ytplayer" type="text/html" width="640" height="390"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        src="https://www.youtube.com/embed/<?= $video->youtube_code ?>?enablejsapi=1&autoplay=1"
                        frameborder="0"></iframe>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="time">Branson Vacation Channel — <span id="youtube-duration"></span></div>
            <div class="description">
                <?= !empty($video->description) ? $video->description : $video->name ?>
            </div>
            <?php if ($video->link && $video->link_name) { ?>
                <a href="<?= $video->link ?>" target="_blank" class="btn btn-primary w-100"><?= $video->link_name ?></a>
            <?php } ?>
        </div>
    </div>
</div>
<?php if ($video->category && $video->category->videos) { ?>
    <?= $this->render(
        '@frontend/views/site/slider',
        [
            'category' => $video->category,
            'videos'   => $video->category->videos ? array_filter(
                $video->category->videos,
                static function ($v, $k) use ($video) {
                    return $v->id !== $video->id;
                },
                ARRAY_FILTER_USE_BOTH
            ) : [],
            'showMore' => false,
        ]
    ) ?>
<?php } ?>
<?php $this->registerJsFile('/js/category-slider.js') ?>
<?php $this->registerJsFile('https://www.youtube.com/player_api') ?>
<?php $this->registerJsFile('/js/player-youtube.js') ?>
<?php $this->registerJs('initSliders()') ?>

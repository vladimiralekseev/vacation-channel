<?php

use common\models\Video;

/**
 * @var Video $video
 */

$this->title = $video->name;
?>
<div class="mb-3 d-none d-lg-block">
    <a href="#" class="link-back"><span class="icon"></span><?= $video->category->name ?? '' ?></a>
</div>
<h1><?= $video->name ?></h1>
<div class="details-block">
    <div class="row">
        <div class="col-lg-8">
            <div class="video">
                <iframe class="youtube" src="https://www.youtube.com/embed/<?= $video->youtube_code ?>"
                        title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; web-share" allowfullscreen>
                </iframe></div>
        </div>
        <div class="col-lg-4">
            <div class="time">Branson Vacation Channel — 00:55</div>
            <div class="description"><?= $video->description ?></div>
            <a href="#" class="btn btn-primary w-100">Buy now</a>
        </div>
    </div>
</div>
<?php if ($video->category && $video->category->videos) { ?>
    <?= $this->render(
        '@frontend/views/site/slider',
        [
            'category' => $video->category,
            'videos'   => $video->category->videos,
            'showMore' => false,
        ]
    ) ?>
<?php } ?>

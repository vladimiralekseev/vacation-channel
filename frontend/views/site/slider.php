<?php

use common\models\Category;
use common\models\Video;
use yii\helpers\Url;

/**
 * @var bool     $showMore
 * @var Category $category
 * @var Video[]  $videos
 */
?>
<?php if ($category && $videos) { ?>
    <div class="section-slider js-section-slider" id="section-<?= $category->code ?>">
        <?php if ($showMore) { ?>
            <a href="<?= Url::to(['category/detail', 'code' => $category->code]) ?>"
               class="section-slider-btn btn btn-secondary d-none d-sm-inline-block">More</a>
            <a href="<?= Url::to(['category/detail', 'code' => $category->code]) ?>" class="section-slider-name"><?= $category->name ?></a>
        <?php } ?>
        <section class="js-<?= $category->code ?>-slider splide" id="<?= $category->code ?>-slider">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php foreach ($videos as $video) { ?>
                        <?php $link = Url::to(
                            ['video/detail', 'videoCode' => $video->code, 'sCode' => $video->category->code]
                        ); ?>
                        <li class="splide__slide">
                            <a class="img" href="<?= $link ?>"
                               style="background-image:url('https://i.ytimg.com/vi/<?= $video->youtube_code ?>/hqdefault.jpg')"></a>
                            <a href="<?= $link ?>" class="item-name"><?= $video->name ?></a>
                            <a href="<?= $link ?>" class="btn btn-third">View details</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </section>
    </div>
<?php } ?>

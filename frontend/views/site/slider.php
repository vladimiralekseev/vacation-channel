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
    <div class="section-slider" id="section-<?= $category->code ?>">
        <?php if ($showMore) { ?>
            <a href="<?= $category->code ?>"
               class="section-slider-btn btn btn-secondary d-none d-sm-inline-block">More</a>
            <a href="<?= $category->code ?>" class="section-slider-name"><?= $category->name ?></a>
        <?php } ?>
        <section class="js-<?= $category->code ?>-slider splide">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php foreach ($videos as $video) { ?>
                        <?php $link = Url::to(
                            ['video/detail', 'code' => $video->code, 'sCode' => $video->category->code]
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

    <?php $this->registerJs(
        "
    if ($('.js-" . $category->code . "-slider').length) {
        let attractionSlider = new Splide('.js-" . $category->code . "-slider', {
            perPage: perPageCount(),
            rewind: true,
        });
        attractionSlider.on('resize', function () {
            attractionSlider.options = {
                perPage: perPageCount(),
            };
        });
        attractionSlider.mount();
    }
"
    ) ?>

<?php } ?>
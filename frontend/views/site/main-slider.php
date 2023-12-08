<?php

use common\models\Video;
use yii\helpers\Url;

/**
 * @var Video[] $mainSliderVideo
 */

?>
<?php if ($mainSliderVideo) { ?>
    <div class="main-slider">
        <section class="js-main-slider splide">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php foreach ($mainSliderVideo as $video) { ?>

                        <li class="splide__slide">
                            <a style="background-image:url('https://i.ytimg.com/vi/<?= $video->youtube_code ?>/hqdefault.jpg')"
                               class="img" href="<?= Url::to(
                                       ['video/detail', 'code' => $video->code, 'sCode' => $video->category->code]
                            ) ?>">
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </section>
    </div>
<?php } ?>

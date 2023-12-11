<?php

use common\models\Video;
use yii\helpers\Url;

/**
 * @var Video[] $videos
 */

?>
<?php foreach ($videos as $video) { ?>
    <?php $link = Url::to(['video/detail', 'code' => $video->code, 'sCode' => $video->category->code]); ?>
    <div class="video-item">
        <a class="img" href="<?= $link ?>"
           style="background-image:url('https://i.ytimg.com/vi/<?= $video->youtube_code ?>/hqdefault.jpg')"></a>
        <a href="<?= $link ?>" class="item-name"><?= $video->name ?></a>
        <a href="<?= $link ?>" class="btn btn-third">View details</a>
    </div>
<?php } ?>

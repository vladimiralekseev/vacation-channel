<?php

use common\models\Video;

/**
 * @var Video[][] $groupVideo
 */

?>
<?php foreach ($groupVideo as $videos) { ?>
    <?= $this->render(
        'slider',
        [
            'category' => $videos[0]->category,
            'videos'   => $videos,
            'showMore' => true,
        ]
    ) ?>
<?php } ?>


<?php

use common\models\Category;
use yii\helpers\Url;

/**
 * @var Category $category
 */

$this->title = $category->name;
?>
<h1><?= $category->name ?></h1>
<div class="search-main" id="search-block">
    <span class="icon icon-search"></span>
    <div class="form-group field-contactform-name required has-error">
        <input type="text" id="contactform-name" placeholder="Search video ..." class="form-control"
               name="ContactForm[name]"
               aria-required="true" aria-invalid="true">
        <p class="help-block help-block-error"></p>
    </div>
</div>

<div class="video-list">
    <?php foreach ($category->videos as $video) { ?>
        <?php $link = Url::to(['video/detail', 'code' => $video->code, 'sCode' => $video->category->code]); ?>
        <div class="video-item">
            <a class="img" href="<?= $link ?>"
               style="background-image:url('https://i.ytimg.com/vi/<?= $video->youtube_code ?>/hqdefault.jpg')"></a>
            <a href="<?= $link ?>" class="item-name"><?= $video->name ?></a>
            <a href="<?= $link ?>" class="btn btn-third">View details</a>
        </div>
    <?php } ?>
</div>

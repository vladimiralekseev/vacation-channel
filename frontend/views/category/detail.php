<?php

use common\models\Category;
use frontend\models\forms\SearchForm;
use yii\bootstrap\ActiveForm;

/**
 * @var Category   $category
 * @var SearchForm $searchForm
 */

$this->title = $category->name;
?>
<h1><?= $category->name ?></h1>
<div class="search-main" id="search-block">
    <?php $form = ActiveForm::begin(
        [
            'id'             => 'category-search',
            'validateOnBlur' => false,
            'method'         => 'POST',
            'action'         => ['category/search', 'code' => $category->code]
        ]
    ); ?>
    <div class="spinner-border text-white float-end js-loader"></div>
    <span class="icon icon-search cursor-pointer js-submit-form"></span>
    <?= $form->field($searchForm, 'search')->textInput(['placeholder' => 'Search video ...'])->label(false) ?>
    <?php ActiveForm::end(); ?>
</div>
<div class="video-list js-video-list">
    <?= $this->render('video-list', ['videos' => $category->getVideos()->orderBy('id desc')->all()]) ?>
</div>
<?php $this->registerJsFile('/js/category-search.js') ?>
<?php $this->registerJs('categorySearch.init();') ?>

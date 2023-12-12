<?php

use frontend\models\forms\SearchForm;
use yii\bootstrap\ActiveForm;

/**
 * @var SearchForm $searchForm
 */
?>
<div class="search-main" id="search-block">
    <?php $form = ActiveForm::begin(
        [
            'id'             => 'main-search-block',
            'validateOnBlur' => false,
            'method'         => 'POST',
            'action'         => ['site/search']
        ]
    ); ?>
    <div class="spinner-border text-white float-end js-loader"></div>
    <span class="icon icon-search cursor-pointer js-submit-form"></span>
    <?= $form->field($searchForm, 'search')->textInput(['placeholder' => 'Search video ...'])->label(false) ?>
    <?php ActiveForm::end(); ?>
</div>

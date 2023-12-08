<?php

use common\models\Category;

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

<?php

namespace backend\controllers;

use backend\models\search\CategorySearch;
use common\models\Category;

class CategoriesController extends CrudController
{
    public $modelClass = Category::class;
    public $modelSearchClass = CategorySearch::class;
}

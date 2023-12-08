<?php

namespace backend\controllers;

use backend\models\search\VideoSearch;
use common\models\Video;

class VideosController extends CrudController
{
    public $modelClass = Video::class;
    public $modelSearchClass = VideoSearch::class;
}

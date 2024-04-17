<?php

namespace backend\controllers;

use backend\models\search\BransonScheduleSearch;
use common\models\BransonSchedule;

class ScheduleController extends CrudController
{
    public $modelClass = BransonSchedule::class;
    public $modelSearchClass = BransonScheduleSearch::class;
}

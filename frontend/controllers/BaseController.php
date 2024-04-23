<?php

namespace frontend\controllers;

use common\models\MetaData;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class BaseController extends Controller
{
    public const LAYOUT_PRINT = 'print';

    /**
     * @param $action
     *
     * @return bool
     * @throws BadRequestHttpException
     */
    public function beforeAction($action): bool
    {
        MetaData::setTags();

        return parent::beforeAction($action);
    }
}

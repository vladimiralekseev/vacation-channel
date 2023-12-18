<?php

namespace frontend\controllers;

use yii\web\Controller;

class ProgrammingController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}

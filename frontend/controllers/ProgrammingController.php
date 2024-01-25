<?php

namespace frontend\controllers;

class ProgrammingController extends BaseController
{
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}

<?php

namespace backend\controllers;

use backend\models\forms\MetaDataForm;
use backend\models\search\MetaDataSearch;
use Yii;
use yii\web\Response;

class MetaDataController extends CrudController
{
    public $modelClass = MetaDataForm::class;
    public $modelSearchClass = MetaDataSearch::class;

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new $this->modelClass;

        $model->load(Yii::$app->request->get());
        $load = $model->load(Yii::$app->request->post());

        if ($load && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderIsAjax('create', compact('model'));
    }
}

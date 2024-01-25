<?php

namespace backend\controllers;

use backend\models\search\VideoSearch;
use common\models\MetaData;
use common\models\Video;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class VideosController extends CrudController
{
    public $modelClass = Video::class;
    public $modelSearchClass = VideoSearch::class;

    /**
     * @param $id
     *
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $dataProviderMetaData = $model ? new ActiveDataProvider(
            [
                'query' => MetaData::find()->where(['url' => $model->youtube_code]),
                'sort'  => [
                    'defaultOrder' => [
                        'id' => SORT_DESC,
                    ],
                ],
            ]
        ) : null;

        return $this->renderIsAjax(
            'view',
            [
                'model' => $this->findModel($id),
                'dataProviderMetaData' => $dataProviderMetaData,
            ]
        );
    }
}

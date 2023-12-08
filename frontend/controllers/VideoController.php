<?php

namespace frontend\controllers;

use common\models\Video;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class VideoController extends Controller
{
    /**
     * @param $code
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionDetail($code): string
    {
        /**
         * @var Video $video
         */
        $video = Video::find()->where(['code' => $code])->one();

        if (!$video) {
            throw new NotFoundHttpException();
        }

        return $this->render(
            'detail',
            compact(
                'video'
            )
        );
    }
}

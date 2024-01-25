<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Video;
use yii\web\NotFoundHttpException;

class VideoController extends BaseController
{
    /**
     * @param $videoCode
     * @param $sCode
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionDetail($videoCode, $sCode): string
    {
        /**
         * @var Video $video
         */
        $video = Video::find()->where([Video::tableName() . '.code' => $videoCode])
            ->joinWith('category')
            ->andWhere([Category::tableName() . '.code' => $sCode])
            ->one();

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

<?php

namespace frontend\controllers;

use common\models\Category;
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
    public function actionDetail($code, $sCode): string
    {
        /**
         * @var Video $video
         */
        $video = Video::find()->where([Video::tableName() . '.code' => $code])
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

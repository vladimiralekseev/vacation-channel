<?php

namespace frontend\controllers;

use common\models\Category;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CategoryController extends Controller
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
         * @var Category $video
         */
        $category = Category::find()->where(['code' => $code])->one();

        if (!$category) {
            throw new NotFoundHttpException();
        }

        return $this->render(
            'detail',
            compact(
                'category'
            )
        );
    }
}

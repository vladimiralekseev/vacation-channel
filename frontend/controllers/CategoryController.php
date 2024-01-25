<?php

namespace frontend\controllers;

use common\models\Category;
use frontend\models\forms\SearchForm;
use Yii;
use yii\web\NotFoundHttpException;

class CategoryController extends BaseController
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
        $category = Category::find()->where(['code' => $code])
            ->one();

        if (!$category) {
            throw new NotFoundHttpException();
        }

        $searchForm = new SearchForm();

        return $this->render(
            'detail',
            compact(
                'category', 'searchForm'
            )
        );
    }

    /**
     * @param $code
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionSearch($code): string
    {
        /**
         * @var Category $category
         */
        $category = Category::find()->where(['code' => $code])
            ->one();

        if (!$category) {
            throw new NotFoundHttpException();
        }

        $this->layout = false;

        $searchForm = new SearchForm(['category_id' => $category->id]);

        if ($searchForm->load(Yii::$app->request->post()) && $videos = $searchForm->do()) {
            return $this->render('video-list', compact('videos'));
        }
        return $this->render('video-list', ['videos' => []]);
    }
}

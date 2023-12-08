<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Video;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ErrorAction;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actions(): array
    {
        return [
            'error'   => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $mainVideo = Video::find()->where(['main' => Video::MAIN_YES])->orderBy(new Expression('rand()'))->one();
        $mainSliderVideo = Video::find()->where(['main_slider' => Video::MAIN_SLIDER_YES])->all();
        $mainPageVideo = Video::find()->where(['main_page' => Video::MAIN_PAGE_YES])->all();
        $mainPageVideo = ArrayHelper::index($mainPageVideo, null, 'category_id');
        $categories = Category::find()->orderBy('order')->all();
        return $this->render(
            'index',
            compact('mainVideo', 'mainSliderVideo', 'mainPageVideo', 'categories')
        );
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash(
                    'success',
                    'Thank you for contacting us. We will respond to you as soon as possible.'
                );
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render(
            'contact',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}

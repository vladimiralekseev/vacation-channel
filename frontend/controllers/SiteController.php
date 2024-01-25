<?php

namespace frontend\controllers;

use common\models\Video;
use Exception;
use frontend\models\forms\SearchForm;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\ErrorAction;

/**
 * Site controller
 */
class SiteController extends BaseController
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
        $mainSliderVideo = Video::find()->where(['main_slider' => Video::MAIN_SLIDER_YES])->orderBy('order')->all();
        $groupVideo = Video::find()->where(['main_page' => Video::MAIN_PAGE_YES])->joinWith(['category'])->orderBy('order')->all();
        $groupVideo = ArrayHelper::index($groupVideo, null, 'category_id');
        $searchForm = new SearchForm();
        return $this->render(
            'index',
            compact('mainVideo', 'mainSliderVideo', 'groupVideo', 'searchForm')
        );
    }

    /**
     * @return string
     * @throws Exception
     */
    public function actionSearch(): string
    {
        $searchForm = new SearchForm();

        if ($searchForm->load(Yii::$app->request->post()) && $searchForm->validate()) {
            $videos = $searchForm->do();
            $groupVideo = ArrayHelper::index($videos, null, 'category_id');
            return $this->renderPartial('video-group-list', compact('groupVideo'));
        }
        $videos = Video::find()->where(['main_page' => Video::MAIN_PAGE_YES])->joinWith(['category'])->orderBy('order')->all();
        $groupVideo = ArrayHelper::index($videos, null, 'category_id');
        return $this->renderPartial('video-group-list', compact('groupVideo'));
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

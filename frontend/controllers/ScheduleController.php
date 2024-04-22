<?php

namespace frontend\controllers;

use common\helpers\ExternalSite;
use DateInterval;
use DateTime;
use Exception;
use frontend\models\forms\PopupScheduleSearch;
use Yii;
use yii\helpers\Json;
use yii\helpers\Url;

class ScheduleController extends BaseController
{
    public function actionShow(): string
    {
        $url = Url::to(['schedule/show-schedule']);
        return $this->render('schedule-show', compact('url'));
    }

    public function actionAttraction(): string
    {
        $url = Url::to(['schedule/attraction-schedule']);
        return $this->render('schedule-attraction', compact('url'));
    }

    public function actionShowSchedule(): string
    {
        $this->layout = false;
        $date = new DateTime();
        try {
            $date = new DateTime(Yii::$app->getRequest()->get('date'));
        } catch (Exception $e) {
        }
        $url = 'https://ibranson.com/shows-in-branson-missouri/popup-schedule-api/?date=' . $date->format('Y-m-d');
        $externalSite = new ExternalSite();
        $res = Json::decode($externalSite->request($url));
        $Search = new PopupScheduleSearch();
        $Search->setDateTimeFrom($date);
        $Search->setDateTimeTo((clone $date)->add(new DateInterval('P7D')));
        $scheduleByDay = $res['scheduleByDay'];
        $scheduleForDay = $res['scheduleForDay'];
        return $this->render('schedule', compact('Search', 'scheduleByDay', 'scheduleForDay'));
    }

    public function actionAttractionSchedule(): string
    {
        $this->layout = false;
        $date = new DateTime();
        try {
            $date = new DateTime(Yii::$app->getRequest()->get('date'));
        } catch (Exception $e) {
        }
        $url = 'https://ibranson.com/branson-mo-attractions/popup-schedule-api/?date=' . $date->format('Y-m-d');
        $externalSite = new ExternalSite();
        $res = Json::decode($externalSite->request($url));
        $Search = new PopupScheduleSearch();
        $Search->setDateTimeFrom($date);
        $Search->setDateTimeTo((clone $date)->add(new DateInterval('P7D')));
        $scheduleByDay = $res['scheduleByDay'];
        $scheduleForDay = $res['scheduleForDay'];
        return $this->render('schedule', compact('Search', 'scheduleByDay', 'scheduleForDay'));
    }
}

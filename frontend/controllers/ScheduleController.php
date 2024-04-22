<?php

namespace frontend\controllers;

use common\helpers\ExternalSite;
use common\models\BransonSchedule;
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
        $url = 'https://ibranson.com/shows-in-branson-missouri/popup-schedule-api/';
        $schedule = BransonSchedule::find()->where(['type' => BransonSchedule::TYPE_SHOW])
            ->indexBy('external_id')->all();
        return $this->schedule($url, $schedule);
    }

    public function actionAttractionSchedule(): string
    {
        $url = 'https://ibranson.com/branson-mo-attractions/popup-schedule-api/';
        $schedule = BransonSchedule::find()->where(['type' => BransonSchedule::TYPE_ATTRACTION])
            ->indexBy('external_id')->all();
        return $this->schedule($url, $schedule);
    }

    private function schedule($url, $schedule): string
    {
        $this->layout = false;
        $date = new DateTime();
        try {
            $date = new DateTime(Yii::$app->getRequest()->get('date'));
        } catch (Exception $e) {
        }

        $Search = new PopupScheduleSearch();
        $Search->setDateTimeFrom($date);
        $Search->setDateTimeTo((clone $date)->add(new DateInterval('P7D')));

        $url .= '?date=' . $date->format('Y-m-d');

        $cache = Yii::$app->cache;
        $scheduleCache = $cache->get($url);
        if ($scheduleCache === false) {
            $externalSite = new ExternalSite();
            $scheduleCache = Json::decode($externalSite->request($url));
            $cache->set($url, $scheduleCache, 60 * 60);
        }

        $scheduleByDay = $scheduleCache['scheduleByDay'];
        $scheduleByDay = array_map(
            static function ($it) use ($schedule) {
                if (!empty($schedule[$it['id_external']])) {
                    $it['order'] = $schedule[$it['id_external']]['order'];
                }
                if (!empty($schedule[$it['id_external']]) && $schedule[$it['id_external']]['url']) {
                    $it['url'] = $schedule[$it['id_external']]['url'];
                } else {
                    $it['url'] = 'https://ibranson.com' . $it['url'];
                }
                return $it;
            },
            $scheduleByDay
        );
        usort(
            $scheduleByDay,
            static function ($a, $b) {
                if ($a['order'] === $b['order']) {
                    return 0;
                }
                return ($a['order'] < $b['order']) ? -1 : 1;
            }
        );
        $scheduleForDay = $scheduleCache['scheduleForDay'];
        foreach ($scheduleForDay as &$item) {
            foreach ($item as &$it) {
                if (!empty($schedule[$it['id_external']]) && !empty($schedule[$it['id_external']]['url'])) {
                    $it['url'] = $schedule[$it['id_external']]['url'];
                } else {
                    $it['url'] = 'https://ibranson.com' . $it['url'];
                }
                if (!empty($schedule[$it['id_external']])) {
                    $it['order'] = $schedule[$it['id_external']]['order'];
                } else {
                    $it['order'] = 500;
                }
            }
            unset($it);
            usort(
                $item,
                static function ($a, $b) {
                    if ($a['order'] === $b['order']) {
                        return 0;
                    }
                    return ($a['order'] < $b['order']) ? -1 : 1;
                }
            );
        }

        return $this->render('schedule', compact('Search', 'scheduleByDay', 'scheduleForDay'));
    }
}

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
    public const ATTRACTION_URL = 'https://ibranson.com/branson-mo-attractions/popup-schedule-api/';
    public const SHOW_URL = 'https://ibranson.com/shows-in-branson-missouri/popup-schedule-api/';

    public function actionShowPrint(): string
    {
        $this->layout = self::LAYOUT_PRINT;
        return $this->schedule(self::SHOW_URL, BransonSchedule::TYPE_SHOW);
    }

    public function actionAttractionPrint(): string
    {
        $this->layout = self::LAYOUT_PRINT;
        return $this->schedule(self::ATTRACTION_URL, BransonSchedule::TYPE_ATTRACTION);
    }

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
        return $this->schedule(self::SHOW_URL, BransonSchedule::TYPE_SHOW);
    }

    public function actionAttractionSchedule(): string
    {
        $this->layout = false;
        return $this->schedule(self::ATTRACTION_URL, BransonSchedule::TYPE_ATTRACTION);
    }

    private function schedule($url, $type): string
    {
        $schedule = BransonSchedule::find()->where(['type' => $type])->indexBy('external_id')->all();

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

                $el = array_values(array_filter($scheduleByDay, static function($el) use ($it) {
                    return (int)$it['id_external'] === (int)$el['id_external'];
                }));
                $el = $el ? $el[0] : null;
                if ($el && !empty($el['availablePrices'])) {
                    $adult = array_filter($el['availablePrices'], static function($el) {
                        return $el['name'] === 'ADULT';
                    });
                    $it['hasAdult'] = !empty($adult);
                    $familyPass = array_filter($el['availablePrices'], static function($el) {
                        return stripos($el['name'], 'FAMILY PASS') !== false;
                    });
                    $it['hasFamilyPass'] = !empty($familyPass);
                    $discount = array_filter($el['availablePrices'], static function($el) use ($date) {
                        return stripos($el['start'], $date->format('Y-m-d')) !== false
                            && $el['special_rate'] && $el['special_rate'] !== $el['retail_rate'];
                    });
                    $it['hasDiscount'] = !empty($discount);
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

        return $this->render('schedule', compact('Search', 'scheduleByDay', 'scheduleForDay', 'type'));
    }
}

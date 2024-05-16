<?php

namespace console\controllers;

use common\models\BransonSchedule;
use DateInterval;
use DateTime;
use Exception;
use Yii;
use yii\console\Controller;

class ScheduleController extends Controller
{
    public function actionNotifyExpiredDate(): void
    {
        $schedules = BransonSchedule::find()
            ->andWhere(['expiry_date' => (new DateTime())->add(new DateInterval('P1D'))->format('Y-m-d')])
            ->all();
        if ($schedules) {
            try {
                Yii::$app->mailer
                    ->compose(
                        'schedule/notify-expired-date',
                        compact('schedules')
                    )
                    ->setTo(Yii::$app->params['emailTo'])
                    ->setBcc(Yii::$app->params['emailBcc'])
                    ->setFrom(Yii::$app->params['emailFrom'])
                    ->setSubject('Schedule expired date - Vacation Channel')
                    ->send();
            } catch (Exception $e) {
            }
        }
    }
}

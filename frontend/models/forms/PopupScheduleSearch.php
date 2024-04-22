<?php

namespace frontend\models\forms;

use DateTime;
use DateTimeInterface;
use yii\base\Model;

class PopupScheduleSearch extends Model
{
    private $dateTimeFrom;
    private $dateTimeTo;

    /**
     * Set Date and Time From
     *
     * @param DateTimeInterface $dateTimeFrom
     */
    public function setDateTimeFrom(DateTimeInterface $dateTimeFrom): void
    {
        $this->dateTimeFrom = $dateTimeFrom > new DateTime() ? $dateTimeFrom : new DateTime();
    }

    /**
     * Set Date and Time To
     *
     * @param DateTimeInterface $dateTimeTo
     */
    public function setDateTimeTo(DateTimeInterface $dateTimeTo): void
    {
        $this->dateTimeTo = $dateTimeTo > new DateTime() ? $dateTimeTo : new DateTime();
    }

    /**
     * Get DateTime From
     *
     * @return DateTime
     */
    public function getDateTimeFrom(): DateTime
    {
        return $this->dateTimeFrom ?? new DateTime();
    }

    /**
     * Get DateTime To
     *
     * @return DateTime
     */
    public function getDateTimeTo(): DateTime
    {
        return $this->dateTimeTo ?? new DateTime();
    }
}

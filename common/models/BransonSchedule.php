<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class BransonSchedule extends _source_BransonSchedule
{
    public const TYPE_SHOW       = 'show';
    public const TYPE_ATTRACTION = 'attraction';

    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class'      => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value'      => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return array_merge(
            parent::rules(),
            [
                [['order'], 'default', 'value' => 500],
                [['external_id'], 'unique'],
            ]
        );
    }

    public static function getTypesList(): array
    {
        return [
            self::TYPE_SHOW       => 'Show',
            self::TYPE_ATTRACTION => 'Attraction',
        ];
    }

    public static function getTypeValue($val): string
    {
        $ar = self::getTypesList();

        return $ar[$val] ?? $val;
    }
}

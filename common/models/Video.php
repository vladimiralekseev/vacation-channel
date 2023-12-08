<?php

namespace common\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Video extends _source_Video
{
    public const STATUS_ACTIVE   = 1;
    public const STATUS_INACTIVE = 0;

    public function behaviors(): array
    {
        return [
            'code'      => [
                'class'         => SluggableBehavior::class,
                'attribute'     => 'name',
                'slugAttribute' => 'code',
                'ensureUnique'  => true,
                'immutable'     => false,
            ],
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

    public static function getStatusList(): array
    {
        return [
            self::STATUS_ACTIVE   => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }

    public static function getStatusValue($val): string
    {
        $ar = self::getStatusList();

        return $ar[$val] ?? $val;
    }
}

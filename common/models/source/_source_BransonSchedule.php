<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "branson_schedule".
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property int $external_id
 * @property int $order
 * @property string|null $url
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $expiry_date
 */
class _source_BransonSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branson_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'type', 'external_id'], 'required'],
            [['external_id', 'order'], 'integer'],
            [['created_at', 'updated_at', 'expiry_date'], 'safe'],
            [['title'], 'string', 'max' => 256],
            [['type'], 'string', 'max' => 16],
            [['url'], 'string', 'max' => 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'type' => 'Type',
            'external_id' => 'External ID',
            'order' => 'Order',
            'url' => 'Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'expiry_date' => 'Expiry Date',
        ];
    }
}

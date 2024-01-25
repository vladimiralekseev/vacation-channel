<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meta_data".
 *
 * @property int $id
 * @property string|null $title
 * @property string $type
 * @property string|null $url
 * @property int|null $video_id
 * @property string $data
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Video $video
 */
class _source_MetaData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meta_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'data'], 'required'],
            [['video_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'url'], 'string', 'max' => 256],
            [['type'], 'string', 'max' => 16],
            [['data'], 'string', 'max' => 1024],
            [['video_id'], 'exist', 'skipOnError' => true, 'targetClass' => Video::class, 'targetAttribute' => ['video_id' => 'id']],
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
            'url' => 'Url',
            'video_id' => 'Video ID',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Video]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVideo()
    {
        return $this->hasOne(Video::class, ['id' => 'video_id']);
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "video".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $status
 * @property int $order
 * @property string $youtube_code
 * @property string|null $description
 * @property int|null $category_id
 * @property int $main
 * @property int $main_slider
 * @property int $main_page
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $link
 *
 * @property Category $category
 */
class _source_Video extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'status', 'order', 'youtube_code'], 'required'],
            [['status', 'order', 'category_id', 'main', 'main_slider', 'main_page'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'code', 'youtube_code', 'link'], 'string', 'max' => 256],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'status' => 'Status',
            'order' => 'Order',
            'youtube_code' => 'Youtube Code',
            'description' => 'Description',
            'category_id' => 'Category ID',
            'main' => 'Main',
            'main_slider' => 'Main Slider',
            'main_page' => 'Main Page',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'link' => 'Link',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}

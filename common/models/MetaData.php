<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Json;

class MetaData extends _source_MetaData
{
    public const TYPE_META  = 'meta';
    public const TYPE_LINK  = 'link';
    public const TYPE_TITLE = 'title';

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['url'], 'required'],
        ]);
    }

    public static function setTags(): void
    {
        /**
         * @var MetaData[] $tags
         * @var Video $video
         */
        $relativeUrl = '/' . Yii::$app->request->getPathInfo();
        $video = Yii::$app->request->get('videoCode')
            ? Video::find()->where(['code' => Yii::$app->request->get('videoCode')])->one()
            : null;
        $relativeUrl = $video->youtube_code ?? $relativeUrl;

        if ($relativeUrl) {
            $tags = self::find()->where(['url' => $relativeUrl])->all();
            foreach ($tags as $tag) {
                if ($tag->type === self::TYPE_META) {
                    Yii::$app->view->registerMetaTag($tag->data(), $tag->id . self::class);
                }
                if ($tag->type === self::TYPE_LINK) {
                    Yii::$app->view->registerLinkTag($tag->data(), $tag->id . self::class);
                }
                if ($tag->type === self::TYPE_TITLE) {
                    Yii::$app->view->title = $tag->title;
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
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
     * @return string[]
     */
    public static function getTypeList(): array
    {
        return [
            self::TYPE_META  => 'Meta',
            self::TYPE_LINK  => 'Link',
            self::TYPE_TITLE => 'Title',
        ];
    }

    /**
     * @param string $val
     *
     * @return string
     */
    public static function getTypeValue(string $val): string
    {
        $ar = self::getTypeList();

        return $ar[$val] ?? $val;
    }

    public function data(): array
    {
        return (array)Json::decode($this->data);
    }

    public function getDataAttributes(): string
    {
        $data = $this->data();
        array_walk(
            $data,
            static function (&$value, $key) {
                $value = $key . '="' . $value . '"';
            }
        );
        return implode(' ', $data);
    }
}

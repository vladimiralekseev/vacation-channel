<?php

namespace frontend\models\forms;

use common\models\Category;
use common\models\Video;
use Exception;
use yii\base\Model;

/**
 * @property int $level
 * @property int $period
 */
class SearchForm extends Model
{
    public $search;
    public $category_id;

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return array_merge(
            parent::rules(),
            [
                [['search', 'category_id'], 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process'],
                //xss protection
                [
                    ['category_id'],
                    'exist',
                    'skipOnError'     => true,
                    'targetClass'     => Category::class,
                    'targetAttribute' => ['category_id' => 'id']
                ],
            ]
        );
    }

    /**
     * @throws Exception
     */
    public function do(): ?array
    {
        if ($this->validate()) {
            $query = Video::find();
            if ($this->search) {
                $query->andWhere(['like', Video::tableName() . '.name', $this->search]);
            }
            if ($this->category_id) {
                $query->andWhere(['category_id' => $this->category_id]);
            }
            $query->orderBy('order');
            return $query->all();
        }
        return null;
    }
}

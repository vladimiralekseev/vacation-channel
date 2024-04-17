<?php

namespace backend\models\search;

use common\models\BransonSchedule;
use Yii;
use yii\data\ActiveDataProvider;

class BransonScheduleSearch extends BransonSchedule
{
    public function rules(): array
    {
        return [
            [['id', 'external_id', 'order'], 'integer'],
            [['title', 'url', 'type'], 'string'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider(
            [
                'query'      => $query,
                'pagination' => [
                    'pageSize' => Yii::$app->request->cookies->getValue('_grid_page_size', 20),
                ],
                'sort'       => [
                    'defaultOrder' => [
                        'order' => SORT_ASC,
                    ],
                ],
            ]
        );

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(
            [
                'id'          => $this->id,
                'external_id' => $this->external_id,
                'order'       => $this->order,
            ]
        );

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'url', $this->url]);
        $query->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}

<?php

namespace backend\models\search;

use common\models\Video;
use Yii;
use yii\data\ActiveDataProvider;

class VideoSearch extends Video
{
    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['name'], 'string'],
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
                        'id' => SORT_ASC,
                    ],
                ],
            ]
        );

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(
            [
                'id' => $this->id,
            ]
        );

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}

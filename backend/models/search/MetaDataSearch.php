<?php

namespace backend\models\search;

use common\models\MetaData;
use Yii;
use yii\data\ActiveDataProvider;

class MetaDataSearch extends MetaData
{
    public function rules()
    {
        return [];
    }

    public function search($params): ActiveDataProvider
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
                'pagination' => [
                    'pageSize' => Yii::$app->request->cookies->getValue('_grid_page_size', 20),
                ],
                'sort' => [
                    'defaultOrder' => [
                        'id' => SORT_DESC,
                    ],
                ],
            ]
        );

        $this->load($params);

        return $dataProvider;
    }
}

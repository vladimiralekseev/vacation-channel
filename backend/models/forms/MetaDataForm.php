<?php

namespace backend\models\forms;

use common\models\MetaData;
use yii\helpers\Json;

class MetaDataForm extends MetaData
{
    public string|int|array|null $key = [];
    public string|int|array|null $value = [];

    public function load($data, $formName = null): bool
    {
        $load = parent::load($data, $formName);

        $keys = $this->key ?? [];
        $values = $this->value ?? [];
        if (!empty($keys) && !empty($values)) {
            $data = array_combine($keys, $values);
            $data = array_filter(
                $data,
                static function ($value) {
                    return !empty($value);
                }
            );
            $this->setAttribute('data', Json::encode($data));
        }

        if ($this->type === self::TYPE_TITLE) {
            $this->data = '{}';
        } else {
            $this->title = '';
        }

        return $load;
    }

    public function rules(): array
    {
        return array_merge(
            parent::rules(),
            [
                [['key', 'value'], 'safe']
            ]
        );
    }
}

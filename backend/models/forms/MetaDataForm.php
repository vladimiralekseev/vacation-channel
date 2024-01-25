<?php

namespace backend\models\forms;

use common\models\MetaData;
use yii\helpers\Json;

class MetaDataForm extends MetaData
{
    public $key;
    public $value;

    public function load($data, $formName = null)
    {
        $load = parent::load($data, $formName);

        $keys = $this->getAttributes(['key'])['key'] ?? [];
        $values = $this->getAttributes(['value'])['value'] ?? [];
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

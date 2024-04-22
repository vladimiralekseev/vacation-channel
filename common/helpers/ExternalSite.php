<?php

namespace common\helpers;

use yii\base\Model;

class ExternalSite extends Model
{
    public $statusCode;
    private $ch;

    public function request($url)
    {
        $headers = [];
        $headers[] = 'Content-Type: application/json';
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 10);

        $server_output = curl_exec($this->ch);
        $curlInfo = curl_getinfo($this->ch);
        $this->statusCode = (int)$curlInfo['http_code'];
        return $server_output;
    }
}

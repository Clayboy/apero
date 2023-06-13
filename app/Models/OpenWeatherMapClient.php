<?php

namespace App\Models;


Class OpenWeatherMapClient {


    const URL       = "http://api.openweathermap.org/data/2.5";
    const PRO_URL   = "http://pro.openweathermap.org/data/2.5";

    private $lat    = '';
    private $lng    = '';

    private $lang   = "en";
    private $units  = "metric";
    private $cnt    = "7";
    private $appid  = "";

    private $result = [];

    public function __construct($appid)
    {
        $this->appid = $appid;
    }

    public function setLat($lat)
    {
        $this->lat = $lat;
        return $this;
    }

    public function setLng($lng)
    {
        $this->lng = $lng;
        return $this;
    }

    /**
     *
     * @param [type] $method
     * @return void
     */
    public function request($method)
    {
        $params = [
            'appid' => $this->appid,
            'lat'   => $this->lat,
            'lon'   => $this->lng,
            'lang'  => $this->lang,
            'units' => $this->units,
            'cnt'   => $this->cnt,
        ];

        $res = file_get_contents(self::URL . "/{$method}" . "?" . http_build_query($params));

        $this->result = json_decode($res);

        return $this->result;
    }

}

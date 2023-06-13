<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Model;

Class Weather implements Arrayable, Jsonable {

    private $client = "";

    public $icon            = "";
    public $iconId          = "";
    public $description     = "";
    public $main            = "";

    public $temperature     = "";
    public $humidity        = "";
    public $pressure        = "";
    public $wind            = "";
    public $wind_direction  = "";
    public $city            = "";

    public $sunset          = "";
    public $sunrise         = "";

    public function __construct($lat, $lng)
    {
        $this->client = new OpenWeatherMapClient(config('services.openweathermap.appid'));

        $this->client
            ->setLat($lat)
            ->setLng($lng);
    }



    public function getCurrent()
    {
        try{
            $weather = $this->client->request('weather');

            if(isset($weather->weather[0])){
                $this->description  = $weather->weather[0]->description;
                $this->main         = $weather->weather[0]->main;
                $this->iconId       = $weather->weather[0]->id;

            }

            $this->temperature  = ceil($weather->main->temp);
            $this->humidity     = $weather->main->humidity;
            $this->pressure     = $weather->main->pressure;
            $this->wind         = $weather->wind;

            $this->sunset       = $weather->sys->sunset;
            $this->sunrise      = $weather->sys->sunrise;
            $this->city         = $weather->name;

        }catch(Exception $e){
            return false;
        }

        return $this;
    }

    /**
     *
     * @param Carbon $date
     * @return void
     */
    public function getIcon(Carbon $date = null)
    {

        // if(!$date){
        //     $date = Carbon::now();
        // }

        // if(self::ICONS[$this->iconId]){
        //     $this->icon = self::ICONS[$this->iconId];

        //     if ($this->sunrise > $date->getTimestamp() || $this->sunset < $date->getTimestamp()) {
        //         $this->icon = str_replace(array('sunny', 'sun'), array('night', 'moon'), $this->icon);
        //     }

        //     return $this->icon;
        // }

        // return $this->icon;
    }


    public function toArray($options = 0)
    {
        return get_object_vars($this);
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray($options));
    }

    /**
     * Convert the model to its string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }


}

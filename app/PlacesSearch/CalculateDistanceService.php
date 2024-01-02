<?php

namespace App\PlacesSearch;

class CalculateDistanceService implements CalculateDistanceServiceInterface
{
    protected $initLat;
    protected $initLon;

    public function __construct($initLat, $initLon)
    {
        $this->initLat = $initLat;
        $this->initLon = $initLon;
    }

    public function calculateDistance($place)
    {
        return 2 * asin(sqrt(pow(sin(($this->initLat - $place->lat) / 2), 2) + cos($this->initLat) * cos($place->lat) * pow(sin(($this->initLon - $place->lon) / 2), 2)));
    }
}

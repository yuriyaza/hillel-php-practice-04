<?php

namespace App\PlacesSearch;

class CalculateDistance implements CalculateDistanceInterface
{
    public function calculate($startLat, $startLon, $finishLat, $finishLon)
    {
        $distance = 2 * asin(sqrt(pow(sin(($startLat - $finishLat) / 2), 2) + cos($startLat) * cos($finishLat) * pow(sin(($startLon - $finishLon) / 2), 2)));
        return $distance;
    }
}

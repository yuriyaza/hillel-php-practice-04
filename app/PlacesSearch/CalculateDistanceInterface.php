<?php

namespace App\PlacesSearch;

interface CalculateDistanceInterface
{
    public function calculate($startLat, $startLon, $finishLat, $finishLon);
}

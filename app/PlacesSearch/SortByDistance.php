<?php

namespace App\PlacesSearch;

class SortByDistance implements SortByDistanceInterface
{
    public function sort($places)
    {
        usort($places, function ($a, $b) {
            return ($a->distance < $b->distance) ? -1 : 1;
        });

        return $places;
    }
}

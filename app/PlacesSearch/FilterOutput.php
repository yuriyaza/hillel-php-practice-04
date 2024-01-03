<?php

namespace App\PlacesSearch;

class FilterOutput implements FilterOutputInterface
{
    public function filter($places, $properties)
    {
        foreach ($places as $key => $place) {
            foreach ($place as $prop => $val) {
                if (!in_array($prop, $properties)) {
                    unset($place->$prop);
                }
            }
            $places[$place->place_id] = $place;
            unset($places[$key]);
        }

        return $places;
    }
}

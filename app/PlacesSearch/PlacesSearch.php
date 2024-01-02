<?php

namespace App\PlacesSearch;

class PlacesSearch implements PlacesSearchInterface
{
    protected $apiService;
    protected $calculateDistanceService;

    protected $search;
    protected $exclude_place_ids;
    protected $properties = ['place_id', 'name', 'display_name', 'distance'];

    public function __construct($apiService, $calculateDistanceService)
    {
        $this->apiService = $apiService;
        $this->calculateDistanceService = $calculateDistanceService;
    }

    public function setSearch($search)
    {
        $this->search = $search;
        return $this;
    }

    public function setExcludePlaceIds($exclude_place_ids)
    {
        $this->exclude_place_ids = $exclude_place_ids;
        return $this;
    }

    public function execute()
    {
        $places = $this->apiService->setSearch($this->search)->setExcludePlaceIds($this->exclude_place_ids)->execute();

        //distance calculation
        foreach ($places as $place) {
            $res = $this->calculateDistanceService->calculateDistance($place);
            $place->distance = $res;
        }

        // sort by distance
        usort($places, function ($a, $b) {
            return ($a->distance < $b->distance) ? -1 : 1;
        });

        //filter output array and add keys by place_id
        foreach ($places as $key => $place) {
            foreach ($place as $prop => $val) {
                if (!in_array($prop, $this->properties)) {
                    unset($place->$prop);
                }
            }
            $places[$place->place_id] = $place;
            unset($places[$key]);
        }

        return $places;
    }
}

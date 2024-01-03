<?php

namespace App\PlacesSearch;

class PlacesSearch implements PlacesSearchInterface
{
    protected $apiService;
    protected $calculateDistance;
    protected $sortByDistance;
    protected $filterOutput;

    protected $search;
    protected $excludePlaces = [];
    protected $properties = ['place_id', 'name', 'display_name', 'distance'];

    public function __construct($apiService, $calculateDistance, $sortByDistance, $filterOutput)
    {
        $this->apiService = $apiService;
        $this->calculateDistance = $calculateDistance;
        $this->sortByDistance = $sortByDistance;
        $this->filterOutput = $filterOutput;
    }

    public function setSearch($search)
    {
        $this->search = $search;
        return $this;
    }

    public function setExcludePlaces($excludePlaces)
    {
        $this->excludePlaces = $excludePlaces;
        return $this;
    }

    public function execute()
    {
        // api call and data fetch
        $places = $this->apiService->setSearch($this->search)->setExcludePlaces($this->excludePlaces)->execute();

        //distance calculation
        foreach ($places as $place) {
            $place->distance = $this->calculateDistance->calculate($place);
        }

        // sort by distance
        $places = $this->sortByDistance->sort($places);

        //filter output array and add keys by place_id
        $places = $this->filterOutput->filter($places, $this->properties);

        return $places;
    }
}

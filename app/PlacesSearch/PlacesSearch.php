<?php

namespace App\PlacesSearch;

class PlacesSearch implements PlacesSearchInterface
{
    protected $apiService;
    protected $calculateDistance;
    protected $sortOutput;
    protected $filterOutput;

    protected $searchString;
    protected $initCoordinates;
    protected $filterCriteria;
    protected $sortByCriteria;
    protected $excludePlaces = [];

    public function __construct($apiService, $calculateDistance, $sortOutput, $filterOutput)
    {
        $this->apiService = $apiService;
        $this->calculateDistance = $calculateDistance;
        $this->sortOutput = $sortOutput;
        $this->filterOutput = $filterOutput;
    }

    public function setSearchString($searchString)
    {
        $this->searchString = $searchString;
        return $this;
    }

    public function setInitCoordinates($initCoordinates)
    {
        $this->initCoordinates = $initCoordinates;
        return $this;
    }

    public function setFilterCriteria($filterCriteria)
    {
        $this->filterCriteria = $filterCriteria;
        return $this;
    }

    public function setSortByCriteria($sortByCriteria)
    {
        $this->sortByCriteria = $sortByCriteria;
        return $this;
    }

    public function execute()
    {
        // api call and data fetch
        $places = $this->apiService->setSearch($this->searchString)->setExcludePlaces($this->excludePlaces)->execute();

        //distance calculation
        foreach ($places as $place) {
            $place->distance = $this->calculateDistance->calculate($this->initCoordinates->lat, $this->initCoordinates->lon, $place->lat, $place->lon);
        }

        // sort by distance
        $places = $this->sortOutput->sort($places, $this->sortByCriteria);

        //filter output array and add keys by place_id
        foreach ($places as $key => $place) {
            $place = $this->filterOutput->filter($place, $this->filterCriteria);

            $places[$place->place_id] = $place;
            unset($places[$key]);
        }

        $this->excludePlaces += $places;
        return $places;
    }
}

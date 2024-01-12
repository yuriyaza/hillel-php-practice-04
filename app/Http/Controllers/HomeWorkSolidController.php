<?php

namespace App\Http\Controllers;

use App\PlacesSearch\PlacesSearchInterface;

class HomeWorkSolidController extends Controller
{
    public function index(PlacesSearchInterface $placesSearch)
    {
        $searchString = 'Продукти Одеса';
        $filterCriteria = ['place_id', 'name', 'display_name', 'distance'];
        $sortByCriteria = 'distance';

        // init coordinates
        $initCoordinates = (object)[
            'lat' => 46.4774700,
            'lon' => 30.7326200
        ];

        // first search
        $places = $placesSearch->setSearchString($searchString)->setInitCoordinates($initCoordinates)->
        setFilterCriteria($filterCriteria)->setSortByCriteria($sortByCriteria)->execute();
        dump($places);

        // new search without previous places
        // search can be repeated 2, 3, ... n times
        $places = $placesSearch->execute();
        dump($places);
    }
}

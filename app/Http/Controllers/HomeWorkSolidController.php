<?php

namespace App\Http\Controllers;

use App\PlacesSearch\ApiService;
use App\PlacesSearch\CalculateDistance;
use App\PlacesSearch\FilterOutput;
use App\PlacesSearch\PlacesSearch;
use App\PlacesSearch\SortOutput;
use GuzzleHttp\Client as GuzzleClient;

class HomeWorkSolidController extends Controller
{
    public function index()
    {
        $url = 'https://nominatim.openstreetmap.org/search.php?format=jsonv2&q=';
        $searchString = 'Продукти Одеса';
        $filterCriteria = ['place_id', 'name', 'display_name', 'distance'];
        $sortByCriteria = 'distance';

        // init coordinates
        $initCoordinates = (object)[
            'lat' => 46.4774700,
            'lon' => 30.7326200
        ];

        $guzzleClient = new GuzzleClient();
        $apiService = new ApiService($guzzleClient, $url);

        $calculateDistance = new CalculateDistance();
        $sortOutput = new SortOutput();
        $filterOutput = new FilterOutput();

        $placesSearch = new PlacesSearch($apiService, $calculateDistance, $sortOutput, $filterOutput);

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

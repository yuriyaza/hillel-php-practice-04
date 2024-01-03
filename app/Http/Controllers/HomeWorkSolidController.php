<?php

namespace App\Http\Controllers;

use App\PlacesSearch\ApiService;
use App\PlacesSearch\CalculateDistance;
use App\PlacesSearch\FilterOutput;
use App\PlacesSearch\PlacesSearch;
use App\PlacesSearch\SortByDistance;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Request;

class HomeWorkSolidController extends Controller
{
    public function index(Request $request)
    {
        $url = 'https://nominatim.openstreetmap.org/search.php?format=jsonv2&q=';
        $search = 'Продукти Одеса';
        $excludePlaces = [];

        // init coordinates
        $initLat = 46.4774700;
        $initLon = 30.7326200;

        $guzzleClient = new GuzzleClient();
        $apiService = new ApiService($guzzleClient, $url);

        $calculateDistance = new CalculateDistance($initLat, $initLon);
        $sortByDistance = new SortByDistance();
        $filterOutput = new FilterOutput();

        $placesSearch = new PlacesSearch($apiService, $calculateDistance, $sortByDistance, $filterOutput);

        // first search
        $places = $placesSearch->setSearch($search)->setExcludePlaces($excludePlaces)->execute();
        dump($places);

        // new search without previous places
        // search can be repeated 2, 3, ... n times
        $excludePlaces += $places;
        $places = $placesSearch->setSearch($search)->setExcludePlaces($excludePlaces)->execute();
        dump($places);
    }
}

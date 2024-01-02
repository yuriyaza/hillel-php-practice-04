<?php

namespace App\Http\Controllers;

use App\PlacesSearch\ApiService;
use App\PlacesSearch\CalculateDistanceService;
use App\PlacesSearch\PlacesSearch;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Request;

class HomeWorkSolidController extends Controller
{
    public function index(Request $request)
    {
        $url = 'https://nominatim.openstreetmap.org/search.php?format=jsonv2&q=';
        $search = 'Продукти Одеса';
        $exclude_place_ids = '';

        // init coordinates
        $initLat = 46.4774700;
        $initLon = 30.7326200;

        $guzzleClient = new GuzzleClient();
        $apiService = new ApiService($guzzleClient, $url);
        $calculateDistanceService = new CalculateDistanceService($initLat, $initLon);

        $placesSearch = new PlacesSearch($apiService, $calculateDistanceService);

        start:

        $places = $placesSearch->setSearch($search)->setExcludePlaceIds($exclude_place_ids)->execute();

        // for exit
        if ($exclude_place_ids) {
            dd($places);
        }

        $exclude_place_ids = '&exclude_place_ids=' . urlencode(implode(',', array_keys($places)));
        dump($places);

        // for new search without this places
        goto start;
    }
}

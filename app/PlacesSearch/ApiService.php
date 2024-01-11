<?php

namespace App\PlacesSearch;

use GuzzleHttp\ClientInterface as GuzzleClientInterface;


class ApiService implements ApiServiceInterface
{
    protected $url = 'https://nominatim.openstreetmap.org/search.php?format=jsonv2&q=';
    protected $guzzleClient;

    protected $search;
    protected $exclude_place_ids = '';

    public function __construct(GuzzleClientInterface $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    public function setSearch($search)
    {
        $this->search = $search;
        return $this;
    }

    public function setExcludePlaces($excludePlaces)
    {
        if (count($excludePlaces) > 0) {
            $this->exclude_place_ids = '&exclude_place_ids=' . urlencode(implode(',', array_keys($excludePlaces)));
        }
        return $this;
    }

    public function execute()
    {
        $response = $this->guzzleClient->request('GET', $this->url . urlencode($this->search) . $this->exclude_place_ids);
        $places = json_decode($response->getBody()->getContents());
        return $places;
    }
}

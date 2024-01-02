<?php

namespace App\PlacesSearch;

class ApiService implements ApiServiceInterface
{
    protected $guzzleClient;
    protected $url;

    protected $search;
    protected $exclude_place_ids;

    public function __construct($guzzleClient, $url)
    {
        $this->guzzleClient = $guzzleClient;
        $this->url = $url;
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
        // start parse api
        $response = $this->guzzleClient->request('GET', $this->url . urlencode($this->search) . $this->exclude_place_ids);
        $places = json_decode($response->getBody()->getContents());
        return $places;
    }
}

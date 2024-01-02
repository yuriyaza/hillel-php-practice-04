<?php

namespace App\PlacesSearch;

interface ApiServiceInterface
{
    public function setSearch($search);
    public function setExcludePlaceIds($exclude_place_ids);
    public function execute();
}

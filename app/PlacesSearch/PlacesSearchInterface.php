<?php

namespace App\PlacesSearch;

interface PlacesSearchInterface
{
    public function setSearch($search);
    public function setExcludePlaceIds($exclude_place_ids);
    public function execute();
}

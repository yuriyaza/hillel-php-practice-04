<?php

namespace App\PlacesSearch;

interface PlacesSearchInterface
{
    public function setSearch($search);
    public function setExcludePlaces($excludePlaces);
    public function execute();
}

<?php

namespace App\PlacesSearch;

interface ApiServiceInterface
{
    public function setSearch($search);
    public function setExcludePlaces($excludePlaces);
    public function execute();
}

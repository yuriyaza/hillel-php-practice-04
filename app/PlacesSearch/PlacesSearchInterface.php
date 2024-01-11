<?php

namespace App\PlacesSearch;

interface PlacesSearchInterface
{
    public function setSearchString($searchString);
    public function setInitCoordinates($initCoordinates);
    public function setFilterCriteria($filterCriteria);
    public function setSortByCriteria($sortByCriteria);
    public function execute();
}

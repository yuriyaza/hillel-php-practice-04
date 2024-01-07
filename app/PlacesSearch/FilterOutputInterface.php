<?php

namespace App\PlacesSearch;

interface FilterOutputInterface
{
    public function filter($object, $filterCriteria);
}

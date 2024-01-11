<?php

namespace App\PlacesSearch;

class SortOutput implements SortOutputInterface
{
    public function sort($object, $sortByCriteria)
    {
        usort($object, function ($a, $b) use ($sortByCriteria) {
            return ($a->{$sortByCriteria} > $b->{$sortByCriteria}) ? 1 : -1;
        });

        return $object;
    }
}

<?php

namespace App\PlacesSearch;

class FilterOutput implements FilterOutputInterface
{
    public function filter($object, $filterCriteria)
    {
        foreach ($object as $name => $value) {
            if (!in_array($name, $filterCriteria)) {
                unset($object->$name);
            }
        }
        return $object;
    }
}

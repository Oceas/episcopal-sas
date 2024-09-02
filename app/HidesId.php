<?php

namespace App;

trait HidesId
{
    public function toArray()
    {
        $array = parent::toArray(); // Get the default array representation

        unset($array['id']); // Remove the 'id' field

        return $array;
    }
}

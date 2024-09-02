<?php

namespace App;

use Illuminate\Support\Str;

trait HidesId
{
    public function toArray()
    {
        $array = parent::toArray(); // Get the default array representation

        unset($array['deleted_at']); // Remove the 'id' field
        unset($array['updated_at']);
        unset($array['public']);
        unset($array['reported']);

        return $array;
    }

}

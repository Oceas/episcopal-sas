<?php

namespace App;

use Illuminate\Support\Str;

trait HidesId
{

    //@TODO update for prayer only fields

    public function toArray()
    {
        $array = parent::toArray(); // Get the default array representation

        unset($array['deleted_at']); // Remove the 'id' field
        unset($array['updated_at']);
        unset($array['public']);
        unset($array['reported']);
        unset($array['reported_reason']);
        unset($array['reported_text']);
        unset($array['id']);

        return $array;
    }

}

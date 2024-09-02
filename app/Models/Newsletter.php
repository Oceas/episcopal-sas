<?php

namespace App\Models;

use App\HidesId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Newsletter extends Model
{
    use HasFactory, HidesId;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'source',
    ];

}

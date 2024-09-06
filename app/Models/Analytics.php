<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'platform',
        'vid',
        'event_name',
        'event_details',
        'payload',
        'app_version',
        'reference_url'
    ];
}

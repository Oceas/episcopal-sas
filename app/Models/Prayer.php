<?php

namespace App\Models;

use App\HidesId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prayer extends Model
{
    use HasFactory, HidesId, SoftDeletes;
}

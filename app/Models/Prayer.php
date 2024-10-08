<?php

namespace App\Models;

use App\HidesId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prayer extends Model
{
    use HasFactory, HidesId, SoftDeletes;

    protected $fillable = [
        'name',
        'request',
        'public',
        'uuid',
        'created_at'
    ];

    protected static function booted()
    {
        static::saving(function ($prayer) {
            if (empty($prayer->name)) {
                $prayer->name = 'Anonymous';
            }
        });
    }

    public function prayed_for()
    {
        $this->prayed_for = $this->prayed_for + 1;
        $this->save();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickDrop extends Model
{
    use HasFactory;

    
    public function pickRider()
    {
        return $this->belongsTo(Rider::class, 'pick_rider');
    }

    public function dropRider()
    {
        return $this->belongsTo(Rider::class, 'drop_rider');
    }
}

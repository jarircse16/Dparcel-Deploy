<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Rider extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'rider_name',
        'mobile',
        'email',
        'address',
        'username',
        'password',
        
    ]; 

    public $timestamps = false;

    public function pendingPickups()
    {
        return $this->hasMany(PendingPickup::class);
    }

    public function pendingDrops()
    {
        return $this->hasMany(PendingDrop::class);
    }

    public function completedPickups()
    {
        return $this->hasMany(CompletedPickup::class);
    }

    public function completedDrops()
    {
        return $this->hasMany(CompletedDrop::class);
    }
}
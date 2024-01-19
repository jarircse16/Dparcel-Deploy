<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedPickup extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id',
        'item_name',
        'qty',
        'recipient_name',
        'recipient_number',
        'total_price',
        // Add other attributes as needed
    ];
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $table = 'deliveries';
    protected $fillable = [
        'qty',
        'item_price',
        'delivery_charge',
        'delivery_time',
        'recipient_name',
        'recipient_number',
        'recipient_address',
        'vendor_id',
        'pick_rider',
    ];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    // how to get the pick rider name
    public function pickRider()
    {
        return $this->belongsTo(Rider::class, 'pick_rider');
    }

    public function dropRider()
    {
        return $this->belongsTo(Rider::class, 'drop_rider');
    }

}

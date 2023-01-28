<?php

namespace Modules\Parcels\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Bikers\Entities\Biker;
use Modules\Senders\Entities\Sender;

class ParcelPickupDetail extends Model
{
    protected $table = 'parcels_pickup_details';
    protected $fillable = [
        'parcel_id',
        'biker_id',
        'pick_up_at',
        'delivered_at',
    ];

    public function biker()
    {
        return $this->belongsTo(Biker::class);
    }

    public function parcel()
    {
        return $this->hasOne(Parcel::class);
    }

}

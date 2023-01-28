<?php

namespace Modules\Parcels\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Parcels\Database\factories\ParcelFactory;
use Modules\Senders\Entities\Sender;

class Parcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pick_up_address',
        'drop_off_address',
        'sender_id',
        'status',
        'details',
        'notes'
    ];

    public function sender()
    {
        return $this->belongsTo(Sender::class);
    }

    public function pickupDetails()
    {
        return $this->hasOne(ParcelPickupDetail::class, 'parcel_id');
    }

    protected static function newFactory()
    {
        return ParcelFactory::new();
    }
}

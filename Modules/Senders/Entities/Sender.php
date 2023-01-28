<?php

namespace Modules\Senders\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Senders\Database\factories\SenderFactory;

class Sender extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['name'];

    protected static function newFactory()
    {
        return SenderFactory::new();
    }
}

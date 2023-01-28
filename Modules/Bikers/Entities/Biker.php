<?php

namespace Modules\Bikers\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Bikers\Database\factories\BikerFactory;

class Biker extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['name'];

    protected static function newFactory()
    {
        return BikerFactory::new();
    }
}

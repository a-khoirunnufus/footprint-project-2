<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'buy_price',
        'sell_price',
        'quantity',
        'sold',
        'available',
    ];
}

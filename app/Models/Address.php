<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'city',
        'country_id',
        'line_one',
        'street'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['order_id', 'name', 'address', 'city', 'country'];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}

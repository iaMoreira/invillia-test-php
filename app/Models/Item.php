<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['order_id', 'note', 'quantity', 'price'];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['person_id'];

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function address() {
        return $this->hasOne(Address::class);
    }
}

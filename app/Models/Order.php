<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['person_id'];

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function addresses() {
        return $this->hasMany(Address::class);
    }
}

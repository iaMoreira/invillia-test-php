<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = ['name'];

    public function phones() {
        return $this->hasMany(Phone::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    public function sales(){
        return $this->hasMany(Sale::class);
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
}

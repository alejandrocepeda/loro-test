<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'first_name',
        'last_name',
        'identification',
        'state_id',
        'city_id',
        'phone',
        'mail',
        'winner',
        'notification_success',
        'habeas_data'
    ];

    public function state()
    {
        return $this->hasOne('App\State','id','state_id'); 
    }

    public function city()
    {
        return $this->hasOne('App\City','id','city_id'); 
    }

}

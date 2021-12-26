<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class DeliveryAddress extends Model
{
    use HasFactory;

    public static function deliveryAddresses(){
    	if (Auth::check()) {
    		$user_id = Auth::user()->id;
    		$deliveryAddresses = DeliveryAddress::where('user_id', $user_id)->get()->toArray();
    		return $deliveryAddresses;
    	}
    }
}

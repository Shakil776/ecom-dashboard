<?php
use App\Cart;

// show total cart product
function totalCartItems(){
	if (Auth::check()) {
		$user_id = Auth::user()->id;
		$cartItems = Cart::where(['user_id'=>$user_id])->sum('quantity');
	}else{
		$session_id = Session::get('session_id');
		$cartItems = Cart::where(['session_id'=>$session_id])->sum('quantity');
	}
	return $cartItems;
}
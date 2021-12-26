<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use App\DeliveryAddress;
use Session;
use Auth;

class DeliveryAddressController extends Controller
{
    public function checkout(){
    	$cartItems = Cart::cartItems();
    	$deliveryAddresses = DeliveryAddress::deliveryAddresses();
    	return view('layouts.front_layouts.checkout.checkout')->with(compact('cartItems', 'deliveryAddresses'));
    }

    public function addEditDelveryArress(Request $request, $id=null){
    	if($id == ""){
            // add delivery address 
            $title = "Add Delivery Address";
            $address = new DeliveryAddress;
            $message = "Delivery Address Added Successfully.";
        }else{
            // edit delivery address 
            $title = "Edit Delivery Address";
            $address = DeliveryAddress::find($id);
            $message = "Delivery Address Updated Successfully."; 
        }

        if($request->isMethod('post')){
            $data = $request->all();
            
            Session::forget('error_message');
            Session::forget('success_message');
            
            // validaion
			$rules = [
				'name' => 'required|regex:/^[\pL\s\-]+$/u',
				'mobile' => 'required',
				'address' => 'required',
			];

			$customMessages = [
				'name.required' => 'Name must not be empty!',
				'name.regex' => 'Valid name is required.',
				'mobile.required' => 'Mobile must not be empty.',
				'address.required' => 'Address must not be empty.',
			];

			$this->validate($request, $rules, $customMessages);
            
            $address->user_id = Auth::user()->id;
            $address->name = $data['name'];
            $address->mobile = $data['mobile'];
            $address->address = $data['address'];
            $address->city = $data['city'];
            $address->state = $data['state'];
            $address->country = $data['country'];
            $address->pincode = $data['pincode'];
            $address->status = 1;
            $address->save();
            
            Session::flash('success_message', $message);
            return redirect('/checkout');
        }

        return view('layouts.front_layouts.checkout.delivery_address')->with(compact('title', 'address'));
    }

    // delete delivery address
    public function deleteDeliveryAddress($id){
        // delete delivery address
        DeliveryAddress::where('id', $id)->delete();
        Session::flash('success_message', 'Delivery Address Delete Successfully.');
        return redirect()->back();
    }
}

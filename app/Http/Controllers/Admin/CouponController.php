<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Coupon;
use App\Section;
use App\User;
use Session;

class CouponController extends Controller
{
    // show coupons
    public function coupons(){
        $coupons = Coupon::get()->toArray();
        /*dd($coupons); die;*/
        return view('layouts.admin_layouts.coupons.coupons')->with(compact('coupons'));
    }

    // change coupons status
    public function changeCouponStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Coupon::where('id', $data['coupon_id'])->update(['status'=>$status]);
            return response()->json([
                'status' => $status,
                'coupon_id' => $data['coupon_id']
            ]);
        }
    }

    // add-edit coupon
    public function addEditCoupon(Request $request, $id = null){
        
        if($id == ""){
            // add coupon 
            $title = "Add Coupon";
            $coupon = new Coupon;
            $selCategories = [];
            $selUsers = [];
            $message = "Coupon Added Successfully.";
        }else{
            // edit coupon
            $title = "Edit Coupon";
            $coupon = Coupon::find($id);
            $selCategories = explode(',', $coupon['categories']);
            $selUsers = explode(',', $coupon['users']);
            $message = "Coupon Updated Successfully."; 
        }

        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            // validaion
      			$rules = [
                      'categories' => 'required',
                      'coupon_option' => 'required',
                      'coupon_type' => 'required',
                      'amount_type' => 'required',
                      'amount' => 'required|numeric',
                      'expiry_date' => 'required',
      			];

      			$customMessages = [
      				'categories.required' => 'Select Category.',
              'coupon_option.required' => 'Select Coupon Option.',
              'coupon_type.required' => 'Select Coupon Type.',
              'amount_type.required' => 'Select Amount Type.',
              'amount.required' => 'Select Amount.',
              'amount.numeric' => 'Select Valid Amount.',
              'expiry_date.required' => 'Enter Expiry Date.'
      			];
            $this->validate($request, $rules, $customMessages);
           // convert categories array to string
           if (isset($data['categories'])) {
           	$categories = implode(',', $data['categories']);
           }
           // convert users array to string
           if (isset($data['users'])) {
           	$users = implode(',', $data['users']);
           }else{
           	$users = "";
           }
           // check coupon code
           if ($data['coupon_option'] == "Automatic") {
           	$coupon_code = Str::random(8);
           }else{
           	$coupon_code = $data['coupon_code'];
           }
           // save into database
           $coupon->coupon_option = $data['coupon_option'];
           $coupon->coupon_code = $coupon_code;
           $coupon->coupon_type = $data['coupon_type'];
           $coupon->amount_type = $data['amount_type'];
           $coupon->amount = $data['amount'];
           $coupon->categories = $categories;
           $coupon->users = $users;
           $coupon->expiry_date = $data['expiry_date'];
           $coupon->status = 1;
           $coupon->save();
           Session::flash('success_message', $message);
            return redirect('/admin/coupons');
        }


        // get all categories
        $categories = Section::with('categories')->get()->toArray();
        // get all users
        $users = User::select('email')->where('status', 1)->get()->toArray();
        
        return view('layouts.admin_layouts.coupons.add_edit_coupons')->with(compact('title', 'coupon', 'categories', 'users', 'selCategories', 'selUsers'));
    }

    // delete coupon
    public function deleteCoupon($id){
        // delete coupon
        Coupon::where('id', $id)->delete();
        Session::flash('success_message', 'Coupon Deleted Successfully.');
        return redirect()->back();
    }

}

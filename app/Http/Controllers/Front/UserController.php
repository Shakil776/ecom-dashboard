<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Cart;
use App\Sms;
use App\Country;
use Session;
use Auth;

class UserController extends Controller
{
    // login register form
    public function loginRegister(){
        return view('layouts.front_layouts.users.login_register');
    }

    // register user
    public function registerUser(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // check if user already exists
            $userCount = User::where('email', $data['email'])->count();
            if($userCount > 0){
                $message = "Email Address already Exists.";
                Session::flash('error_message', $message);
                return redirect()->back();
            }else{
                // insert user
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->mobile = $data['mobile'];
                $user->password = Hash::make($data['password']);
                $user->save();

                if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
                    // update user cart with user id
                    if(!empty(Session::get('session_id'))){
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id', $session_id)->update(['user_id'=>$user_id]);
                    }
                    // send sms after successfully register
                    $smsMessage = "Dear customer, You have successfully registered with E-Commerse Website. Login to your account to access orders and available offers. Thank You";
                    $mobile = $data['mobile'];
                    Sms::sendSms($smsMessage, $mobile);
                    return redirect('/');
                }
            }
        }
    }

    // Check email address exists or not
    public function checkEmail(Request $request){
        // check email exists or not
        $data = $request->all();
        $countEmail = User::where('email', $data['email'])->count();
        if($countEmail > 0){
            return "false";
        }else{
            return "true";
        }
    }

    // login user
    public function loginUser(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){
                // update user cart with user id
                if(!empty(Session::get('session_id'))){
                    $user_id = Auth::user()->id;
                    $session_id = Session::get('session_id');
                    Cart::where('session_id', $session_id)->update(['user_id'=>$user_id]);
                }
                return redirect('/');
            }else{
                $message = "Invalid Email or Password";
                Session::flash('error_message', $message);
                return redirect()->back();
            }
        }
    }

    // user logout
    public function logoutUser(){
        Auth::logout();
        return redirect('/');
    }

    // user account
    public function account(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id)->toArray();

        // get all country
        // $countries = Country::where('status', 1)->get()->toArray();

        if($request->isMethod('post')){
            $data = $request->all();
            
            Session::forget('error_message');
            Session::forget('success_message');
            
            // validaion
			$rules = [
				'name' => 'required',
				'mobile' => 'required',
			];

			$customMessages = [
				'name.required' => 'Name must not be empty!',
				'mobile.required' => 'Mobile must not be empty.'
			];

			$this->validate($request, $rules, $customMessages);
            
            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->mobile = $data['mobile'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->save();
            $message = "Your account details has been updated successfully.";
            Session::flash('success_message', $message);
            return redirect()->back();
        }
        return view('layouts.front_layouts.users.account')->with(compact('userDetails'));
    }

}

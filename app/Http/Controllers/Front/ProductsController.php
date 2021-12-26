<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Category;
use App\Product;
use App\ProductAttribute;
use App\Coupon;
use App\Cart;
use App\User;
use View;
use Session;

class ProductsController extends Controller
{
    //listing page
    public function listing(Request $request){
      Paginator::useBootstrap();
      if ($request->ajax()) {
          $data = $request->all();
          /*echo "<pre>"; print_r($data); die;*/
          $url = $data['url'];
          $categoryCount = Category::where(['category_url'=>$url, 'status'=>1])->count();
          if ($categoryCount > 0) {
              $categoryDetails = Category::catDetails($url);
              $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catsId'])->where('status', 1);
                                  
                // if fabric option is selected
                if (isset($data['fabric']) && !empty($data['fabric'])) {
                  $categoryProducts->whereIn('products.product_fabric', $data['fabric']);
                }
                // if pattern option is selected
                if (isset($data['pattern']) && !empty($data['pattern'])) {
                  $categoryProducts->whereIn('products.product_pattern', $data['pattern']);
                }
                // if sleeve option is selected
                if (isset($data['sleeve']) && !empty($data['sleeve'])) {
                  $categoryProducts->whereIn('products.product_sleeve', $data['sleeve']);
                }
                // if fit option is selected
                if (isset($data['fit']) && !empty($data['fit'])) {
                  $categoryProducts->whereIn('products.product_fit', $data['fit']);
                }

                // if sort option is selected
                if (isset($data['sort']) && !empty($data['sort'])) {
                    if ($data['sort'] == 'latest_product') {
                        $categoryProducts->orderBy('id', 'DESC');
                    }elseif ($data['sort'] == 'product_name_a_z') {
                        $categoryProducts->orderBy('product_name', 'ASC');
                    }elseif ($data['sort'] == 'product_name_z_a') {
                        $categoryProducts->orderBy('product_name', 'DESC');
                    }elseif ($data['sort'] == 'price_lowest') {
                        $categoryProducts->orderBy('product_price', 'ASC');
                    }elseif ($data['sort'] == 'price_highest') {
                        $categoryProducts->orderBy('product_price', 'DESC');
                    }
                }else{
                  $categoryProducts->inRandomOrder();
                }

                $categoryProducts = $categoryProducts->paginate(3);

              return view('layouts.front_layouts.products.ajax_products_listing_page')->with(compact('categoryDetails', 'categoryProducts', 'url'));
          }else{
              abort(404);
          }

      } else {
          $url = Route::getFacadeRoot()->current()->uri();
          $categoryCount = Category::where(['category_url'=>$url, 'status'=>1])->count();
          if ($categoryCount > 0) {
              $categoryDetails = Category::catDetails($url);
              $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catsId'])->where('status', 1);   
              $categoryProducts->inRandomOrder();
              $categoryProducts = $categoryProducts->paginate(3);

              // product filters
              $productFilters = Product::productFilters();
              $fabricArray = $productFilters['fabricArray'];
              $patternArray = $productFilters['patternArray'];
              $sleeveArray = $productFilters['sleeveArray'];
              $fitArray = $productFilters['fitArray'];
              $page_name = "listing";

              return view('layouts.front_layouts.products.listing_page')->with(compact('categoryDetails', 'categoryProducts', 'url', 'fabricArray', 'patternArray', 'sleeveArray', 'fitArray', 'page_name'));
          }else{
              abort(404);
          }
      }	
    }

    // product details
    public function productDetails($id){
      $productDetails = Product::with(['category', 'brand', 'attributes'=>function($query){$query->where('status', 1);}, 'images'])->find($id)->toArray();
      /*dd($productDetails);*/
      // total stock
      $totalStock = ProductAttribute::where(['product_id'=> $id, 'status'=>1])->sum('stock');
      // related products
      $relatedProducts = Product::where('category_id', $productDetails['category']['id'])->where('id','!=', $id)->limit(6)->inRandomOrder()->get()->toArray();
      return view('layouts.front_layouts.products.product_details')->with(compact('productDetails', 'totalStock', 'relatedProducts'));
    }

    // get product price
    public function getPrice(Request $request){
      if ($request->ajax()) {
        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/
        /*$getProductPrice = ProductAttribute::where(['product_id'=>$data['product_id'], 'size'=>$data['size']])->first();*/
        $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($data['product_id'], $data['size']);
        
        return $getDiscountedAttrPrice;
      }
    }

    // apply coupon
    public function applyCoupon(Request $request){
      if ($request->ajax()) {
        $data = $request->all();
        // echo "<pre>";
        // print_r($data); die;
        $cartItems = Cart::cartItems();
        $couponCount = Coupon::where('coupon_code', $data['code'])->count();
        if ($couponCount == 0) {
          $cartItems = Cart::cartItems();
          $totalCartItems = totalCartItems();
          return response()->json([
              'status'=>false,
              'message'=>'The coupon is not valid.',
              'totalCartItems'=>$totalCartItems,
              'view'=>(String)View::make('layouts.front_layouts.cart.show_cart_items')->with(compact('cartItems'))
          ]);
        }else{
          // check for others coupon condition
          // get coupon details
          $couponDetails = Coupon::where('coupon_code', $data['code'])->first();
          // check coupon is inactive
          if ($couponDetails->status == 0) {
            $message = "This coupon is not active.";
          }
          // check coupon is expired
          $expiry_date = $couponDetails->expiry_date;
          $current_date = date('Y-m-d');
          if ($expiry_date < $current_date) {
            $message = "This coupon is expired.";
          }
          // check if coupon is from selected categoris
          // get all selected categories from coupon 
          $cartArr = explode(',', $couponDetails->categories);
          // get cart items 
          $cartItems = Cart::cartItems();

          // checked if coupon belongs to loggin user
          // get all selected users for coupon
          if (!empty($couponDetails->users)) {
            $usersArr = explode(',', $couponDetails->users);
            // get users id's for all selected users
            foreach ($usersArr as $key => $user) {
              $getUserId = User::select('id')->where('email', $user)->first()->toArray();
              $userId[] = $getUserId['id'];
            }
          }
          
          // get cart total amount
          $total_amount = 0;
          // check coupon for user
          foreach ($cartItems as $key => $item) {
            // check if any item belong to coupon category
            if (!in_array($item['product']['category_id'], $cartArr)) {
              $message = "This coupon code is not one of the selected product.";
            }

            if (!empty($couponDetails->users)) {
              if (!in_array($item['user_id'], $userId)) {
                $message = "This coupon code is not for you.";
              }
            }
            // get attrprice
            $attrPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']);
            $total_amount = $total_amount + ($attrPrice['final_price'] * $item['quantity']);
          }


          if (isset($message)) {
            $cartItems = Cart::cartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'status'=>false,
                'message'=> $message,
                'totalCartItems'=>$totalCartItems,
                'view'=>(String)View::make('layouts.front_layouts.cart.show_cart_items')->with(compact('cartItems'))
            ]);
          }else{
            // checked if  amount type is fixed or percentage
            if ($couponDetails->amount_type == 'Fixed') {
              $couponAmount = $couponDetails->amount;
            }else{
              $couponAmount = $total_amount * ($couponDetails->amount / 100);
            }
            // grand total
            $grandTotal = $total_amount - $couponAmount;

            // add coupon amount and code in session variable
            Session::put('couponAmount', $couponAmount);
            Session::put('couponCode', $data['code']);

            $cartItems = Cart::cartItems();
            $totalCartItems = totalCartItems();
            $message = "Coupon code apply successfully. You are availing discount.";

            return response()->json([
                'status'=>true,
                'message'=> $message,
                'totalCartItems'=>$totalCartItems,
                'couponAmount'=>$couponAmount,
                'grandTotal'=>$grandTotal,
                'view'=>(String)View::make('layouts.front_layouts.cart.show_cart_items')->with(compact('cartItems'))
            ]);
          }
        }
      }
    }
}

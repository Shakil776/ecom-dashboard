@php
use App\Product;
@endphp
@extends('layouts.front_layouts.master')

@section('title', 'Checkout')

@section('main-content')

<div class="span9">
  @if(Session::has('success_message'))
    <div class="alert alert-success">
    <strong>Weldone!</strong>  {{ Session::get('success_message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
  @endif
  @if(Session::has('error_message'))
      <div class="alert alert-danger">
      <strong>Oppps!</strong>  {{ Session::get('error_message') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
  @endif
  <ul class="breadcrumb">
    <li><a href="{{ url('/') }}">Home</a> <span class="divider">/</span></li>
    <li class="active"> CHECKOUT</li>
  </ul>
  <h3>CHECKOUT [ <small><span class="totalCartITems">{{ totalCartItems() }}</span> Item(s) </small>]<a href="{{ url('/cart') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Back to Cart </a></h3>  
  <hr class="soft"/>  

  <table class="table table-bordered">
    <tr>
      <th colspan="2"> DELIVERY ADDRESSES <span style="float: right;"><a class="btn btn-primary" href="{{ url('add-edit-delivery-address') }}">Add Delivery Address</a></span></th>
    </tr>
    @foreach($deliveryAddresses as $address)
      <tr> 
        <td width="80%">
          <div class="control-group" style="float: left; margin-top: -2px; margin-right: 5px;">
            <input type="radio" id="address{{ $address['id'] }}" name="address_id" value="{{ $address['id'] }}">
          </div>
          <div class="control-group">
            <label class="control-label">{{ $address['name'] }}, {{ $address['address'] }}, {{ $address['city'] }} ({{ $address['pincode'] }}), {{ $address['state'] }}, {{ $address['country'] }}, Mobile: {{ $address['mobile'] }}</label>
          </div>
        </td>
        <td width="20%">
          <a class="btn btn-info" href="{{ url('add-edit-delivery-address/'.$address['id']) }}" title="Edit">Edit</a>&nbsp;&nbsp;
          <a class="btn btn-danger deliveryAddressDelete" href="{{ url('delete-delivery-address/'.$address['id']) }}" title="Delete">Delete</a>
        </td>
      </tr>
    @endforeach
  </table>
      
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Product</th>
        <th>Description</th>
        <th>Code</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Discount</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @php $sum = 0; @endphp
      @foreach($cartItems as $item)
        @php $productPrice = Product::getDiscountedAttrPrice($item['product_id'], $item['size']); @endphp
      <tr>

        <td>
          @if(isset($item['product']['product_main_image']))
            @php $product_image_path = "images/product_images/small/".$item['product']['product_main_image']; @endphp
          @else
            @php $product_image_path = ''; @endphp
          @endif

          @if(!empty($item['product']['product_main_image']) && file_exists($product_image_path))
            <img width="60" src="{{ asset('images/product_images/small/'.$item['product']['product_main_image']) }}" alt="Product Image">
            @else
            <img width="60" src="{{ asset('images/product_images/small/no-image.png') }}" alt="Product Image">
          @endif 
        </td>
        <td>
          {{ $item['product']['product_name'] }}<br/>
          Color : {{ $item['product']['product_color'] }} <br/>
          Size : {{ $item['size'] }} <br/>
        </td>
        <td>{{ $item['product']['product_code'] }}</td>
        <td>{{ $item['quantity'] }}</td>
        
        <td>
          TK. {{ $productPrice['product_price'] }} <br/>
          ({{ $productPrice['product_price'] }} X {{ $item['quantity'] }} = {{ $productPrice['product_price'] * $item['quantity'] }})
        </td>
        <td>TK. {{ $item['quantity'] * $productPrice['discount'] }}</td>
        <td>TK. {{ $total = $item['quantity'] * $productPrice['final_price'] }}</td>
      </tr>
        @php $sum += $total; @endphp
      @endforeach
      <tr>
        <td colspan="6" style="text-align:right">Sub Total Price: </td>
        <td>TK. {{ $sum }}</td>
      </tr>
      <tr>
        <td colspan="6" style="text-align:right">Coupon Discount:  </td>
        <td class="couponAmount">
          @if(Session::has('couponAmount'))
            TK. {{ Session::get('couponAmount') }}
          @else
            TK. 0.00
          @endif
        </td>
      </tr>
      <tr>
        <td colspan="6" style="text-align:right"><strong>GRAND TOTAL</strong></td>
        <td class="label label-important" style="display:block"> <strong class="grandTotal"> TK.&nbsp; {{ $sum - Session::get('couponAmount') }} </strong></td>
      </tr>
    </tbody>
  </table>

  <table class="table table-bordered">
    <tbody>
       <tr>
        <td> 
          <form id="applyCoupon" method="post" action="javascript:" class="form-horizontal" @if(Auth::check()) user="1" @endif>
            @csrf
            <div class="control-group">
              <label class="control-label"><strong> PAYMENT METHODS: </strong> </label>
              <div class="controls">
                {{-- <input type="radio" style="margin-top: -2px; margin-left: 5px;"> Cash on Delivery --}}
              </div>  
            </div>
          </form>
        </td>
      </tr>
      
    </tbody>
</table>
      
  <a href="{{ url('/cart') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Back to Cart </a>
  <a href="{{ url('/checkout') }}" class="btn btn-large pull-right">Place Order <i class="icon-arrow-right"></i></a>
</div>
@endsection
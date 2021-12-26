@php
use App\Product;
@endphp
@extends('layouts.front_layouts.master')

@section('title', 'Cart Items')

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
    <li class="active"> SHOPPING CART</li>
  </ul>
  <h3>SHOPPING CART [ <small><span class="totalCartITems">{{ totalCartItems() }}</span> Item(s) </small>]<a href="{{ url('/') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>  
  <hr class="soft"/>  
      
  <div id="appendCartItems">
    @include('layouts.front_layouts.cart.show_cart_items')
  </div>

  <table class="table table-bordered">
    <tbody>
       <tr>
        <td> 
          <form id="applyCoupon" method="post" action="javascript:" class="form-horizontal" @if(Auth::check()) user="1" @endif>
            @csrf
            <div class="control-group">
              <label class="control-label"><strong> COUPON CODE: </strong> </label>
              <div class="controls">
                <input name="code" id="code" type="text" class="input-medium" placeholder="Enter Coupon Code" required="" autocomplete="off">
                <button type="submit" class="btn"> APPLY </button>
              </div>  
              <span id="couponErrorMsg" style="color: red; font-size: 16px;"></span>
            </div>
          </form>
        </td>
      </tr>
      
    </tbody>
</table>
      
  <a href="{{ url('/') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
  <a href="{{ url('/checkout') }}" class="btn btn-large pull-right">Checkout <i class="icon-arrow-right"></i></a>
</div>
@endsection
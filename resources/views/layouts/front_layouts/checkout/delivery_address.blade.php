@extends('layouts.front_layouts.master')

@section('title', $title)

@section('main-content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{  url('/') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Delivery Address</li>
    </ul>
	<h3>{{ $title }}</h3>	
    <hr class="soft"/>
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

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
	
	<div class="row">
		<div class="span4">
			<div class="well">
                <h5>DELIVERY DETAILS</h5><br/>
                <form @if(empty($address['id'])) action="{{ url('/add-edit-delivery-address') }}" @else action="{{ url('/add-edit-delivery-address/'.$address['id']) }}" @endif method="post" id="deliverryAddressForm">
                @csrf
                    <div class="control-group">
                        <label class="control-label" for="name">Name</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="name" placeholder="Enter Name" name="name" value="{{ $address['name'] }}" required="">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="name">Mobile</label>
                        <div class="controls">
                            <input class="span3" type="number" id="mobile" placeholder="Enter Mobile" name="mobile" value="{{ $address['mobile'] }}" required="">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="address">Address</label>
                        <div class="controls">
                            <textarea class="span3" name="address" id="address" rows="6" placeholder="Enter your address" required="">{{ $address['address'] }}</textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="city">City</label>
                        <div class="controls">
                            <input class="span3" type="text" id="city" placeholder="Enter City" name="city" value="{{ $address['city'] }}">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="state">State</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="state" placeholder="Enter State" name="state" value="{{ $address['state'] }}">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="country">Country</label>
                        <div class="controls">

                            <select class="span3" name="country" id="country">
                                <option value="Bangladesh" selected>Bangladesh</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="state">Pincode</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="pincode" placeholder="Enter Pincode" name="pincode" value="{{ $address['pincode'] }}">
                        </div>
                    </div>

                    <div class="controls">
                        <button type="submit" class="btn block">Submit</button>
                        <a href="{{ url('/checkout') }}" type="submit" class="btn block" style="float: right;">Back</a>
                    </div>
                </form>
		    </div>
		</div>
		
	</div>	
</div>
@endsection
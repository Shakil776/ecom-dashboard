@extends('layouts.front_layouts.master')

@section('title', 'Account Details')

@section('main-content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="{{  url('/') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">My Account</li>
    </ul>
	<h3>Account Details</h3>	
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
                <h5>UPDATE ACCOUNT DETAILS</h5><br/>
                <form action="{{ url('/account') }}" method="post" id="accountForm">
                @csrf
                    <div class="control-group">
                        <label class="control-label" for="name">Name</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="name" placeholder="Enter Name" name="name" value="{{ $userDetails['name'] }}">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="email">E-mail</label>
                        <div class="controls">
                            <input class="span3" value="{{ $userDetails['email'] }}" readonly>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="mobile">Mobile</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="mobile" placeholder="Enter Mobile" name="mobile" value="{{ $userDetails['mobile'] }}">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="address">Address</label>
                        <div class="controls">
                            <textarea class="span3" name="address" id="address" rows="6" placeholder="Enter your address">{{ $userDetails['address'] }}</textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="city">City</label>
                        <div class="controls">
                            <input class="span3" type="text" id="city" placeholder="Enter City" name="city" value="{{ $userDetails['city'] }}">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="state">State</label>
                        <div class="controls">
                            <input class="span3"  type="text" id="state" placeholder="Enter State" name="state" value="{{ $userDetails['state'] }}">
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

                    <div class="controls">
                        <button type="submit" class="btn block">Update</button>
                    </div>
                </form>
		    </div>
		</div>
		<div class="span1"> &nbsp;</div>
		<div class="span4">
			<div class="well">
			    <h5>UPDATE PASSWORD</h5>
                <form action="{{ url('/update-password') }}" method="post">
                @csrf
                    
                    <div class="control-group">
                        <label class="control-label" for="password">Current Password</label>
                        <div class="controls">
                        <input type="password" class="span3"  id="password" name="password" placeholder="Enter Password">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password">New Password</label>
                        <div class="controls">
                        <input type="password" class="span3"  id="password" name="password" placeholder="Enter Password">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password">Confirm Password</label>
                        <div class="controls">
                        <input type="password" class="span3"  id="password" name="password" placeholder="Enter Password">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                        <button type="submit" class="btn">Update</button>
                        </div>
                    </div>
                </form>
		    </div>
		</div>
	</div>	
</div>
@endsection
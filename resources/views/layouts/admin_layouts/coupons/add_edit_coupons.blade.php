@extends('layouts.admin_layouts.master')

@section('title', $title)

@section('main-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Catalogues</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
        @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Weldone!</strong>  {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
        <form @if(empty($coupon['id'])) action="{{ route('admin.add-edit-coupon') }}" @else action="{{ route('admin.add-edit-coupon', ['id' => $coupon['id']]) }}" @endif method="post" id="couponForm" name="couponForm">
          @csrf
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">{{ $title }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  @if(empty($coupon['coupon_code']))
                    <div class="form-group">
                      <label for="coupon_option">Coupon Option <sup class="text-danger">*</sup></label> <br/>
                      <input type="radio" name="coupon_option" id="automaticCoupon" value="Automatic" checked="" />  Automatic &nbsp;&nbsp;
                      <input type="radio" name="coupon_option" id="manualCoupon" value="Manual" />  Manual
                    </div>

                    <div class="form-group" style="display: none;" id="couponField">
                      <label for="coupon_code">Coupon Code <sup class="text-danger">*</sup></label>
                      <input type="text" class="form-control" name="coupon_code" id="coupon_code" placeholder="Enter Coupon Code" />
                    </div>
                  @else
                  <input type="hidden" name="coupon_option" value="{{ $coupon['coupon_option'] }}">
                  <input type="hidden" name="coupon_code" value="{{ $coupon['coupon_code'] }}">
                    <div class="form-group">
                      <label for="coupon_code">Coupon Code : </label>
                      <span>{{ $coupon['coupon_code'] }}</span>
                    </div>
                  @endif

                  <div class="form-group">
                    <label for="coupon_type">Coupon Type <sup class="text-danger">*</sup></label> <br/>
                    <input type="radio" name="coupon_type" value="Multiple Times" @if(isset($coupon['coupon_type']) && $coupon['coupon_type'] == 'Multiple Times') checked="" @else checked="" @endif />  Multiple Times &nbsp;&nbsp;
                    <input type="radio" name="coupon_type" value="Single Times" @if(isset($coupon['coupon_type']) && $coupon['coupon_type'] == 'Single Times') checked="" @endif/>  Single Times
                  </div>

                  <div class="form-group">
                    <label for="amount_type">Amount Type <sup class="text-danger">*</sup></label> <br/>
                    <input type="radio" name="amount_type" value="Percentage" @if(isset($coupon['amount_type']) && $coupon['amount_type'] == 'Percentage') checked="" @else checked="" @endif />  Percentage &nbsp;(in %)&nbsp;
                    <input type="radio" name="amount_type" value="Fixed" @if(isset($coupon['amount_type']) && $coupon['amount_type'] == 'Fixed') checked="" @endif/>  Fixed &nbsp;(in TK)&nbsp;
                  </div>

                  <div class="form-group">
                    <label for="amount">Amount <sup class="text-danger">*</sup></label>
                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter Amount" required="" @if(isset($coupon['amount'])) value="{{ $coupon['amount'] }}" @endif />
                  </div>

                  <div class="form-group">
                    <label>Select Category <sup class="text-danger">*</sup></label>
                    <select name="categories[]" class="form-control select2" required="" multiple="" style="width: 100%;">
                      <option value="">Select</option>
                      @foreach($categories as $section)
                      <optgroup label="{{ $section['name'] }}"></optgroup>
                          @foreach($section['categories'] as $category)
                          <option value="{{ $category['id'] }}" @if(in_array($category['id'], $selCategories)) selected="" @endif >{{ $category['category_name'] }}</option>
                            @foreach($category['subcategories'] as $subcategory)
                            <option value="{{ $subcategory['id'] }}" @if(in_array($subcategories['id'], $selCategories)) selected="" @endif>&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{ $subcategory['category_name'] }}</option>
                            @endforeach
                          @endforeach
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Select User</label>
                    <select name="users[]" class="form-control select2" multiple="" style="width: 100%;">
                      <option value="">Select</option>
                        @foreach($users as $user)
                          <option value="{{ $user['email'] }}" @if(in_array($user['email'], $selUsers)) selected="" @endif>&nbsp;{{ $user['email'] }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="expiry_date">Expiry Date <sup class="text-danger">*</sup></label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                      </div>
                      <input required="" type="text" name="expiry_date" id="expiry_date" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask="" im-insert="false" @if(isset($coupon['expiry_date'])) value="{{ $coupon['expiry_date'] }}" @endif>
                    </div>
                    <!-- /.input group -->
                  </div>

                </div>
                <!-- /.col-md-6 -->
              </div>
              <!-- /.row -->
              <button type="submit" class="btn btn-info">Submit</button>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </form>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@extends('layouts.admin_layouts.master')

@section('title', 'Coupons')

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
            <li class="breadcrumb-item active">Coupons</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Weldone!</strong>  {{ Session::get('success_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
          @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Coupons</h3>
                <div>
                    <a href="{{ route('admin.add-edit-coupon') }}" class="btn btn-small btn-info float-right"><i class="fas fa-plus"></i>&nbsp;Add Coupon</a>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL. No</th>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Amount Type</th>
                    <th>Expiry Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(!empty($coupons))
                        @php($i = 1)
                        @foreach($coupons as $coupon)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $coupon['coupon_code'] }}</td>
                            <td>{{ $coupon['coupon_type'] }}</td>
                            <td>{{ $coupon['amount'] }} @if($coupon['amount_type'] == 'Percentage') % @else TK @endif </td>
                            <td>{{ $coupon['amount_type'] }}</td>
                            <td>{{ $coupon['expiry_date'] }}</td>
                            <td>
                                @if($coupon['status'] == 1) 
                                    <a class="changeCouponStatus" id="coupon-{{ $coupon['id'] }}" coupon_id="{{ $coupon['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>  
                                @else 
                                    <a class="changeCouponStatus" id="coupon-{{ $coupon['id'] }}" coupon_id="{{ $coupon['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive"></i></a> 
                                @endif
                            </td>
                            <td>
                              <a href="{{ route('admin.add-edit-coupon', ['id' => $coupon['id']]) }}" title="Edit"><i class="fas fa-edit text-info"></i></a>&nbsp;&nbsp;
                              <a href="javascript:void(0)" title="Delete" class="confirmDelete" record="coupon" recordid="{{ $coupon['id'] }}"><i class="fas fa-trash-alt text-danger"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


  
</div>
@endsection
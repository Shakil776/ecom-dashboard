@extends('layouts.admin_layouts.master')

@section('title', 'Store Product')

@section('main-content')
<div class="content-wrapper">
  <!-- Content Header Page header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Manage Store</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Store Product</li>
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
          @if(Session::has('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Weldone!</strong>  {{ Session::get('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
          @endif
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Store Product</h3>
                <div>
                    <a href="{{ route('product.create') }}" class="btn btn-small btn-info float-right"><i class="fas fa-plus"></i>&nbsp;Add Product</a>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Category Name</th>
                    <th>Brand Name</th>
                    <th>SKU</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(!empty($products))
                        @php($i = 1)
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $product['name'] }}</td>
                            <td><img width="50px" height="40px" src="{{ asset('storage/product-image/'.$product['image']) }}" alt="Product Image"></td>
                            <td>{{ $product['category']['name'] }}</td>
                            <td>{{ $product['brand']['name'] }}</td>
                            <td>{{ $product['sku'] }}</td>
                            <td>{{ $product['year'] }}</td>
                            <td>
                                @if($product['status'] == 1)
                                    <a class="changeBrandStatus" id="brand-{{ $product['id'] }}" brand_id="{{ $product['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                                @else
                                    <a class="changeBrandStatus" id="brand-{{ $product['id'] }}" brand_id="{{ $product['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                @endif
                            </td>
                            <td>
                              <a href="{{ route('product.show', $product['id']) }}" title="View Details"><i class="fas fa-eye-slash text-primary"></i></a>&nbsp;&nbsp;
                              <a href="#" title="Edit"><i class="fas fa-edit text-info"></i></a>&nbsp;&nbsp;
                              <a href="javascript:void(0)" title="Delete" class="confirmDelete" record="brand" recordid="{{ $product['id'] }}"><i class="fas fa-trash-alt text-danger"></i></a>
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
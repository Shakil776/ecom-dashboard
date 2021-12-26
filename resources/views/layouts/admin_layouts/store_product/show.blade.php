@extends('layouts.admin_layouts.master')

@section('title', 'Product Details')

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
            <li class="breadcrumb-item active">Product Details</li>
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
          <div class="col-md-6 col-12">

            <div class="card">
              <div class="card-header d-flex justify-content-between">
                  <a href="{{ route('product.index') }}" class="btn btn-md btn-dark"><i class="fas fa-arrow-left"></i>&nbsp;Back</a>
                  <div class="card-title"><h3>Product Details</h3></div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <tbody>
                        <tr>
                            <th>Product Name</th>
                            <td class="text-center">{{ $storeProduct->name }}</td>
                        </tr>
                        <tr>
                            <th>Category Name</th>
                            <td class="text-center">{{ $storeProduct->category->name }}</td>
                        </tr>
                        <tr>
                            <th>Brand Name</th>
                            <td class="text-center">{{ $storeProduct->brand->name }}</td>
                        </tr>
                        <tr>
                            <th>SKU</th>
                            <td class="text-center">{{ $storeProduct->sku }}</td>
                        </tr>
                        <tr>
                            <th>Cost Price</th>
                            <td class="text-center">BDT. {{ $storeProduct->cost_price }}</td>
                        </tr>
                        <tr>
                            <th>Retail Price</th>
                            <td class="text-center">BDT. {{ $storeProduct->retail_price }}</td>
                        </tr>
                        <tr>
                            <th>Year</th>
                            <td class="text-center">{{ $storeProduct->year }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td class="text-center">{{ $storeProduct->description }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td class="text-center">{{ $storeProduct->status == 1 ? 'Active' : 'Inactive' }}</td>
                        </tr>
                        <tr>
                            <th>Product Image</th>
                            <td class="text-center"><img width="250px" src="{{ asset('storage/product-image/'.$storeProduct->image) }}" alt="Product Image"></td>
                        </tr>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        @if($storeProduct->size_stocks->count() > 0)
          <div class="col-md-6 col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product Size and Stock Details</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>Size</th>
                            <th>Location</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($storeProduct->size_stocks as $stock_size)
                            <tr>
                                <td>{{ $stock_size->size->size }}</td>
                                <td>{{ $stock_size->location }}</td>
                                <td>{{ $stock_size->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        @endif
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
@extends('layouts.admin_layouts.master')

@section('title', 'Add Brand')

@section('main-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Manage Store</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Brand</li>
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

        <form  action="{{ route('brand.store') }}" method="post">
          @csrf
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Add Brand</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 offset-md-3">
                  <div class="form-group">
                    <label for="name">Brand Name<sup class="text-danger">*</sup></label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Brand name"  value="{{ old('name') }}">
                  </div>
                  <button type="submit" class="btn btn-info">Submit</button>
                </div>
              </div>
            </div>

            <!-- /.card-body -->
          </div>
        </form>
        <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
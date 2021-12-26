@extends('layouts.admin_layouts.master')

@section('title', 'Store Size')

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
            <li class="breadcrumb-item active">Store Size</li>
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
                <h3 class="card-title">Store Sizes</h3>
                <div>
                    <a href="{{ route('size.create') }}" class="btn btn-small btn-info float-right"><i class="fas fa-plus"></i>&nbsp;Add Size</a>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Size</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(!empty($sizes))
                        @php($i = 1)
                        @foreach($sizes as $size)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $size['size'] }}</td>
                            <td>
                                @if($size['status'] == 1)
                                    <a class="changeBrandStatus" id="brand-{{ $size['id'] }}" brand_id="{{ $size['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                                @else
                                    <a class="changeBrandStatus" id="brand-{{ $size['id'] }}" brand_id="{{ $size['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                @endif
                            </td>
                            <td>
                              <a href="#" title="Edit"><i class="fas fa-edit text-info"></i></a>&nbsp;&nbsp;
                              <a href="javascript:void(0)" title="Delete" class="confirmDelete" record="brand" recordid="{{ $size['id'] }}"><i class="fas fa-trash-alt text-danger"></i></a>
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
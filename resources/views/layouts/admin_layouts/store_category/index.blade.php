@extends('layouts.admin_layouts.master')

@section('title', 'Store Category')

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
            <li class="breadcrumb-item active">Store Category</li>
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
                <h3 class="card-title">Store Category</h3>
                <div>
                    <a href="{{ route('category.create') }}" class="btn btn-small btn-info float-right"><i class="fas fa-plus"></i>&nbsp;Add Category</a>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(!empty($categories))
                        @php($i = 1)
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $category['name'] }}</td>
                            <td>
                                @if($category['status'] == 1)
                                    <a class="changeBrandStatus" id="brand-{{ $category['id'] }}" brand_id="{{ $category['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" status="Active"></i></a>
                                @else
                                    <a class="changeBrandStatus" id="brand-{{ $category['id'] }}" brand_id="{{ $category['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" status="Inactive"></i></a>
                                @endif
                            </td>
                            <td>
                              <a href="#" title="Edit"><i class="fas fa-edit text-info"></i></a>&nbsp;&nbsp;
                              <a href="javascript:void(0)" title="Delete" class="confirmDelete" record="brand" recordid="{{ $category['id'] }}"><i class="fas fa-trash-alt text-danger"></i></a>
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
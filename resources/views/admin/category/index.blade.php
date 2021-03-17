@extends('admin.layouts.app')
@section('title','Categories')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Category</li>
      </ol>
    </section>

  <section class="content">
        <div class="row">
         <div class="col-md-12">
          <div class="box collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Add Category</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
               
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: none;">
           
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <form class="form-horizontal" action="{{ action('AdminController\CategoryController@store') }}" id="add_form" method="post" enctype="multipart/form-data">
            @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Category Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="" placeholder="Category Name" name="name" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Choose Image</label>

                  <div class="col-sm-10">
                    <input type="file" name="image_name" class="form-control" id=""  onchange="preview_image(event)">
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label"></label>

                  <div class="col-sm-10">
                    
                     <!-- <img id="output_image" src="{{ asset('admin') }}/dist/img/placeholder/download.png" style="width: 200px;height: 200px;"/> -->
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-right">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-main">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
        </div>
        <div class="col-md-2"></div>
      </div>
      
 </div>
              <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        </div>

        <div class="row">
         <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Categories List</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
               
              </div>
            </div>
            <!-- /.box-header -->
              <div class="box-body">
              <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Category Name</th>
                  <th>Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php $sr = 1 @endphp
                @foreach($categories as $category)
                <tr>
                  <td>{{ $sr++ }}</td>
                  <td> {{ $category->name ?? '' }} </td>
                  <td><img src="{{ asset($category->image_path ?? 'admin/dist/img/placeholder/download.png') }}" style="width: 60px; height: 40px;"></td>
                  <td> 
                  	@if($category->status == 1)
                  	  <button class="btn btn-success">Active</button>
                  	@else
                  	  <button class="btn btn-danger">Deactive</button>
                  	@endif

                  </td>
                  <td>
                    <button type="button" href="#" data-href="{{ action('AdminController\CategoryController@update', [$category->id]) }}" class="btn btn-primary btn-xs edit_model" data-toggle="modal" data-target="edit_model"  data-container=".edit_model"><i class="fa fa-edit"></i></button>

                    <button type="button" href="{{ action('AdminController\CategoryController@delete', [$category->id]) }}" class="btn btn-danger btn-xs" id="delete"><i class="fa fa-trash-o"></i></button>
                   
                   @php
                   if($category->status == 1){
                 
                    }
                   @endphp

                    <a type="button" 
                     @if($category->status == 1)
                      id="deactivate"
                      class="btn btn-danger btn-xs" 
                     @else
                      id="activate"
                      class="btn btn-success btn-xs" 
                     @endif

                     href="{{ action('AdminController\CategoryController@status', [$category->id]) }}" 
                     >
                     @if($category->status == 1)
                      Deactivate 
                     @else
                      Activate
                     @endif
                       
                  </a>
                  </td>
                </tr>
                @endforeach                
              </tbody>
              </table>
            </div>
            </div>
              <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        </div>

  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
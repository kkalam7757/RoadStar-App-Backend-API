@extends('admin.layouts.app')
@section('title','Indivudual Service Provider')
@section('content')
   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- <h1>
        Provider
      </h1> -->
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Indivisual</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">  
     <form class="form-horizontal" action="{{ action('AdminController\ProviderController@individual') }}" method="post">
          @csrf
        <div class="row">
      <div class="col-md-4">
        <label>Search by email or name</label>
        <input type="text" name="name" class="form-control" value="{{ $name }}">
      </div>
       <div class="col-md-4">
         <label>Status</label>
        <select class="form-control" name="status">
          <option>Select Status</option>
<option value="" @if($status == '') selected @endif>All</option>
<option value="1" @if($status ==  '1') selected @endif>ON</option>
<option value="0" @if($status == '0') selected @endif>Off</option>




        </select>
       </div>
        <div class="col-md-4">
          <div style="margin-top: 24px;">
             <button class="btn btn-default">Clear</button>
          <button class="btn btn-main">Submit</button>
          </div>
         
        </div>
    </div> 
      </form>
    <div class="heading-bg" style="margin-top: 30px;">
            <h3>Indivisual</h3>
          </div>
      <!-- /.row -->
      <div class="row">
          
            <!-- /.box-header -->
            <div class="box-body">
              
              <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <!-- <th>Status</th> -->
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @php $k=1; @endphp 
              @foreach($providers as $Provider)

                <tr>
                  <td>{{$k++}}</td>
                  <td>{{$Provider->name??''}}</td>
                  <td>{{$Provider->mobile??''}}</td>
                  <td>{{$Provider->email??''}}</td>
                  <td>
                    <a href="{{ action('AdminController\ProviderController@view',[$Provider->id]) }}" type="button" class="btn btn-primary btn-xs">History</a>
                     <button type="button" href="{{ action('AdminController\ProviderController@delete',[$Provider->id]) }}" class="btn btn-danger btn-xs" id="delete"><i class="fa fa-trash-o"></i></button>
                  </td>
                </tr>
             @endforeach  
              </tbody>
              </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>

  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection

@section('js')
<script type="text/javascript">

function changeStatus($id) {

      var id = $id; 
       $.ajax({
         url: '{{ action("AdminController\ProviderController@status") }}?id='+id,
         type: "GET",
         data : {"_token":"{{ csrf_token() }}"},
         dataType: "json",
         success: function(response) { 
            if (response.success == 200) {
                toastr.success(response.message); 
               
                //location.reload();
            } else {
                toastr.error(response.message);
            }
          }

    })
  }
  
</script> 




@endsection
@extends('admin.layouts.app')
@section('title','Provider History')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     <!--  <h1>
        Provider
      </h1> -->
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Provider</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">  
       <div class="heading-bg" style="margin-bottom: 20px;">
            <h3>View Provider</h3>
          </div>
   <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{asset($provider->image_path ?? 'dist/img/avatar.png')}}" alt="User profile picture">

              <h3 class="profile-username text-center"><b>{{$provider->name??''}}</b></h3>
              <p class="text-muted text-center">{{$provider->email??''}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Mobile</b> <span class="pull-right">{{$provider->mobile??''}}</span>
                </li>
                <li class="list-group-item">
                  <b>Status</b> <span class="pull-right"><button class="btn btn-xs btn-{{$provider->status=='1'?'success':'warning'}}">{{$provider->status=='1'?'Active':'De-Active'}}</button></span>    
                </li>
                <!-- <li class="list-group-item">
                  <b>User Rating</b> 
                  <span class="pull-right">
                    <ul class="rating_list">
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                      <li><i class="fa fa-star"></i></li>
                    </ul>
                  </span>
                </li> -->
                <!-- <li class="list-group-item">
                  <b>Service Address</b>
                  <p class="text-justify">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                  </p>
                </li> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
           <!-- Profile Image -->
          <div class="box">
            <div class="box-body box-profile">
              <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#p_profile">Profile</a></li>
              <li><a data-toggle="tab" href="#p_service">Service</a></li>
              <li><a data-toggle="tab" href="#bankdetail">Bank Details</a></li>
              <li><a data-toggle="tab" href="#servicehistory">Service History</a></li>
            </ul>

            <div class="tab-content">
              <div id="p_profile" class="tab-pane fade in active">
                <h3>Documents</h3>
                <table class="table table-bordered">
                  
                  @forelse($providerDocuments as $providerDocument)
                  @php
                    $approveStatus = $providerDocument->histories->isNotEmpty() ?
                                     $providerDocument->histories->last()->status_approve : false;
                    $rejectStatus =  $providerDocument->histories->isNotEmpty() ?
                                      $providerDocument->histories->last()->status_reject : false;
                    $name = $providerDocument->documentName->name ?? '';
                  @endphp
                  @if($name != '')
                    <tr>
                      <td >{{ $providerDocument->documentName->name ?? '' }}</td>
                      <td>
                        <a class="btn btn-sm btn-primary" href="{{ asset($providerDocument->document_image_path ?? '') }}" target="__blank">Download</a> 
                        @if(!$approveStatus and !$rejectStatus)
                        <a type="button" href="{{ action('AdminController\ProviderController@postStatus', [$providerDocument->id, '2']) }}" class="btn btn-sm btn-success add_model" >Accept</a> 

                        <a type="button" href="{{ action('AdminController\ProviderController@postStatus', [$providerDocument->id, '3']) }}" class="btn btn-sm btn-danger add_model" >Reject</a>
                        @else
                        <a type="button" @if($rejectStatus) href="{{ action('AdminController\ProviderController@postStatus', [$providerDocument->id, '2']) }}" @endif class="btn btn-sm btn-success disabled">Accept</a> 

                        <a type="button" @if($approveStatus) href="{{ action('AdminController\ProviderController@postStatus', [$providerDocument->id, '3']) }}" @endif class="btn btn-sm btn-danger disabled">Reject</a>
                        @endif
                      </td>
                    </tr>
                  @endif
                  @empty
                    <h1>No Document Available</h1>
                  @endforelse
                </table>
              </div>

            </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

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
         url: '#?id='+id,
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
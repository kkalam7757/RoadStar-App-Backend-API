<!-- Modal -->
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Accept Request</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="add_model" action="{{ action('AdminController\ProviderController@postStatus') }}">
          @csrf
          <input type="hidden" name="id" value="{{ $id }}">
          <input type="hidden" name="status" value="2">
          <div class="row">
            <div class="col-md-12">
              <textarea class="form-control" placeholder="Reason" name="reason"></textarea>
            </div>
          </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-default" >Cancel</button>
        <button type="submit" class="btn btn-main" >Submit</button>
      </div>
        </form>
      </div>
     
    </div>

  </div>

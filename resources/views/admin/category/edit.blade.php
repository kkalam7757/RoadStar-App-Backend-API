  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header btn-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Category</h4>
      </div>
      <div class="modal-body">
         <form class="form-horizontal" action="{{ action('AdminController\CategoryController@edit',[$category->id]) }}" method="post" id="edit_model">
          @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Category Name</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="" placeholder="Categories Name" name="name" value="{{ $category->name ?? '' }}" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Choose Image</label>

                  <div class="col-sm-10">
                    <input type="file" name="image_name" class="form-control" id="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label"></label>

                  <div class="col-sm-10">
                    <img src="{{ asset($category->image_path ?? 'admin/dist/img/placeholder/download.png') }}" style="width: 200px;height: 200px;">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-right">
                <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-main">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
      </div>
    </div>

  </div>
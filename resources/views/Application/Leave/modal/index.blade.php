<div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-edit"></i> {{trans('category.edit_leave_category')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div class="modal-body">
      <section class="panel panel-custom">
        <form action="javascript:void(0)" method="POST" id="updateForm{{$row->id}}" class="form-horizontal form-bordered validate" enctype="multipart/form-data">
            <div class="panel-body panel-body-custom">
                <div class="form-group">
                <input type="hidden" class="form-control" name="id" value="{{$row['id']}}" />
                    <label class="control-label">{{trans('category.leave_category_name')}} <span class="required">*</span></label>
                    <input type="text" class="form-control" name="leave_category" value="{{$row['name']}}" />
                    <span class="error"></span>
                </div>
                <div class=" form-group">
                    <label class="control-label">{{trans('category.day')}}  <span class="required">*</span></label>
                    <input type="number" class="form-control" name="leave_days"  value="{{$row['days']}}" />
                    <span class="error"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit"  class="btn btn-white" data-loading-text=" Processing"><i class="fas fa-plus-circle"></i>{{trans('category.update')}}</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">{{trans('category.cancel')}}</button>
            </div>        
        </form>
         </section>
      </div>
   
    </div>
  </div>
</div>

<style>

.close {
    float: right;
    font-size: 21px;
    font-weight: bold;
    line-height: 1;
    color: #fff;
    text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: .2;
}
</style>
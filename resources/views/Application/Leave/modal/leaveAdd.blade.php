
    <div class="modal fade bd-example-modal-lg" id="leaveAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-edit"></i> {{trans('leaveManage.leave_add')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div class="modal-body">
     
        <form action="javascript:void(0)" method="POST" id="LeaveManageStore" class="form-horizontal form-bordered validate" enctype="multipart/form-data">

            <div class="panel-body panel-body-custom">
                <div class="form-group">
                     <label class="col-md-3 control-label">{{trans('leaveManage.branch')}} <span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!!
                                        Form::select('branch_id',$branches,'',['class'=>'form-control','id'=>'branch_id'])
                                        !!}
                                        <span class="error"></span>
                                    </div>
                   

                    
                  
                </div>
                <div class="form-group">
                     <label class="col-md-3 control-label">{{trans('leaveManage.role')}} <span  class="required">*</span></label>
                 <div class="col-md-6">  {!! Form::select('role_id',$roles,'',['class'=>'form-control','id'=>'role_id']) !!}<span class="error"></span>
                   </div>
                   
                  
                </div>
                <div class="form-group">
                     <label class="col-md-3 control-label">{{trans('leaveManage.applicant')}} <span class="required">*</span></label> <div class="col-md-6"> {!! Form::select('user_id',$user,'',['class'=>'form-control','id'=>'user_id']) !!}  <span class="error"></span>
                 </div>
                   
                </div>
                 <div class="form-group">
                     <label class="col-md-3 control-label">{{trans('leaveManage.leave_category')}} <span  class="required">*</span></label>
                     <div class="col-md-6">  {!!  Form::select('leave_cat_id',$all_leave,'',['class'=>'form-control','id'=>'leave_cat_id']) !!}
                      <span class="error"></span>
                 </div>
                   

                    
                  
                </div>

                <div class="form-group">
                <label class="col-md-3 control-label">{{trans('leaveManage.leave_date')}} <span class="required">*</span></label>
                 <div class="col-md-6">

                  <div class="input-group input-daterange">
                  <input type="text" class="form-control" name="start_date"  >
                 <span class="error"></span>
                <div class="input-group-addon">to</div>
                 <input type="text" class="form-control date" name="end_date"  >
                 <span class="error"></span>
                 </div>
                 </div>
                </div>
                    <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('leaveManage.reason')}} </label>
                      <div class="col-md-6">
                    <textarea class="form-control" name="reason" rows="3"></textarea><span class="error"></span>
                      </div>
                      </div>
                     <div class=" form-group">
                     <label class="col-md-3 control-label">{{trans('leaveManage.attachment')}} </label>
                     <div class="col-md-6">
                                          
                                           
                     <input type="file" data-default-file=""  class="dropify" data-height="80"  name="attachment_file"/>
                     <span class="error"></span>
                                           
                       </div>
                </div>

                   <div class="form-group">
                    <label class="col-md-3 control-label">{{trans('leaveManage.comment')}} </label>
                       <div class="col-md-6">
                     <textarea class="form-control" name="comment" rows="3"></textarea>
                  <span class="error"></span>
                     </div>
                </div>
            </div>

            <div class="modal-footer">
                        
                         <button type="submit"  class="btn btn-white" data-loading-text=" Processing"><i class="fas fa-plus-circle"></i>{{trans('category.update')}}</button>
            
                     <button type="button" class="btn btn-white" data-dismiss="modal">{{trans('category.cancel')}}</button>
                     
                </footer>
          
        </form>
        
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
<script>


  
        jQuery.noConflict();
    (function($) {
        // Destroy the existing datepickers
        $('.input-group.input-daterange input').datepicker('destroy');
        var dateFormat = "yyyy-mm-dd";
        // Update the input values
        $('input[name="start_date"]').val("select date");
        $('input[name="end_date"]').val("select date");


        // Reinitialize the datepickers
        $('.input-group.input-daterange input').datepicker({
        format: dateFormat
    });

        // Optionally clear the dates
        $('.input-group.input-daterange input').each(function() {
          
            var shouldClearDate = false; // Change this condition as needed
            if (shouldClearDate) {
                $(this).datepicker('clearDates');
            }
        });
    })(jQuery);
</script>
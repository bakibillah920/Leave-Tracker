<div class="modal fade" id="leaveModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-edit"></i> {{trans('leave.edit_leave_request')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div class="modal-body">

      <section class="panel panel-custom">
        <form action="javascript:void(0)" method="POST" id="updateFormLeave{{$row->id}}" class="form-horizontal form-bordered validate" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="id" value="{{ $row->id }}" autocomplete="off">
            <div class="panel-body panel-body-custom">
            
                <div class="form-group">

                
                    <label class="control-label">Reviewed By :<span class="required">*</span></label> <br>
                    

                </div>

                <div class="form-group">
                <label class="col-md-12 control-label">Applicant : {{$row->user->name}}</label>
                                    
                </div>
                  <div class="form-group">
                <label class="col-md-12 control-label">Staff Id : {{$row->user->name}}</label>
                                    
                </div>
                  <div class="form-group">
                <label class="col-md-12 control-label">Leave Category :  {{$row->leaveCategory->name}}</label>
                                    
                </div>
                  <div class="form-group">
                <label class="col-md-12 control-label">Apply Date : {{$row->created_at->format('Y-m-d')}}</label>
                                    
                </div>
                  <div class="form-group">
                <label class="col-md-12 control-label">Start Date :   {{$row->start_date}}</label>
                                    
                </div>
                  <div class="form-group">
                <label class="col-md-12 control-label">End Date :   {{$row->end_date}}</label>
                                    
                </div>
                 </div>
                  <div class="form-group">
                <label class="col-md-12 control-label">Reason : {{$row->reason}}</label>
                                    
                </div>
                 <div class="form-group">
                <label class="col-md-12 control-label">Attachment : {{$row->user->name}}</label>
                                    
                </div>
                 <div class="form-group">
                <label class="col-md-12 control-label">Status  :  <div class="radio-custom radio-inline">
		                        <input type="radio" id="pending" name="status" value="1" <?php echo ($row['status'] == 1 ? ' checked' : ''); ?>>
		                        <label for="pending">Pending</label>
		                    </div>
		                    <div class="radio-custom radio-inline">
		                        <input type="radio" id="paid" name="status" value="2" <?php echo ($row['status'] == 2 ? ' checked' : ''); ?>>
		                        <label for="paid">Approve</label>
		                    </div>
		                    <div class="radio-custom radio-inline">
		                        <input type="radio" id="reject" name="status" value="3" <?php echo ($row['status'] == 3 ? ' checked' : ''); ?>>
		                        <label for="reject">Rejected</label>
		                    </div></label>
                                    
                </div>
                 <div class="form-group">
                <label class="col-md-12 control-label">Comment : <textarea class="form-control" name="reason" rows="3"></textarea></label>
                                    
                </div>
                  
              
            </div>

            <div class="modal-footer">
                        
                        <button type="submit"  class="btn btn-white" data-loading-text=" Processing"><i class="fas fa-plus-circle"></i>{{trans('category.update')}}</button>
            
                     <button type="button" class="btn btn-white" data-dismiss="modal">{{trans('category.cancel')}}</button>
                     
                </footer>
          
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
<script>
  
</script>
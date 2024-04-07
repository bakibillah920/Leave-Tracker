<input type="hidden" class="form-control" name="id" value="{{ $row->id }}" autocomplete="off">
<div class="panel-body panel-body">
    <div class="form-group">
        <label class="control-label col-md-3">{{trans('leave.leave_type')}} <span class="required">*</span></label>
        <div class="col-md-9">
            {!! Form::select('user_id',$alluser,$row->user_id,['class'=>'form-control selectTwo','id'=>'user_id'])   !!}
            <span class="error"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">{{trans('leave.leave_type')}} <span class="required">*</span></label>
        <div class="col-md-9">
            {!! Form::select('leave_cat_id',$all_leave,$row->category_id,['class'=>'form-control selectTwo','id'=>'leave_cat_id'])   !!}
            <span class="error"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">{{trans('leave.date')}} <span class="required">*</span></label>
        <div class="col-md-9">
            <div class="input-group">
                <input type="text" class="form-control datepicker" name="start_date" id="start_date" value="{{ $row->start_date }}" readonly="readonly" autocomplete="off">
                <span class="error"></span>
                <div class="input-group-addon">to</div>
                <input type="text" class="form-control datepicker" name="end_date" id="end_date" value="{{$row->end_date}}" readonly="readonly" autocomplete="off">
                <span class="error"></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">{{trans('leave.reason')}} </label>
        <div class="col-md-9">
            <textarea class="form-control" name="reason" rows="3">{{$row->reason}}</textarea>
            <span class="error"></span>
        </div>
    </div>
    <div class=" form-group">
        <label class="col-md-3 control-label">{{trans('leave.attachment')}} </label>
        <div class="col-md-9">
            <input type="file" data-default-file="{{ asset('uploads/attachments/leave/'.$row->enc_file_name) }}"  class="dropify" data-height="80"  name="attachment_file"/>
            <span class="error"></span>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit"  class="btn btn-default" data-loading-text=" Processing"><i class="fas fa-plus-circle"></i> {{trans('category.update')}}</button>
    <button type="button" class="btn btn-default modal-dismiss" >{{trans('category.cancel')}}</button>
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
$(document).ready(function() {
    $(".selectTwo").themePluginSelect2({
        allowClear: true,
        width: '100%'
    });
    $(".datepicker").datepicker({
	format: "yyyy-mm-dd",
	orientation: "bottom",
	autoclose: true,
	todayHighlight: true
    });
    $('.dropify').dropify();

});
</script>
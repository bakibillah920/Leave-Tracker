<div class="modal-body">
    <table>
        <tr>
            <td>Reviewed By : &nbsp;&nbsp;&nbsp; </td>
            <td> 
                <?php
                    if(!empty($leaveapp['approved_by'])){
                        echo Helper::get_type_name_by_id('users', $leaveapp->approved_by);
                    }else{
                        echo 'Unreviewed';
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td>Applicant : &nbsp;&nbsp;&nbsp; </td>
            <td>
                <?php
                    echo $leaveapp->user->name;
                ?>
            </td>
        </tr>
        <tr>
            <td>Leave Category : &nbsp;&nbsp;&nbsp; </td>
            <td>{!! $leaveapp->leave->name!!}</td>
        </tr>
        <tr>
            <td>Apply Date : &nbsp;&nbsp;&nbsp; </td>
            <td>{!! date("d.M.Y",strtotime($leaveapp->apply_date))!!}</td>
        </tr>
        <tr>
            <td>Start Date : &nbsp;&nbsp;&nbsp; </td>
            <td>{!! date("d.M.Y",strtotime($leaveapp->start_date))!!}</td>
        </tr>
        <tr>
            <td>End Date : &nbsp;&nbsp;&nbsp; </td>
            <td>{!! date("d.M.Y",strtotime($leaveapp->end_date))!!}</td>
        </tr>
        <tr>
            <td>Reason : &nbsp;&nbsp;&nbsp; </td>
            <td>{!! $leaveapp->reason !!}</td>
        </tr>
        <tr>
            <td>Attachment : &nbsp;&nbsp;&nbsp; </td>
            @if($leaveapp->enc_file_name)
                <td><a download="" class="btn btn-default btn-sm" target="_blank" href="{!! url('/uploads/attachments/leave/'.$leaveapp->enc_file_name)!!}"><i class="far fa-arrow-alt-circle-down"></i> Download</a></td>
            @else
                <td>Do Not Uploaded File</td>
            @endif
        </tr>
        <tr>
            <td>Status : &nbsp;&nbsp;&nbsp; </td>
            <td>
                <div class="radio-custom radio-inline">
                    <input type="radio" id="pending" name="status" <?php echo ($leaveapp->status ==1)?'checked':'' ?> value="1">
                    <label for="pending">Pending</label>
                </div>
                <div class="radio-custom radio-inline">
                    <input type="radio" id="paid" name="status" <?php echo ($leaveapp->status ==2)?'checked':'' ?> value="2">
                    <label for="paid">Approved</label>
                </div>
                <div class="radio-custom radio-inline">
                    <input type="radio" id="reject" name="status" <?php echo ($leaveapp->status ==3)?'checked':'' ?> value="3">
                    <label for ="reject">Rejected</label>
                </div>

            </td>
        </tr>
        <tr>
            <td>Comments  : &nbsp;&nbsp;&nbsp; </td>
            <td> <textarea id="comment1" name="comments" class="form-control" rows="3">{!! $leaveapp->comments !!}</textarea></td>
        </tr>
    </table>
</div>
<div class="modal-footer">
    <button type="submit"  class="btn btn-default" data-loading-text=" Processing"><i class="fas fa-plus-circle"></i> {{trans('category.update')}}</button>
    <input type="hidden" class="form-control" name="id" value="{!! $leaveapp->id !!}" autocomplete="off">
    <button type="button" class="btn btn-default modal-dismiss" >{{trans('category.cancel')}}</button>
</div>   
<script>
    $(document).ready(function () {
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
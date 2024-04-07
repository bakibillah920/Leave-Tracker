<header class="page-header">
    <a class="page-title-icon" href="/dashboard"><i class="fas fa-home"></i></a>
    <h2>{{$pageTitle}}</h2>
    <style>
    a:active,
    a:hover {
        outline: 0;
    }

    .select2-search--dropdown {
        background-color: #383838;
        color: #fff;

    }

    .select2-search__field {
        background-color: #383838;
        color: #fff;
    }

    .select2-results {
        background-color: #383838;
        color: #fff;
    }

    .select2-choice,
    .select2-selection__choice {
        background-color: #383838 !important;
        color: #fff;
        /*border: 1px solid #4c4e51 !important;*/
    }

    .select2-selection {
        ackground-color: #383838 !important;
        border: 1px solid #4c4e51 !important;
    }

    .select2-selection.select2-selection--multiple {
        background-color: #383838 !important;
        color: #fff;
        border: 1px solid #4c4e51 !important;
    }

    .select2-dropdown.select2-dropdown--below {
        border: 1px solid #4c4e51 !important;
    }
    </style>
</header>

<section class="panel">
    <div class="tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#classes" data-toggle="tab"><i class="fas fa-list-ul"></i> {{trans('leave.leave_list')}}</a>
            </li>
            <li class="">
                <a href="#leaveRequest" data-toggle="tab"><i class="far fa-edit"></i> {{trans('leave.leave_request')}}</a>
            </li>
        </ul>
        <div class="tab-content">
            <!-- classes -->
            <div id="classes" class="tab-pane active">
                <div class="row">
                    <div class="col-md-12 pl-xs">
                        <section class="panel panel-custom">
                            <!-- <header class="panel-heading panel-heading-custom">
                                <h4 class="panel-title"><i class="fas fa-list-ul"></i>
                                    {{trans('category.leave_category_list')}}</h4>
                            </header> -->
                            <div class="panel-body panel-body-custom">
                                <div class="table-responsive">
                                     <table class="table table-bordered table-hover mb-none table-export">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{trans('leave.applicant')}}</th>
                                                <th>{{trans('leave.leave_category')}}</th>
                                                <th>{{trans('leave.date_of_start')}}</th>
                                                <th>{{trans('leave.date_of_end')}}</th>
                                                <th>{{trans('leave.days')}}</th>
                                                <th>{{trans('leave.apply_date')}}</th>
                                                <th>{{trans('leave.status')}}</th>
                                                <th>{{trans('leave.action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($leave_request as $row)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{!! $row->UserName !!}</td>
                                                <td>{!! $row->category_name !!}</td>
                                                <td> {!! date("d.M.Y",strtotime($row->start_date)) !!}</td>
                                                <td>{!! date("d.M.Y",strtotime($row->end_date)) !!}</td>
                                                <td>{!! $row->leave_days!!}</td>
                                                <td>{!! date("d.M.Y",strtotime($row->apply_date)) !!}</td>
                                                <td>
                                                @if($row->status == 1)
                                                    <span class="label label-warning-custom text-xs">Pending</span>
                                                @elseif ($row->status  == 2)
                                                    <span class="label label-success-custom text-xs">Accept</span>
                                                @elseif ($row->status  == 3)
                                                    <span class="label label-danger-custom text-xs">Rejected</span>
                                                @endif
                                                </td>
                                                <td>
                                                    <!--update link-->
                                                    <a href="#;" onclick="getRequestDetails(<?=$row->id ?>)" class="btn btn-circle icon btn-default">
                                                        <i class="fas fa-pen-nib"></i>
                                                    </a>
                                                    <a onclick="deleteClass({{$row->id}})" href="javascript:void(0)"
                                                        class="btn btn-danger bg-red btn-circle icon">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <!--delete link-->
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div id="leaveRequest" class="tab-pane ">
                <div class="row">
                    <div class="col-md-12 pr-xs">
                        <section class="panel panel-custom">
                            <form action="javascript:void(0)" method="POST" id="LeaveRequestStore" class="form-horizontal form-bordered validate" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-3 control-label">{{trans('leave.user')}} <span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::select('user_id',$alluser,'',['class'=>'form-control selectTwo','id'=>'user_id']) !!}
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">{{trans('leave.leave_type')}} <span
                                            class="required">*</span></label>
                                    <div class="col-md-6">
                                        {!! Form::select('leave_cat_id',$all_leave,'',['class'=>'form-control selectTwo','id'=>'leave_cat_id']) !!}
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">{{trans('leave.date')}} <span class="required">*</span></label>
                                    <div class="col-md-6">
                                        <div class="input-group input-daterange">
                                            <input type="text" class="form-control datepicker" readonly="" id="start_date" autocomplete="off" name="start_date" >
                                                <span class="error"></span>
                                            <div class="input-group-addon">to</div>
                                                <input type="text" class="form-control datepicker" readonly="" id="end_date" autocomplete="off" name="end_date" >
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">{{trans('leave.reason')}} </label>
                                    <div class="col-md-6">
                                    <textarea class="form-control" name="reason" rows="3"></textarea>
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-md-3 control-label">{{trans('leave.attachment')}} </label>
                                        <div class="col-md-6">
                                        <input type="file" class="dropify" data-height="80"  name="attachment_file"/>
                                                <span class="error"></span>
                                        </div>
                                    </div>
                            
                                <footer class="panel-footer panel-footer-custom">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-default"
                                            data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
                                            <i class="fas fa-plus-circle"></i> Save
                                        </button>
                                    </div>
                                </footer>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="modal">
    <header class="panel-heading">
        <h4 class="panel-title"><i class="fas fa-bars"></i>{{trans('leave.edit_leave_request')}}</h4>
    </header>
    <div class="panel-body">
        <form action="javascript:void(0)" method="POST" id="updateFormRequest" class="form-horizontal form-bordered validate" enctype="multipart/form-data">
            <div class="panel" id='quick_view'></div>
        </form>
    </div>    
</div>
<script type="text/javascript">
function getRequestDetails(id) {
    $.ajax({
        url:'/leave/getRequestDetails',
        type: 'POST',
        data: {'id': id},
        dataType: "json",
        success: function (data) {
            $('#quick_view').html(data);
            mfp_modal('#modal');
        }
    });
}
function deleteClass(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/leave/request/delete/" + id,
                type: "DELETE",
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Deleted!',
                            'Your section has been deleted.',
                            'success'
                        )
                        location.reload()
                    } else {
                        toastr.success(response.msg);
                    }
                }
            });
        }
    })
}

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
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

    $(document).on("changeDate", "#end_date", function (e) {    
        var end_date = $('#end_date').datepicker('getFormattedDate');
        var start_date = $('#start_date').datepicker('getFormattedDate');
        if(start_date > end_date){
             toastr.error('Start Date cannot be greater than End date!!');
             $('#end_date').val('');
        }
    });
    $('#LeaveRequestStore').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "/leave/request/store",
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                $('.form-group span.error').remove();
                if (response.success) {
                    toastr.success(response.msg);
                    document.getElementById("LeaveRequestStore").reset();
                    location.reload();
                } else {
                    toastr.error(response.msg);
                }
            },
            error: function(data) {
                $('.form-group span.error').remove();
                if (data.status == 422) {
                    var errors = data.responseJSON;
                    console.log(errors.errors)
                    $.each(errors.errors, function(i, error) {
                        var el = $(document).find('[name="' + i + '"]');
                        el.after($('<span class="error" style="color: red;">' +
                            error[0] + '</span>'));
                    });
                }
            }

        });


    });

    $('#updateFormRequest').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/leave/request/update",
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                $('.form-group span.error').remove();
                if (response.success) {
                    toastr.success(response.msg);
                    document.getElementById("LeaveRequestStore").reset();
                    location.reload();
                } else {
                    toastr.error(response.msg);
                }
            },
            error: function(data) {
                $('.form-group span.error').remove();
                if (data.status == 422) {
                    var errors = data.responseJSON;
                    console.log(errors.errors)
                    $.each(errors.errors, function(i, error) {
                        var el = $(document).find('[name="' + i + '"]');
                        el.after($('<span class="error" style="color: red;">' +
                            error[0] + '</span>'));
                    });
                }
            }

        });
    });
});

</script>
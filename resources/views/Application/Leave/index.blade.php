<header class="page-header">
    <a class="page-title-icon" href="/dashboard"><i class="fas fa-home"></i></a>
    <h2>{{$pageTitle}}</h2>
</header>
<section class="panel">
    <header class="panel-heading">
        <h4 class="panel-title">Select Group</h4>
    </header>
</section>
<section class="panel">
    <div class="tabs-custom">
        <div class="tab-content">
            <div id="list" class="tab-pane active">
                <div class="mb-md">
                    <div class="card-body">
                        <table class="table table-bordered" id="datatable-crud">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Applicant</th>
                                    <th>Leave Category</th>
                                    <th>Date Of Start</th>
                                    <th>Date Of End</th>
                                    <th>Days</th>
                                    <th>Apply Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

    <div class="modal fade bd-example-modal-lg" id="leaveAddModal" tabindex="-1" role="dialog" aria-labelledby="leaveAddModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                 <form action="javascript:void(0)" method="POST" id="LeaveManageStore" class="form-horizontal form-bordered validate" enctype="multipart/form-data">
                    <header class="panel-heading">
                        <h4 class="panel-title"><i class="fas fa-bars"></i> {{trans('leaveManage.leave_add')}}</h4>
                    </header>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('leaveManage.applicant')}} <span class="required">*</span></label> <div class="col-md-6">
                                {!! Form::select('user_id',$user,'',['class'=>'form-control selectTwo','id'=>'user_id']) !!}  <span class="error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('leaveManage.leave_category')}} <span  class="required">*</span></label>
                            <div class="col-md-6">  {!!  Form::select('category_id',$all_leave,'',['class'=>'form-control selectTwo','id'=>'category_id']) !!}
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('leaveManage.leave_date')}} <span class="required">*</span></label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    {{ Form::text('start_date', '', ['class' => 'form-control datepicker', 'readonly' ,'autocomplete'=>'off','id'=>'start_date']) }}
                                    <span class="error"></span>
                                    <div class="input-group-addon">to</div>
                                    {{ Form::text('end_date', '', ['class' => 'form-control datepicker', 'readonly' ,'autocomplete'=>'off','id'=>'end_date']) }}
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
                            <label class="col-md-3 control-label">Attachment </label>
                            <div class="col-md-6">
                                <input type="file" data-default-file=""  class="dropify" data-height="80"  name="attachment_file"/>
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{trans('leaveManage.comment')}} </label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="comments" rows="3"></textarea>
                                <span class="error"></span>
                            </div>
                        </div>
                </div>
                    <div class="panel-footer text-right">
                        <button type="submit"  class="btn btn-default" data-loading-text=" Processing"><i class="fas fa-plus-circle"></i> Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('category.cancel')}}</button>
                    </div>     
                </form>
            </div>
        </div>
    </div>
</section>
<div class="zoom-anim-dialog modal-block modal-block-primary mfp-hide" id="modalEdit">
    <header class="panel-heading">
        <h4 class="panel-title"><i class="fas fa-bars"></i> Edit</h4>
    </header>
    <div class="panel-body">
        <form action="javascript:void(0)" method="POST" id="updateManageStore" class="form-horizontal form-bordered" enctype="multipart/form-data">
            <div class="panel" id='quick_view'></div>
        </form>
    </div>    
</div>
<script type="text/javascript">
function getEdit(id) {
    $.ajax({
        url:'/leave/manage/getEdit',
        type: 'POST',
        data: {'id': id},
        dataType: "json",
        success: function (data) {
            $('#quick_view').html(data);
            mfp_modal('#modalEdit');
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
                url:"/leave/request/delete/" + id,
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
    $(document).ready( function () {
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

    $(document).on("submit", "#LeaveManageStore", function (e) {         
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url:"/leave/manage/store", // Make sure site_url is defined
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                $('.form-group span.error').remove();
                if (response.success) {
                    toastr.success(response.msg);
                    document.getElementById("LeaveManageStore").reset(); // Fix the form ID here
                    location.reload();
                } else {
                    toastr.error(response.msg); // Change to error, not success
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
    
  $('#updateManageStore').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url:"/leave/manage/store", // Make sure site_url is defined
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                $('.form-group span.error').remove();
                if (response.success) {
                    toastr.success(response.msg);
                    document.getElementById("updateManageStore").reset(); // Fix the form ID here
                    location.reload();
                } else {
                    toastr.error(response.msg); // Change to error, not success
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
    
     var dataTable =  $('#datatable-crud').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ url('leave/manage/get-data?layout=true') }}",
              
              columns: [
                       { data: 'id', name: 'SL' },
                       { data: 'user_name', name: 'Applicant' },
                       { data: 'leave.name', name: 'Leave Category' },
                       { data: 'start_date', name: 'Date Of Start' },
                       { data: 'end_date', name: 'Date Of End' },
                       { data: 'leave_days', name: 'Days' },
                       { data: 'created_at', name: 'Apply Date' },
                       {
                        name: 'Status',
                        data: 'status',
                        render: function(data, type, row) {
                            if (data == 1) {
                                return '<span class="label label-warning-custom text-xs">Pending</span>';
                            } else if (data == 2) {
                                return '<span class="label label-success-custom text-xs">Accepted</span>';
                            } else if (data == 3) {
                                return '<span class="label label-danger-custom text-xs">Rejected</span>';
                            } else {
                                return ''; // Handle other cases as needed
                            }
                        }
                    },
                       {
                    name: 'action',
                    data: 'id',
                    render: function(data, type, row) {
                        return '<a  class="btn btn-circle icon btn-default" onclick="getEdit('+data+')">' +
                            '<i class="fas fa-pen-nib"></i></a>' +
                            '<a href="javascript:void(0)" onclick="deleteClass(' + data + ')" ' +
                            'class="btn btn-danger bg-red btn-circle icon">' +
                            '<i class="fas fa-trash"></i></a>';
                    },
                    orderable: false
                },
                    ],
                    order: [[0, 'desc']],
                    dom: 'Bfrtip',
                   buttons: [
                     {
                         extend:    'copyHtml5',
                         text:      '<i class="fa-solid fa-copy"></i>',
                         titleAttr: 'Copy'
                     },
                     {
                         extend:    'excelHtml5',
                         text:      '<i class="fa-solid fa-file-excel"></i>',
                         titleAttr: 'Excel'
                     },
                     {
                         extend:    'csvHtml5',
                         text:      '<i class="fa-solid fa-file-csv"></i>',
                         titleAttr: 'CSV'
                     },
                     {
                         extend:    'pdfHtml5',
                         text:      '<i class="fa-solid fa-file-pdf"></i>',
                         titleAttr: 'PDF'
                     },
                     {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                         titleAttr: 'Print'
                    }
                 ]
          });
        $('#applyFilter').on('click', function() {
            // Get selected branch and role values
            var branchId = $('#branch_id1').val();
            var roleId = $('#role_id1').val();

            // Reload the DataTable with the filter values
            dataTable.ajax.url("{{ url('leave/manage/get-data?layout=true') }}" + '&branch_id=' + branchId + '&role_id=' + roleId).load();
        });

        $('#submitForm').on('click', function () {
            var formData = $('#leaveForm').serialize();
            var leaveId = $('#leaveId').val();

            // Send the form data to your server for updating
            $.ajax({
                url:'/leave/manage/update/' + leaveId,
                type: 'POST',
                data: formData,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.msg);
                        $('#leaveModal').modal('hide');
                        dataTable.ajax.reload();
                    } else {
                        toastr.error(response.msg);
                    }
                },
                error: function (data) {
                    // Handle errors
                }
            });
        });
        const $branchSelect = $('#branch_id1');
        const $roleSelect = $('#role_id1');

        // Function to reload the DataTable
        function reloadDataTable() {
            dataTable.ajax.reload();
        }

        // Add event listeners to select inputs
        $branchSelect.on('change', reloadDataTable);
        $roleSelect.on('change', reloadDataTable);
     });
    
     
</script>


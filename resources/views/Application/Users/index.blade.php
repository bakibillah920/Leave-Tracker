<header class="page-header">
    <a class="page-title-icon" href="/dashboard"><i class="fas fa-home"></i></a>
    <h2>{{$pageTitle}}</h2>
</header>
<div class="dashboard-page" >
    <div class="card-body">
        <table class="table table-bordered table-hover mb-none table-export">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1;
                foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $user['role_name']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td>
                            <?php
                                if($user['status'] =='Y'){
                                ?>
                            <span class="label label-success-custom"><i class="far fa-check-square"></i> Active</span>
                            <?php
                                }else{
                            ?>
                            <span class="label label-danger-custom"><i class="far fa-check-square"></i> InActive</span>
                            <?php
                                }
                            ?>
                            
                        </td>
                        <td class="min-w-xs">
                            <a href="javascript:void(0)" onclick="userInfo({{ $user['id'] }},2)" data-toggle="tooltip" data-original-title="Edit" class="btn btn-default btn-circle icon">
                                <i class="fas fa-pen-nib"></i>
                            </a>
                            <button class="btn btn-default btn-circle" onclick="userInfo({{ $user['id'] }},1)">
                                <i class="fas fa-unlock-alt"></i>
                            </button>
                            @if(Auth::user()->role != 4)
                                @if($user['status'] =='Y')
                                <button class="btn btn-default btn-circle" onclick="userInfo2({{ $user['id'] }},1)">
                                    <i class="fas fa-user-alt"></i>
                                </button>
                                @else
                                 <button class="btn btn-default btn-circle" onclick="userInfo2({{ $user['id'] }},2)">
                                    <i class="fas fa-user-slash"></i>
                                </button>
                                @endif
                            @endif
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div id="authentication_modal" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h4 class="panel-title">
                <i class="fas fa-unlock-alt"></i> <?= trans('Authentication') ?>
            </h4>
        </header>
        <form action="javascript:void(0)" method="POST" id="updateAuth" class="form-horizontal validate" enctype="multipart/form-data">
            <div id="quick_view"></div>
        </form>
    </section>
</div>
<div id="edit_modal" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h4 class="panel-title">
                <i class="fas fa-unlock-alt"></i> <?= trans('User Edit') ?>
            </h4>
        </header>
        <form action="javascript:void(0)" method="POST" id="updateSave" class="form-horizontal validate" enctype="multipart/form-data">
            <div id="quick_view2"></div>
        </form>
    </section>
</div>
<script type="text/javascript">
        function userInfo(id,type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/users/userInfo',
                type: 'POST',
                data: {'id': id,'type':type},
                dataType: "json",
                success: function (data) {
                   if(type==1){ 
                        $('#quick_view').html(data);
                        mfp_modal('#authentication_modal');
                    }else{
                        $('#quick_view2').html(data);
                        mfp_modal('#edit_modal');
                    }
                }
            });
        }
        function userInfo2(id,type) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/users/active',
                type: 'POST',
                data: {'id': id,'type':type},
                dataType: "json",
                success: function (data) {
                   if (data.success) {
                        toastr.success(data.msg);
                        location.reload();
                    } else {
                        toastr.error(data.msg);
                    }
                }
            });
        }
    $(document).ready( function () {
       $.ajaxSetup({
           headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
    
    
    $(document).on("click", "#showPassword", function (e) {
        $('#password').attr('type', 'text');
    });
    $(document).on("click", "#cshowPassword", function (e) {
        $('#password_confirmation').attr('type', 'text');
    });
        $(document).on("submit", "#updateAuth", function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("Form_",1);
            $.ajax({
                url: "/users/store",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('.form-group span.error').remove();
                    if (response.success) {
                        toastr.success(response.msg);
                        document.getElementById("updateAuth").reset();
                        location.reload();
                    } else {
                        toastr.error(response.msg);
                    }
                },
                error: function (data) {
                    $('.form-group span.error').remove();
                    if (data.status == 422) {
                        var errors = data.responseJSON;
                        console.log(errors.errors)
                        $.each(errors.errors, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span class="error" style="color: red;">' + error[0] + '</span>'));
                        });
                    }
                }

            });
        });
        $(document).on("submit", "#updateSave", function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("Form_",2);
            $.ajax({
                url: "/users/store",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('.form-group span.error').remove();
                    if (response.success) {
                        toastr.success(response.msg);
                        document.getElementById("updateAuth").reset();
                        location.reload();
                    } else {
                        toastr.error(response.msg);
                    }
                },
                error: function (data) {
                    $('.form-group span.error').remove();
                    if (data.status == 422) {
                        var errors = data.responseJSON;
                        console.log(errors.errors)
                        $.each(errors.errors, function (i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span class="error" style="color: red;">' + error[0] + '</span>'));
                        });
                    }
                }

            });
        });
    
    
    
         var i = 1;
        $('#datatable-crud').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ url('users/get_data?layout=true') }}",
              columns: [
                        {
                            "render": function (data, type, full, meta) {
                                return i++;
                            }
                        },
                       { data: 'email', name: 'email' },
                       { data: 'created_at', name: 'created_at' },
                       { data: 'action', name: 'action', orderable: false},
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
     });
    
</script>
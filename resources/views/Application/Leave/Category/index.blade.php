<header class="page-header">
    <a class="page-title-icon" href="/dashboard"><i class="fas fa-home"></i></a>
    <h2>{{$pageTitle}}</h2>
    <style>

    .form-horizontal .control-label {
    padding-top: 7px;
    margin-bottom: 0;
    text-align: left;
}
        .select2-search--dropdown{
            background-color: #383838;
            color: #fff;

        }
        .select2-search__field{
            background-color: #383838;
            color: #fff;
        }
        .select2-results {
            background-color: #383838;
            color: #fff;
        }
        .select2-choice, .select2-selection__choice {
            background-color: #383838 !important;
            color: #fff;
            /*border: 1px solid #4c4e51 !important;*/
        }
        .select2-selection
        {
            ackground-color: #383838 !important;
            border: 1px solid #4c4e51 !important;
        }
        .select2-selection.select2-selection--multiple{
            background-color: #383838 !important;
            color: #fff;
            border: 1px solid #4c4e51 !important;
        }
        .select2-dropdown.select2-dropdown--below{
            border: 1px solid #4c4e51 !important;
        }
    </style>
</header>

    <section class="panel">
        <div class="tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#classes" data-toggle="tab"><i class="fa-solid fa-graduation-cap"></i> Add Leave Category</a>
                </li>
               
            </ul>
            <div class="tab-content">
                <!-- classes -->
                <div id="classes" class="tab-pane active">
                    <div class="row">
                        <div class="col-md-5 pr-xs">
                            <section class="panel panel-custom">
                                <form action="javascript:void(0)" method="POST" id="LeaveCategoryStore" class="form-horizontal form-bordered validate" enctype="multipart/form-data">
                                   
                                    <div class="panel-body panel-body-custom">
                                        <div class="form-group">
                                            <label class="control-label">{{trans('category.leave_category_name')}} <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="leave_category" value="" />
                                            <span class="error"></span>
                                        </div>
                                        <div class=" form-group">
                                            <label class="control-label">{{trans('category.day')}}  <span class="required">*</span></label>
                                            <input type="number" class="form-control" name="leave_days"  placeholder="Decide The Day" />
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                    <footer class="panel-footer panel-footer-custom">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-default" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
                                                <i class="fas fa-plus-circle"></i> Save
                                            </button>
                                        </div>
                                    </footer>
                                </form>
                            </section>
                        </div>

                        <div class="col-md-7 pl-xs">
                            <section class="panel panel-custom">
                                <header class="panel-heading panel-heading-custom">
                                    <h4 class="panel-title"><i class="fas fa-list-ul"></i> {{trans('leave Category List')}}</h4>
                                </header>
                                <div class="panel-body panel-body-custom">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-condensed mb-none">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{trans('category.name')}}</th>
                                                <th>{{trans('category.day')}}</th>
                                                <th>{{trans('category.action')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($leave_category as $row)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$row['name']}}</td>
                                                    <td>{{$row['days']}}</td>
                                                    <td>
                                                        <!--update link-->
                                                        <a class="btn btn-circle icon btn-default" href="#;" data-toggle="modal" data-target="#exampleModal{{$row->id}}">
                                                        <i class="fas fa-pen-nib"></i> 
                                                         </a>
                                                        
                                                        <a onclick="deleteClass({{$row['id']}})" href="javascript:void(0)" class="btn btn-danger bg-red btn-circle icon">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <!--delete link-->
                                                </tr>
                                                @include('Application.Leave.modal.index')
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script type="text/javascript">


    function deleteClass(id){
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
                    url:"/leave/category/delete/"+id,
                    type: "DELETE",
                    cache       : false,
                    contentType : false,
                    processData : false,
                    success: function( response ) {
                        if(response.success){
                            Swal.fire(
                                'Deleted!',
                                'Your section has been deleted.',
                                'success'
                            )
                            location.reload()
                        }else{
                            toastr.success(response.msg);
                        }
                    }
                });
            }
        })
    }
    $(document).ready( function () {
        $(".selectTwo").themePluginSelect2({
            allowClear: true,
            width: '100%'
        });
       $.ajaxSetup({
           headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });

     $('#LeaveCategoryStore').submit(function(e) {
           e.preventDefault();
           var formData = new FormData(this);

           $.ajax({
               url:" {{ url('/leave/category/store') }}",
               type: "POST",
               data: formData,
               cache       : false,
               contentType : false,
               processData : false,
               success: function( response ) {
                   $('.form-group span.error').remove();
                   if(response.success){
                       toastr.success(response.msg);
                       document.getElementById("LeaveCategoryStore").reset();
                       location.reload();
                   }else{
                       toastr.success(response.msg);
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

          $('form[id^="updateForm"]').submit(function(e) {
           e.preventDefault();
           var id = $(this).attr('id');
           var formData = new FormData(this);

           $.ajax({
               url: "{{url('/leave/category/store')}}",
               type: "POST",
               data: formData,
               cache       : false,
               contentType : false,
               processData : false,
               success: function( response ) {
                   $('.form-group span.error').remove();
                   if(response.success){
                       toastr.success(response.msg);
                       document.getElementById("LeaveCategoryStore").reset();
                       location.reload();
                   }else{
                       toastr.success(response.msg);
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
    
        $('.multiple-select2').select2({
            placeholder: "First Select The Branch"
        });


     });

  
</script>

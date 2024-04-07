<header class="page-header">
    <a class="page-title-icon" href="/dashboard"><i class="fas fa-home"></i></a>
    <h2>{{$pageTitle}}</h2>
</header>
<?php
$widget = (Auth::user()->role==1) ? 'col-md-4' : 'col-md-6';
$currency_symbol = $global_config['currency_symbol']; 
?>
<section class="panel">
    <header class="panel-heading">
        <h4 class="panel-title">Select Ground</h4>
    </header>
    <form>
    <div class="panel-body">
        <div class="row mb-sm">
            @if (Auth::user()->role==1)
                <div class="col-md-4 mb-sm">
                    <div class="form-group">
                        <label class="control-label">Branch<span class="required">*</span></label>
                        {!! Form::select("branch_id", $all_branch,Request::get('branch_id'), ['class' => 'form-control selectTwo']) !!}
                    </div>
                </div>
            @endif
            <div class="{{ $widget }}  mb-sm">
                    <div class="form-group">
                        <label class="control-label">Role<span class="required">*</span></label>
                        {!! Form::select("role_id", $all_roll,Request::get('role_id'), ['class' => 'form-control selectTwo']) !!}
                    </div>
                </div>
            <div class="{{ $widget }} mb-sm">
                <div class="form-group">
                    <label class="control-label">Month <span class="required">*</span></label>
                    {!! Form::text("daterange", Request::get('daterange'), ['class' => 'form-control daterange', 'autocomplete' => 'off', 'required']) !!}
                </div>
            </div>
        </div>
    </div>
    
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-offset-10 col-md-2">
                <button type="submit" class="btn btn-default btn-block"><i class="fas fa-filter"></i>Filter</button>
            </div>
        </div>
    </div>
   </form>
</section>
@if(!empty($leavelist))
<section class="panel">
    <header class="panel-heading">
        <h4 class="panel-title">
            <i class="fas fa-list-ul"></i> Leave List
        </h4>
    </header>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-condensed table-export" cellspacing="0" width="100%" id="table-export">
            <thead>
                <tr>
                   <tr>
                        <th>SL</th>
                        <th>Role</th>
                        <th>Applicant</th>
                        <th>Leave Category</th>
                        <th>Date of Start</th>
                        <th>Date of End</th>
                        <th>Days</th>
                        <th>Apply Date</th>
                        <th>Status</th>
                    </tr>
            </thead>
            <tbody>
                 @foreach($leavelist as $row)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$row->role->name}}</td>
                        <td>
                            @if($row->role_id==7)
                                <?php 
                                $getStudent =Helper::getStudentDetails($row->user->student_id);
                                    echo $getStudent['first_name'] . " " . $getStudent['last_name'] . '<br><small> - ' .
                                    $getStudent['class_name'] . ' (' . $getStudent['section_name'] . ')</small>';
                                ?>
                            @else
                                <?php 
                                $getStaff = Helper::get_table('staff', $row->user->staff_id, true);
                                echo $getStaff->name . '<br><small> - ' . $getStaff->staff_id . '</small>';
                                ?>
                            @endif
                        </td>
                        <td>{!! $row->leave->name !!}</td>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endif
<script type="text/javascript">
 $(document).ready(function () {
    $(".selectTwo").themePluginSelect2({
            allowClear: true,
            width: '100%'
    });
    if ($(".daterange").length) {
        $('.daterange').daterangepicker({
                opens: 'left',
            locale: {format: 'YYYY/MM/DD'},
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
               'This Year': [moment().startOf('year'), moment().endOf('year')],
               'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
            }
        });
    }
});
</script>
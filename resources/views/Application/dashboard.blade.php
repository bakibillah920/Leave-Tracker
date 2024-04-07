<header class="page-header">
    <a class="page-title-icon" href="/dashboard"><i class="fas fa-home"></i></a>
    <h2>{{$pageTitle}}</h2>
</header>
<?php
 $leavetotal = collect($leavedata)->count();
 $leavepan = collect($leavedata)->where('status', 1)->count();
 $leaveapp = collect($leavedata)->where('status', 2)->count();
 $leaverej = collect($leavedata)->where('status', 3)->count();
?>
<div class="row widget-1">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="panel">
            <div class="row widget-row-in">
                <div class="col-lg-3 col-sm-6 ">
                    <div class="panel-body">
                        <div class="widget-col-in row">
                            <div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-users"></i>
                                <h5>Leave Requests</h5>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h3 class="counter text-right mt-md text-primary">{!! $leavetotal !!}</h3>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="box-top-line line-color-primary">
                                    <span class="text-uppercase">Total Strength</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="panel-body">
                        <div class="widget-col-in row">
                            <div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-tasks"></i>
                                <h5>Pending Requests</h5> </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h3 class="counter text-right mt-md text-primary">{!! $leavepan !!}</h3>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="box-top-line line-color-primary">
                                    <span class="text-uppercase">Total Strength</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 ">
                    <div class="panel-body">
                        <div class="widget-col-in row">
                            <div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-user-tie"></i>
                                <h5>Approved Requests</h5></div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h3 class="counter text-right mt-md text-primary">{!! $leaveapp !!}</h3>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="box-top-line line-color-primary">
                                    <span class="text-uppercase">Total Strength</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 ">
                    <div class="panel-body">
                        <div class="widget-col-in row">
                            <div class="col-md-6 col-sm-6 col-xs-6"> <i class="fas fa-ban"></i>
                                <h5>Rejected Requests</h5></div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <h3 class="counter text-right mt-md text-primary">{!! $leaverej !!}</h3>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="box-top-line line-color-primary">
                                    <span class="text-uppercase">Total Strength</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
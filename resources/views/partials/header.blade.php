<!doctype html>
<html
    class="fixed sidebar-left-sm dark js flexbox flexboxlegacy no-touch csstransforms csstransforms3d no-overflowscrolling no-mobile-device custom-scroll">

<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Northwest School">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Northwest School">
    <meta name="author" content="Northwest School">
    <title inertia>{{ config('app.name', 'Laravel') }} {{isset($pageTitle) ? '| '.$pageTitle : ''}}</title>

    <link rel="shortcut icon" href="{{asset('/')}}assets/images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- include stylesheet -->
    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Signika:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/font-awesome/css/all.min.css">

    <!-- Jquery Datatables CSS -->

    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/datatables/media/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/select2/css/select2.css">
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- <link rel="stylesheet" href="{{asset('/')}}assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"> -->
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="{{asset('/')}}assets/css/custom-style.css">

    <link rel="stylesheet" href="{{asset('/')}}assets/css/skins/default.css">
    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/sweetalert/sweetalert-custom.css">
    <link href="{{asset('/assets/css/summernote.min.css')}}" rel="stylesheet">

    <!-- jquery -->
    <script src="{{asset('/')}}assets/vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('/')}}assets/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="{{asset('/')}}assets/vendor/modernizr/modernizr.js"></script>
    <script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>
    {{-- date range --}}
    <script src="{{asset('/assets/js/daterange/daterangepicker.min.js')}}" defer></script>

    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" href="{{ asset('assets/js/toastr/toastr.min.css') }}"/>

    <script type="text/javascript" src="{{asset('/')}}assets/vendor/chartjs/chart.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/vendor/echarts/echarts.common.min.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/vendor/moment/moment.js"></script>
    <script type="text/javascript" src="{{asset('/')}}assets/vendor/fullcalendar/fullcalendar.js"></script>
    <script src="{{asset('/assets/js/summernote.min.js')}}"></script>
    <script src="{{asset('/assets/js/bootstrap-datepicker.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap-datepicker.min.css') }}"/>

    <!-- ramom css -->
    <link rel="stylesheet" href="{{asset('/')}}assets/css/ramom.css">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,900|Roboto+Condensed:400,300,700'
          rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('/')}}assets/css/demo.css">
    <link rel="stylesheet" href="{{asset('/')}}assets/css/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="{{asset('/')}}assets/css/dropify.min.css">
    <link rel="stylesheet" href="{{asset('/')}}assets/css/skins/square-borders.css">
    <link rel="stylesheet" href="{{ asset('assets/css/buttons.dataTables.min.css') }}">
    {{-- date range --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/daterange/daterangepicker.css') }}" />

    <link rel="stylesheet" href="{{asset('/')}}assets/vendor/datetimepicker/bootstrap-timepicker.css">
</head>
<body>
<div class="loader-container">
    <div class="lds-dual-ring"></div>
</div>

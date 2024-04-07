<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <meta name="keywords" content="">
    <meta name="description" content="Ramom School Management System">
    <meta name="author" content="RamomCoder">
    <title>Login</title>
    <link rel="shortcut icon" href="{{URL::to('/')}}/assets/images/favicon.png">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Signika:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet"
          href="{{URL::to('/')}}/assets/vendor/datatables/media/css/dataTables.bootstrap.min.css">
    <script src="{{URL::to('/')}}/assets/vendor/jquery/jquery.js"></script>

    <!-- sweetalert js/css -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/vendor/sweetalert/sweetalert-custom.css">
    <script src="{{URL::to('/')}}/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <!-- login page style css -->
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/login_page/css/style.css">
    <script type="text/javascript">
        var base_url = '{{URL::to('/')}}';
    </script>
</head>
<body>
<div class="auth-main">
    <div class="container">
        <div class="slideIn">
            <!-- image and information -->
            <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1 col-sm-12 col-xs-12 no-padding fitxt-center">
                <div class="image-area">
                    <div class="content">
                        <div class="image-hader">
                            <h2>Welcome To</h2>
                        </div>
                        <div class="center img-hol-p">
                            <img src="{{URL::to('/')}}/uploads/app_image/logo.png" height="60"
                                 alt="{{ config('app.name', 'Laravel') }}">
                        </div>
                        <div class="f-social-links center">
                            <a href="#" target="_blank">
                                <span class="fab fa-facebook-f"></span>
                            </a>
                            <a href="#" target="_blank">
                                <span class="fab fa-twitter"></span>
                            </a>
                            <a href="#" target="_blank">
                                <span class="fab fa-linkedin-in"></span>
                            </a>
                            <a href="#" target="_blank">
                                <span class="fab fa-youtube"></span>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- Login -->
            <div class="col-lg-6 col-lg-offset-right-1 col-md-6 col-md-offset-right-1 col-sm-12 col-xs-12 no-padding">
                <div class="sign-area">
                    <div class="sign-hader">
                        <img src="uploads/app_image/logo-small.png" height="54" alt="">
                    </div>
                    <form method="POST" action="{{ route('login') }}"
                          accept-charset="utf-8">
                        @csrf
                        <div class="form-group ">
                            <div class="input-group input-group-icon">
                                        <span class="input-group-addon">
                                            <span class="icon">
                                                <i class="far fa-user"></i>
                                            </span>
                                        </span>
                                <input type="text" class="form-control" name="email" id="email" value=""
                                       placeholder="Email"/>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>
                        <div class="form-group ">
                            <div class="input-group input-group-icon">
                                        <span class="input-group-addon">
                                            <span class="icon"><i class="fas fa-unlock-alt"></i></span>
                                        </span>
                                <input type="password" id="password" class="form-control input-rounded" name="password"
                                       placeholder="Password"/>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                        </div>

                        <div class="forgot-text">
                            <div class="checkbox-replace">
                                <label class="i-checks"><input type="checkbox" name="remember" id="remember"><i></i>
                                    Remember</label>
                            </div>
                            <div class="">
                                <a href="{{ route('password.request') }}">Lose Your Password?</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="btn_submit" class="btn btn-block btn-round">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </button>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('register') }}">
                                <button  type="button" class="btn btn-block btn-round">
                                    <span><i class="fas fa-sign-in-alt"></i> Register</span>
                                </button>
                            </a>
                        </div>
                        <div class="sign-footer">
                            <p>&copy; <?php echo date('Y');?> {{ config('app.name', 'Bakibllah') }} - Developed
                                by {{ config('app.name', 'Laravel') }}</p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{URL::to('/')}}/assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="{{URL::to('/')}}/assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
<script src="{{URL::to('/')}}/assets/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="{{URL::to('/')}}/assets/vendor/datatables/media/js/dataTables.bootstrap.min.js"></script>
<!-- backstretch js -->
<script src="{{URL::to('/')}}/assets/login_page/js/jquery.backstretch.min.js"></script>
<script src="{{URL::to('/')}}/assets/login_page/js/custom.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{$title}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{!! URL::asset('front_assets/css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('front_assets/css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('front_assets/css/responsive.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('front_assets/css/style.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('front_assets/css/style_custom.css') !!}">
    <script type="text/javascript">
        API_BASE_URL = "{!! URL::to('/') !!}/api/";
        BASE_URL = "{!! URL::to('/') !!}";
        URL = "{!! URL::to('/') !!}";
      </script>
</head>
<!-- NAVBAR
================================================== -->

<body class="theme-background">
    <div class="container pure-fill">
        <div class="row" id="section_signin">
            <div class="col-sm-12 inner-height">
                <div class="logo">
                    <a href="{{$app->make('url')->to('/')}}">
                        <img src="front_assets/images/new-transparent-logo.png">
                    </a>
                </div>
                <div class="pure-fill-form">
                    <form name="signin" id="signin" method="post" action="">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="alert alert-danger" id="signin_error" style="display: none">
                            error
                            </div>
                        </div>

                        @if(Session::has('success_message') && Session::get('success_message')!='')
                        <div class="form-group">
                            <div class="alert alert-success">
                            {{Session::get('success_message')}}
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <i class="fa fa-envelope"></i>
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                        </div>

                    
                        <div class="form-group">
                            <i class="fa fa-key"></i>
                            <input type="password" class="form-control" id="pwd" placeholder="Password" name="password">
                        </div>
                        <div class="form-group mb0">
                            <button type="submit" class="btn btn-default" >Sign In</button>
                        </div>
                        <div class="form-group">
                            <p>
                                <a href="javascript:void(0)" id="forgot_password_btn">Forgot Password?</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row" id="section_forgot_password" style="display: none">
            <div class="col-sm-12 inner-height">
                <div class="logo">
                    <img src="front_assets/images/new-transparent-logo.png">
                </div>
                <div class="pure-fill-form">
                    <form id="forgot_password" name="forgot_password">
                        <h1>Forgotten your details?</h1>
                        <p class="info" >Enter your email to retrive your username or reset your password</p>

                        <div class="form-group">
                            <div class="alert alert-danger" id="forgot_error" style="display: none">
                            error
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="alert alert-success" id="forgot_success" style="display: none">
                            error
                            </div>
                        </div>
                        <div class="form-group">
                            <i class="fa fa-envelope"></i>
                            <input type="email" class="form-control" placeholder="Email" name="email" id="f_email">
                        </div>
                        
                        <div class="form-group mb0">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>

                        <div class="form-group">
                            <p>
                                <a href="javascript:void(0)" id="signin_btn">Back</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{!! URL::asset('front_assets/js/jquery.min.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/popper.min.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/owl.carousel.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/bootstrap.min.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/script.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/jquery.validate.js') !!}"></script>
    <script src="{!! URL::asset('front_assets/js/custom_validation.js') !!}"></script>

    <script>

var country = getParameterByName('country');

        function calculateHeight() {

            var height = $(window).outerHeight()
            var contentHight = $('.inner-height').outerHeight();

            if (contentHight > height) {
                height = contentHight;
            }

            $("body").height((height - 0) + 'px');
        }

        function signin() {

            var refferer = document.referrer;

            if (refferer.indexOf('brand-page.html') !== -1) {
                window.location.href = 'brand-wizard.html' + (country === 'aus' ? '?country=aus'  : '');
            } else {
                //window.location.href = 'home-whoop-button.html' + (country === 'aus' ? '?country=aus'  : '') + '#popup5';
                window.location.href = '/' + (country === 'aus' ? '?country=aus'  : '') + '';
            }

            return false;
        }

        calculateHeight();

        window.addEventListener("orientationchange", function () {
            calculateHeight();
        }, false);

        window.addEventListener("resize", function () {
            calculateHeight();
        }, false);

    </script>

</body>

</html>
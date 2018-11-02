
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Register page | Nifty - Admin Template</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="{{asset('assets/css/nifty.min.css') }}" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="{{asset('assets/css/demo/nifty-demo-icons.min.css') }}" rel="stylesheet">


    <!--=================================================-->



    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="{{asset('assets/plugins/pace/pace.min.css') }}" rel="stylesheet">
    <script src="{{asset('assets/plugins/pace/pace.min.js') }}"></script>



    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{asset('assets/css/demo/nifty-demo.min.css') }}" rel="stylesheet">


    <!--=================================================

    REQUIRED
    You must include this in your project.


    RECOMMENDED
    This category must be included but you may modify which plugins or components which should be included in your project.


    OPTIONAL
    Optional plugins. You may choose whether to include it in your project or not.


    DEMONSTRATION
    This is to be removed, used for demonstration purposes only. This category must not be included in your project.


    SAMPLE
    Some script samples which explain how to initialize plugins or components. This category should not be included in your project.


    Detailed information and more samples can be found in the document.

    =================================================-->

</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
<div id="container" class="cls-container">


    <!-- BACKGROUND IMAGE -->
    <!--===================================================-->
    <div id="bg-overlay"></div>


    <!-- REGISTRATION FORM -->
    <!--===================================================-->
    <div class="cls-content">
        <div class="cls-content-lg panel">
            <div class="panel-body">
                <div class="mar-ver pad-btm">
                    <h1 class="h3">Create a New Account</h1>
                    <p> Let's set up your account.</p>
                </div>
                <form action="{{ route('register') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control" placeholder="E-mail" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" placeholder="Password Confirmation" name="password_confirmation" required>
                            </div>

                        </div>
                    </div>
                    <div class="checkbox pad-btm text-left">
                        <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox">
                        <label for="demo-form-checkbox">I agree with the <a href="#" class="btn-link text-bold">Terms and Conditions</a></label>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
                </form>
            </div>
            <div class="pad-all">
                Already have an account ? <a href="{{ route('login') }}" class="btn-link mar-rgt text-bold">Sign In</a>

              
            </div>
        </div>
    </div>
    <!--===================================================-->


    <!-- DEMO PURPOSE ONLY -->
    <!--===================================================-->

    <!--===================================================-->



</div>
<!--===================================================-->
<!-- END OF CONTAINER -->



<!--JAVASCRIPT-->
<!--=================================================-->

<!--jQuery [ REQUIRED ]-->
<script src="{{asset('assets/js/jquery.min.js') }}') }}"></script>


<!--BootstrapJS [ RECOMMENDED ]-->
<script src="{{asset('assets/js/bootstrap.min.js') }}"></script>


<!--NiftyJS [ RECOMMENDED ]-->
<script src="{{asset('assets/js/nifty.min.js') }}"></script>




<!--=================================================-->

<!--Background Image [ DEMONSTRATION ]-->
<script src="{{asset('assets/js/demo/bg-images.js') }}"></script>

</body>
</html>
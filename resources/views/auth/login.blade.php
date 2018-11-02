<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login page | Nifty - Admin Template</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('assets/css/nifty.min.css') }}" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="{{ asset('assets/css/demo/nifty-demo-icons.min.css') }}" rel="stylesheet">


    <!--=================================================-->



    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="{{ asset('assets/plugins/pace/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>



    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{ asset('assets/css/demo/nifty-demo.min.css') }}" rel="stylesheet">


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


    <!-- LOGIN FORM -->
    <!--===================================================-->
    <div class="cls-content">
        <div class="cls-content-sm panel">
            <div class="panel-body">
                <div class="mar-ver pad-btm">
                    <h1 class="h3">Account Login</h1>
                </div>
                {!! Form::open(['route' => 'login', 'method' => 'post']) !!}
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} text-left">
                    <?php if ($errors->has('email')) : ?>
                    <label class="control-label"><?= $errors->first('email'); ?></label>
                    <?php endif; ?>
                    <input type="email" name="email" class="form-control" placeholder="Email" autofocus>
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} text-left">
                    <?php if ($errors->has('password')) : ?>
                    <label class="control-label"><?= $errors->first('password'); ?></label>
                    <?php endif; ?>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="checkbox pad-btm text-left">
                    <input name="remember" {{ old('remember') ? 'checked' : '' }} id="demo-form-checkbox" class="magic-checkbox" type="checkbox">
                    <label for="demo-form-checkbox">Remember me</label>
                </div>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
                {!! Form::close() !!}
            </div>

     <div class="pad-all">

		            <a href="/register" class="btn-link mar-lft">Tạo tài khoản mới</a>
		
		         
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
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>


<!--BootstrapJS [ RECOMMENDED ]-->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>


<!--NiftyJS [ RECOMMENDED ]-->
<script src="{{ asset('assets/js/nifty.min.js') }}"></script>




<!--=================================================-->

<!--Background Image [ DEMONSTRATION ]-->
<script src="{{ asset('assets/js/demo/bg-images.js') }}"></script>

</body>
</html>

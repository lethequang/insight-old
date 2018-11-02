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
          <p>Sign In to your account</p>
        </div>
        <form action="{{ route('post.login') }}" method="post">
          {{ csrf_field() }}
          <div class="form-group <?=isset(session('error')['staff_email']) ? 'has-error' : ''  ?>">
            <?php if(isset(session('error')['staff_email'])): ?>
            <label class="control-label"><?=session('error')['staff_email'][0] ?></label>
            <?php endif; ?>
            <input type="email" class="form-control" name="staff_email" value="{{ old('staff_email') }}" placeholder="Email" autofocus>
          </div>
          <div class="form-group <?=isset(session('error')['staff_password']) ? 'has-error' : ''  ?>">
            <?php if(isset(session('error')['staff_password'])): ?>
            <label class="control-label"><?=session('error')['staff_password'][0] ?></label>
            <?php endif; ?>
            <input type="password" class="form-control" name="staff_password" value="{{ old('staff_password') }}" placeholder="Password">
          </div>
          <div class="checkbox pad-btm text-left">
            <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox">
            <label for="demo-form-checkbox">Remember me</label>
          </div>
          <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
        </form>
      </div>

      <div class="pad-all">
        <a href="pages-password-reminder.html" class="btn-link mar-rgt">Forgot password ?</a>
        <a href="pages-register.html" class="btn-link mar-lft">Create a new account</a>

        <div class="media pad-top bord-top">
          <div class="pull-right">
            <a href="#" class="pad-rgt"><i class="demo-psi-facebook icon-lg text-primary"></i></a>
            <a href="#" class="pad-rgt"><i class="demo-psi-twitter icon-lg text-info"></i></a>
            <a href="#" class="pad-rgt"><i class="demo-psi-google-plus icon-lg text-danger"></i></a>
          </div>
          <div class="media-body text-left text-bold text-main">
            Login with
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--===================================================-->

  <!-- DEMO PURPOSE ONLY -->
  <!--===================================================-->
  <div class="demo-bg">
    <div id="demo-bg-list">
      <div class="demo-loading"><i class="psi-repeat-2"></i></div>
      <img class="demo-chg-bg bg-trans active" src="{{ asset('assets/img/bg-img/thumbs/bg-trns.jpg') }}" alt="Background Image">
      <img class="demo-chg-bg" src="/public/assets/img/bg-img/thumbs/bg-img-1.jpg" alt="Background Image">
      <img class="demo-chg-bg" src="/public/assets/img/bg-img/thumbs/bg-img-2.jpg" alt="Background Image">
      <img class="demo-chg-bg" src="/public/assets/img/bg-img/thumbs/bg-img-3.jpg" alt="Background Image">
      <img class="demo-chg-bg" src="/public/assets/img/bg-img/thumbs/bg-img-4.jpg" alt="Background Image">
      <img class="demo-chg-bg" src="/public/assets/img/bg-img/thumbs/bg-img-5.jpg" alt="Background Image">
      <img class="demo-chg-bg" src="/public/assets/img/bg-img/thumbs/bg-img-6.jpg" alt="Background Image">
      <img class="demo-chg-bg" src="/public/assets/img/bg-img/thumbs/bg-img-7.jpg" alt="Background Image">
    </div>
  </div>
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

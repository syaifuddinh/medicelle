<?php 
    $errors = json_decode($errors);
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Medicelle </title>

    <!-- Bootstrap -->
    <link href="{{ asset('') }}vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('') }}vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('') }}vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('') }}vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('') }}build/css/custom.min.css" rel="stylesheet">
    <link href="{{ asset('') }}css/classic.css" rel="stylesheet">

  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <div>
              @if($errors)
                @foreach($errors->username as $error)
                  <div class="alert alert-danger alert-dismissible fade in" role="alert">
                      
                      {{ $error }}
                  </div>
                @endforeach
              @endif
            </div>
            <form action='/login' method='post'>
              {{ csrf_field() }}
              <h1 class="modal-title">LOGIN USER</h1>
              <div>
                <input type="text" class="form-control" name='username' placeholder="Username" required="" autofocus />
              </div>
              <div>
                <input type="password" class="form-control" name='password' placeholder="Password" required="" />
              </div>
              <div>
                <button class="btn btn-default submit">Log in</button>
                <!--<a class="reset_pass" href="#">Lost your password?</a>-->

              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <!--<p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>-->

                <div class="clearfix"></div>
                <br />

                <div>
                  <img src="{{ Mod::company()->logo }}" class="img-responsive" alt="">
                  <p style='margin-top:2mm'>©2016 All Rights Reserved, Medicelle Clinic. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <link rel='stylesheet' id='norebro-global-fonts-css'  href='//fonts.googleapis.com/css?family=Rubik%3A900i%2C900%2C700i%2C700%2C500i%2C500%2C400i%2C400%2C300i%2C300%7CPoppins%3A700%2C600%2C500%2C400%2C300%26subset%3Dcyrillic%2Clatin-ext%2Chebrew%2Ccyrillic%2Clatin-ext%2Chebrew%2Clatin-ext%2Cdevanagari%2Clatin-ext%2Cdevanagari%2Clatin-ext%2Cdevanagari%2Clatin-ext%2Cdevanagari%2Clatin-ext%2Cdevanagari%2Clatin-ext%2Cdevanagari%2Ccyrillic%2Clatin-ext%2Chebrew%2Ccyrillic%2Clatin-ext%2Chebrew%2Ccyrillic%2Clatin-ext%2Chebrew%2Ccyrillic%2Clatin-ext%2Chebrew%2Ccyrillic%2Clatin-ext%2Chebrew%2Ccyrillic%2Clatin-ext%2Chebrew&#038;ver=1.0.0' type='text/css' media='all' />
    <script>
        $(document).ready(function(){

            var inputs = $(':input').keypress(function(e){ 
                if (e.which == 13) {
                   e.preventDefault();
                   var nextInput = inputs.get(inputs.index(this) + 1);
                   if (nextInput) {
                      nextInput.focus();
                   }
                }
            });
        });
    </script>
  </body>
</html>

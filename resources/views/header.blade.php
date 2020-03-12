<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ Mod::company()->name }}</title>

    <!-- Bootstrap -->
    <link href="{{ asset('') }}vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('') }}css/classic.css" rel="stylesheet">
    <link href="{{ asset('') }}css/classic.date.css" rel="stylesheet">
    <link href="{{ asset('') }}css/classic.time.css" rel="stylesheet">


    <!-- Font Awesome -->
    <link href="{{ asset('') }}vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <!-- iCheck -->
    <link href="{{ asset('') }}css/rzslider.min.css" rel="stylesheet">
    <link href="{{ asset('') }}css/toastr.css" rel="stylesheet">
    <link href="{{ asset('') }}css/easy-autocomplete.min.css" rel="stylesheet">
    <link href="{{ asset('') }}css/bootstrap-chosen.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="{{ asset('') }}build/css/custom.min.css" rel="stylesheet">
    <link href="{{ asset('') }}vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('') }}vendors/select2/dist/css/select2.min.css" rel="stylesheet">

    <script>
        baseUrl = '{{ url('') }}'
    </script>
  </head>

  <body class="nav-md" ng-app='klinikApp' ng-cloak>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ url('') }}" class="site_title"><i class="fa fa-medkit"></i> <span>{{ Mod::company()->name }}</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ Auth::user()->avatar_url }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat datang,</span>
                <h2>
                  <a href="{{ route('user.edit', ['id' => Auth::user()->id ]) }}" style="color:white;opacity:0.7">
                      {{ Auth::user()->name }}
                  </a>
                </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            @include('sidebar')

            
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ Auth::user()->avatar_url }}" alt="">{{ Auth::user()->admin }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ route('user.edit', ['id' => Auth::user()->id ]) }}"> Profil</a></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge bg-green" id='unread-notif-qty'>0</span>
                  </a>
                  <ul id="notif-container" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <div class="text-center">
                        <a href='{{ route("notification.index") }}'>
                          <strong>Lihat Semua Pemberitahuan</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                  


                </li>
              </ul>
            </nav>
          </div>
        </div>
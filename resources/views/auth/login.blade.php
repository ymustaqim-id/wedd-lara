
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">

    <title>Login V3 | Remark Material Admin Template</title>

    <link rel="apple-touch-icon" href="{{ asset('admin_remark_base/') }}/assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="{{ asset('admin_remark_base/') }}/assets/images/favicon.ico">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/assets/css/site.min.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/waves/waves.css">
        <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/assets/examples/css/pages/login-v3.css">


    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/fonts/material-design/material-design.min.css">
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <!--[if lt IE 9]>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/media-match/media.match.min.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/breakpoints/breakpoints.js"></script>
    <script>
      Breakpoints();
    </script>
  </head>
  <body class="animsition page-login-v3 layout-full">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


    <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
      <div class="page-content vertical-align-middle">
        <div class="panel">
          <div class="panel-body">
            <div class="brand">
              <img class="brand-img" src="{{ asset('admin_remark_base/') }}/assets//images/logo-colored.png" alt="...">
              <h2 class="brand-text font-size-18">Remark</h2>
            </div>
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group form-material floating" data-plugin="formMaterial">
                <input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" >

                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
                <label class="floating-label">Username</label>
              </div>
              <div class="form-group form-material floating" data-plugin="formMaterial">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <label class="floating-label">Password</label>
              </div>
              <div class="form-group clearfix">
                <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                  <input type="checkbox" id="inputCheckbox" name="remember">
                  {{-- <label for="inputCheckbox">Remember me</label> --}}
                </div>
                <a class="float-right" href="forgot-password.html">Forgot password?</a>
              </div>
              <button type="submit" class="btn btn-primary btn-block btn-lg mt-40">Sign in</button>
            </form>
            {{-- <p>Still no account? Please go to <a href="register-v3.html">Sign up</a></p> --}}
          </div>
        </div>

        <footer class="page-copyright page-copyright-inverse">
          {{-- <p>WEBSITE BY Creation Studio</p> --}}
          {{-- <p>© 2018. All RIGHT RESERVED.</p> --}}
          <div class="social">
            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
            <a class="btn btn-icon btn-pure" href="javascript:void(0)">
            <i class="icon bd-google-plus" aria-hidden="true"></i>
          </a>
          </div>
        </footer>
      </div>
    </div>
    <!-- End Page -->


    <!-- Core  -->
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/jquery/jquery.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/popper-js/umd/popper.min.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/bootstrap/bootstrap.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/animsition/animsition.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/asscrollable/jquery-asScrollable.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/waves/waves.js"></script>

    <!-- Plugins -->
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/switchery/switchery.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/intro-js/intro.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/screenfull/screenfull.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/slidepanel/jquery-slidePanel.js"></script>
        <script src="{{ asset('admin_remark_base/') }}/global/vendor/jquery-placeholder/jquery.placeholder.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('admin_remark_base/') }}/global/js/Component.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/js/Plugin.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/js/Base.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/js/Config.js"></script>

    <script src="{{ asset('admin_remark_base/') }}/assets/js/Section/Menubar.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/assets/js/Section/GridMenu.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/assets/js/Section/Sidebar.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/assets/js/Section/PageAside.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/assets/js/Plugin/menu.js"></script>

    <script src="{{ asset('admin_remark_base/') }}/global/js/config/colors.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/assets/js/config/tour.js"></script>
    <script>Config.set('assets', '{{ asset('admin_remark_base/') }}/assets');</script>

    <!-- Page -->
    <script src="{{ asset('admin_remark_base/') }}/assets/js/Site.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/js/Plugin/asscrollable.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/js/Plugin/slidepanel.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/js/Plugin/switchery.js"></script>
        <script src="{{ asset('admin_remark_base/') }}/global/js/Plugin/jquery-placeholder.js"></script>
        <script src="{{ asset('admin_remark_base/') }}/global/js/Plugin/material.js"></script>

    <script>
      (function(document, window, $){
        'use strict';

        var Site = window.Site;
        $(document).ready(function(){
          Site.run();
        });
      })(document, window, jQuery);
    </script>

  </body>
</html>

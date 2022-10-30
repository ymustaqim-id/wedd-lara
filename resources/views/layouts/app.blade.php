
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">

    <title>Dashboard | Remark Material Admin Template</title>

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
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/typeahead-js/typeahead.css">
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/bootstrap-sweetalert/sweetalert.css">
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/toastr/toastr.css">
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/assets/examples/css/advanced/toastr.css">

    <!-- datatable -->
        <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-bs4/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css">
        <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css">
        <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css">
        <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css">
        <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css">
        <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css">
        <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css">
        <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/assets/examples/css/tables/datatable.css">


    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/fonts/material-design/material-design.min.css">
    <link rel="stylesheet" href="{{ asset('admin_remark_base/') }}/global/fonts/brand-icons/brand-icons.min.css">
    <!-- <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'> -->

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
  <body class="animsition dashboard">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    @include('layouts.inc.header')
    <!-- Page -->
    <div class="page">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <div class="page-content container-fluid">
        @yield('content')
      </div>
    </div>
    <!-- End Page -->


    <!-- Footer -->
    <footer class="site-footer">
      <div class="site-footer-legal">© 2018 <a href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">Remark</a></div>
      <div class="site-footer-right">
        Crafted with <i class="red-600 icon md-favorite"></i> by <a href="https://themeforest.net/user/creation-studio">Creation Studio</a>
      </div>
    </footer>
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
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/formvalidation/formValidation.min.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/formvalidation/framework/bootstrap4.min.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/typeahead-js/bloodhound.min.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/typeahead-js/typeahead.jquery.min.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/typeahead-js/handlebars.min.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/bootstrap-sweetalert/sweetalert.js"></script>
    <script src="{{ asset('admin_remark_base/') }}/global/vendor/toastr/toastr.js"></script>
    {{-- <script src="{{ asset('admin_remark_base/') }}/global/vendor/jquery-placeholder/jquery.placeholder.js"></script> --}}
    <!-- datatable -->
      <script src="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net/jquery.dataTables.js"></script>
      <script src="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-bs4/dataTables.bootstrap4.js"></script>
      <script src="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-fixedheader/dataTables.fixedHeader.js"></script>
      <script src="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.js"></script>
      <script src="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-rowgroup/dataTables.rowGroup.js"></script>
      <script src="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-scroller/dataTables.scroller.js"></script>
      <script src="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-responsive/dataTables.responsive.js"></script>
      <script src="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.js"></script>
      <script src="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-buttons/dataTables.buttons.js"></script>
      <script src="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-buttons/buttons.html5.js"></script>
      <script src="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-buttons/buttons.flash.js"></script>
      <script src="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-buttons/buttons.print.js"></script>
      <script src="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-buttons/buttons.colVis.js"></script>
      <script src="{{ asset('admin_remark_base/') }}/global/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.js"></script>
      {{-- <script src="{{ asset('admin_remark_base/') }}/global/vendor/asrange/jquery-asRange.min.js"></script> --}}
      <script src="{{ asset('admin_remark_base/') }}/global/vendor/bootbox/bootbox.js"></script>

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

    <script src="{{ Asset('custom/dialog.js')}}" type="text/javascript"></script>
    <script>

      @if ($errors->any())
        @foreach ($errors->all() as $error)
          notification("{!! $error !!}","error");
        @endforeach
      @endif
      @if(Session::get('messageType'))
        notification("{!! Session::get('message') !!}","{!! Session::get('messageType') !!}");
        <?php
        Session::forget('messageType');
        Session::forget('message');
        ?>
      @endif

    (function(document, window, $){
        'use strict';

        var Site = window.Site;
        $(document).ready(function(){
          Site.run();
        });
      })(document, window, jQuery);
      // $( document ).ready(function() {
      //   // modals untuk menampilkan halaman form
      //   $('.data-modal').click(function(){
      //     $.ajax({
      //         url: $(this).attr('value'),
      //         dataType: 'text',
      //         success: function(data) {
      //           $("#formModal").html(data);
      //           $("#formModal").modal('show');
      //           // todo:  add the html to the dom...
      //         }
      //       });
      //     });
      // });
    </script>
    @yield('js')
    @stack('js')

  </body>
</html>

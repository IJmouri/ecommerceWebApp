<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard 2</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{ asset('backend')}}/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('backend')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('backend')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend')}}/dist/css/adminlte.min.css">
  <!-- alert -->
  <link rel="stylesheet" href="{{ asset('backend')}}/plugins/sweetalert2/sweetalert2.css">
  <link rel="stylesheet" href="{{ asset('backend')}}/plugins/toastr/toastr.css">
  
</head>
<!-- <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> -->

<body>
  @guest

  @else
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    @include('layouts.admin_partial.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    
    @include('layouts.admin_partial.sidebar')

    @endguest
    <!-- Content Wrapper. Contains page content -->

    @yield('admin_content')
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->

  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="{{ asset('backend')}}/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('backend')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('backend')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('backend')}}/dist/js/adminlte.js"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="{{ asset('backend')}}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="{{ asset('backend')}}/plugins/raphael/raphael.min.js"></script>
  <script src="{{ asset('backend')}}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="{{ asset('backend')}}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="{{ asset('backend')}}/plugins/chart.js/Chart.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <!-- <script src="{{ asset('backend')}}/dist/js/demo.js"></script> -->
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{asset('/backend/dist/js/pages/dashboard2.js')}}"></script>
  <script src="{{asset('/backend/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
  <script src="{{asset('/backend/plugins/toastr/toastr.min.js')}}"></script>
  
  <script>
    $(document).on("click","#adminlogout",function(e){
      e.preventDefault();
      var link = $(this).attr("href");
        Swal.fire({
          title: 'Do you want to logout?',
          text: '',
          icon: 'success',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes'
        })
        .then((result) => {
          if(result.isConfirmed){
            window.location.href = link;
          }else{
            Swal.fire("Not logout");
          }
        });
    });
  </script>
  <script>
    @if(Session::has('message'))
      var type="{{ Session::get('alert-type','info')}}"
      switch(type){
        case 'info':
          toastr.info("{{ Session::get('message')}}");
          break;
        case 'success':
          toastr.success("{{ Session::get('message')}}");
          break;
        case 'warning':
          toastr.warning("{{ Session::get('message')}}");
          break;
        case 'error':
          toastr.error("{{ Session::get('message')}}");
          break;
      }
    @endif
  </script>
</body>

</html>
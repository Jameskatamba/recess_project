<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <script type="text/css" media="print">

    body{visibility:hidden;}
    .print{visibility:visible;}
    
  </script>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{config('app.name')}}</title>

  <!-- Custom fonts for this template-->
  <link href="/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>


<body id="page-top">

  @if (session()->has('success'))
  <center>
     <div class="alert alert-success" id="popup_notification" class="pri">
        {{ session('success') }}
    </div>
  </center>
   
@endif

 @if (session()->has('error'))
  <center>
     <div class="alert alert-danger" id="popup_notification" class="pri">
        {{ session('error') }}
    </div>
  </center>
   
@endif


@if (session()->has('info'))
  <center>
     <div class="alert alert-info" id="popup_notification" class="pri">
        {{ session('info') }}
    </div>
  </center>
   
@endif


  <!-- Page Wrapper -->
  <div id="wrapper" class="container-fluid">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{config('app.name')}}</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="home">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>{{config('app.name')}} Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      
      <!-- Nav Item - Pages Collapse Menu -->
      

 
      <!-- Nav Item - Utilities Collapse Menu -->
     
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          </div>
      </li>

  <div class="sidebar-heading">
       Registrations
      </div>

      <li class="nav-item">
        <a class="nav-link" href="registerDistrict" >
          <i class="fas fa-fw fa-table"></i>
          <span>District Registration</span></a>
      </li>

        <li class="nav-item">
        <a class="nav-link" href="registerAgent" >
          <i class="fas fa-fw fa-table"></i>
          <span>Agent registration</span></a>
      </li>


<li class="nav-item">
        <a class="nav-link" href="donation" >
          <i class="fas fa-fw fa-table"></i>
          <span>Donations Registration</span></a>
      </li>
   

<li class="nav-item">
        <a class="nav-link" href="registerDistrict" >
          <i class="fas fa-fw fa-table"></i>
          <span>District Registration</span></a>
      </li>


      <!-- Heading -->
      <div class="sidebar-heading">
       Statistics &  Tables
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      
<hr class="sidebar-divider d-none d-md-block">
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="charts">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Chart for donations</span></a>
      </li>

 <li class="nav-item">
        <a class="nav-link" href="chart2">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Chart for Members</span></a>
      </li>


<hr class="sidebar-divider d-none d-md-block">
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="agents">
          <i class="fas fa-fw fa-table"></i>
          <span>All agents table</span></a>
      </li>
<hr class="sidebar-divider d-none d-md-block">


<li class="nav-item">
        <a class="nav-link" href="dontable">
          <i class="fas fa-fw fa-table"></i>
          <span>All donations table</span></a>
      </li>
<hr class="sidebar-divider d-none d-md-block">
<li class="nav-item">
        <a class="nav-link" href="tables">
          <i class="fas fa-fw fa-table"></i>
          <span>All districts table</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <li class="nav-item">
        <a class="nav-link" href="payment">
          <i class="fas fa-fw fa-table"></i>
          <span>payments</span></a>
      </li>



<li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        
          <span>Members tables</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Member tables</h6>
            <a class="collapse-item" href="girl"> By agents</a>
            
            <a class="collapse-item" href="bydistrict"> By District</a>
            
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="high" >
          <i class="fas fa-fw fa-table"></i>
          <span>AGENT HIERRACHIES</span></a>
      </li>





      <!-- Sidebar Toggler (Sidebar) -->
      
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
       

      <!-- Main Content -->
      <div id="content">
       <!-- Topbar -->

 <nav class="navbar navbar-expand navbar-dark bg-green">
            <div class="container-fluid">
                <a class="" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" class="navbar-form">
                                 
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"></h1>

         
        </div>
        <center>
      
          <button type="button" class="btn btn-primary btn-sm ">
            <span class=""></span class="glyphicon glyphicon-print"> <a  onclick="window.print();return false;">Print page </a>
          </button>
       

        </center>
         
         @yield('content')

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; {{config('app.name')}} 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 
  <!-- Bootstrap core JavaScript-->
  <script src="/admin/vendor/jquery/jquery.min.js"></script>
  <script src="/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="/admin/js/sb-admin-2.min.js"></script>

</body>

</html>

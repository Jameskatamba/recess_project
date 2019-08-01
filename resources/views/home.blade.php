@extends('layouts.form2')
 @section('content')
 <hr>
<body class='' bgcolor='' >
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}

               
  
                        </div>
                    @endif


<div class="row justify-content-center"  class="col-md-40">
     <h1 class="h3 mb-0 text-gray-800"></h1>
<div class="row justify-content-center"  class="col-md-50">
               <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-20">
           
          <div class="row"  size="40">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-8 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-5">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="dontable">Earnings (Monthly)</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a href="girl">Members</a></div>
                 
     <div class="h5 mb-0 font-weight-bold text-gray-800">  <!--ishould add something here --> </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-3"><a href="upgrade">Upgrades</a></div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> <!-- i should add somthing here --></div>
                        </div>
                        <div class="col">
                          <div >
                            <div class="card border-left-info shadow h-100 py-2" role="progressbar"   aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a href="upgrade">Upgrade Requests</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

<hr>

  </div>
            </div>
          </div>
        </div>
    </div>
</div>
</body>
 @endsection

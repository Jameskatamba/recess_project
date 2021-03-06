@extends('layouts.form2')
@section('content')
<body class="card-body">
  <div class="container">
 <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Register new district here </h1>
              </div>
              <form class="user" method="POST" action="/mime">
            {{csrf_field()}}
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="DName"  id="DName"  placeholder="District Name">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="DInitial" id ="DInitial"  placeholder="District initial ">
                  </div>
                </div>
                
                <div class="form-group">
                  <input type="submit" class="btn btn-primary btn-user btn-block"  id="btn-btn .btn-facebook"   value="Register District">
          </form>
          </div>
 
                </div>
                <hr>
          @endsection('content')   
  


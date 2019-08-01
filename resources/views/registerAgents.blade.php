@extends('layouts.form2')
<head>

</head>
@section('content')
 <center>
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
                <h1 class="h4 text-gray-900 mb-4">Register Agents</h1>
              </div>

              <div class="card-body">
                
              <form class="user" method="POST" action="/second">
              {{csrf_field()}} 
                <div class="form-group row">
                  <div class="col-sm-12 mb-6 mb-sm-4">
                      <hr>
                    <input type="text" class="form-control form-control-user"   data-validate-field="text"  id="text" name="fname"  placeholder="First Name">
                  
                   <hr>
                    <input type="text" class="form-control form-control-user"  data-validate-field="text"   id="text" name="lname" id="name"placeholder="Last Name">

                  <hr>
                  <input type="email" class="form-control form-control-user" name="email" id="email"  data-validate-field="email"  placeholder="Email Address">
              
                   <hr>
                    <input type="text"  id="text" class="form-control form-control-user" name="signature" id="text"  data-validate-field="text"  placeholder="Agent signature">
                    <hr>
                  Gender 
                  <hr>
                   <div class="form-group">
                    male      <input type='radio' value ="male"   form__radio name ="gender" class="form__radio" >||||||||||||||||||||||||||||||||||
                 female<span><input type='radio' value ="female" name ="gender" class="form__radio" ></span> 
                
                   </div>
                    <hr>
                  
               <input type="submit" class="btn btn-primary btn-user btn-block"   value="Register Agent">
               </form>
               </center>
                </div>
                </div>
                </div>
                <hr>
               
          @endsection   
  <script src="/admin/js/form.js"></script>



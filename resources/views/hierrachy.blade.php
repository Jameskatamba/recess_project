<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
<!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
 <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
 <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
@extends('layouts.form2')
@section('content')
<hr>

<body id="page-top">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          
          <p class="mb-4">Hirrachies for all Districts </p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            
            <div class="card-body">
              <div class="table-responsive">
                @foreach($data as $value)
                <center>
                  <hr>
                
                  <label>  <button type="button" class="btn btn-info  btn-lg">Hierrachy for {{$value->districtName}}</button></label>
                  <hr>
               <label>  <button type="button" class="btn btn-danger btn-lg">{{$value->firstName}}  {{$value->LastName}}</button></label>
               <br>^<br>|<br>|<br>|<br>|<br>|<br>|<br>|<br>
           
             <label>   <a href="agents"><button type="button" class="btn btn-warning btn-lg">Other Agents</button></a></label><br>^<br>|<br>|<br>|<br>|<br>|<br>|<br>|<br>
                
           
                <label>  <button type="button" class="btn btn-primary  btn-lg">Members</button></label>
                
                @endforeach

               <hr>
                
                </center>
                <p>KEY :</p>
               <label>  <button type="button" class="btn btn-info">District Name</button></label>
                <br>
                <label>  <button type="button" class="btn btn-danger">Agent Head</button></label>
                <br>
                <a href="agents"><button type="button" class="btn btn-warning">Other Agents</button></a> 
                <br>
                 
                <button type="button" class="btn btn-primary">Members</button>

             
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>






  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->

 
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>
@endsection

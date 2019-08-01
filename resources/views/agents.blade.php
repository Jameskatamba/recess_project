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


<body id="page-top">

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-5 text-gray-800">All {{config('app.name')}} tables</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-8">
            <div class="card-header py-3">
              <h6 class="m-6 font-weight-bold text-primary">All agents tables </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
             
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5">
                  <thead>
                    <tr>
                      <th>Agent id</th>
                      <th>First name</th>
                      <th>Last name</th>
                      <th>E-mail</th>
                      <th>Agent's signature</th>
                      <th>Gender</th>
                      <th>District</th>
                      </tr>
                  </thead>
                  <tfoot>
                  
                     <th>Agent id</th>
                      <th>First name</th>
                      <th>Last name</th>
                      <th>E-mail</th>
                      <th>Agent's signature</th>
                      <th>Gender</th>
                      <th>District</th>
                      </tr>
                  </tfoot>
                  <tbody>
                      @foreach($data  as $value)
                    <tr>
                    <td>{{$value ->AgentId}}</td>
                      <td>{{$value ->firstName}}</td>
                       <td>{{$value ->lastName}}</td>
                      <td>{{$value ->email}}</td>
                       <td>{{$value ->agentSignature}}</td>
                      <td>{{$value ->gender}}</td>
                      <td>{{$value ->DistrictName}}</td>
                       </tr>
                     @endforeach
                   </tbody>
                </table>
          
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

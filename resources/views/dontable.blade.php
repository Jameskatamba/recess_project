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

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Donations or funds table </h6>
                                       
            </div>
            <div class="card-body">
              <div class="table-responsive">

             
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Donation id</th>
                      <th>Donor's name</th>
                      <th>Amount</th>
                       <th>Registered at</th>
                      <th>Updated at</th>
                      </tr>
                  </thead>
                  <tfoot>
                   
                    <tr>
                      <th>FOR SHARING:</th>
                      <th></th>
                       <th>UGSHS:{{$xampp-2000000}}</th>
                      </tr>
                  </tfoot>
                  
                  <tbody>
                      @foreach($data as $value)
                    <tr>
                      <td>{{$value ->DonationId}}</td>
                      <td>{{$value ->DonorName}}</td>
                      <td>UGSHS: {{$value ->amount}}</td>
                      <td>{{$value ->created_at}}</td>
                      <td>{{$value ->updated_at}}</td>
                       @endforeach
                      
                       </tr>
                    
                   </tbody>
                   <tfoot>
                  <th>TOTAL:</th>
                   <th></th>
                  <th>UGSHS: {{$xampp}}</th>
                  
                  </tfoot>

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

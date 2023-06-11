<?php
session_start();

if ($_SESSION["status"] != true){

    header("Location: t/login.php");
}

?>

<?php

    function ordinal($number) 
    {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($number % 100) >= 11) && (($number%100) <= 13))
        return $number. 'th';
        else
        return $number. $ends[$number % 10];
    }

?>

<?php  
 $connect = mysqli_connect("localhost", "root", "", "dietary");  
 $query = "SELECT gender, count(*) as number FROM checkup GROUP BY gender";  
 $result = mysqli_query($connect, $query);  
 ?> 

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CKD monitoring</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>   
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/Chart.min.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

         <!-- Sidebar -->
         <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-balance-scale"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Admin Panel</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<div class="sidebar-heading">
                Balance Sheet
</div>
            
<li class="nav-item">
    <a class="nav-link" href="patients.php">
        <i class="fas fa-fw fa-male"></i>
        <span>Patients</span></a>
</li>  

<li class="nav-item">
    <a class="nav-link" href="contact.php">
        <i class="fas fa-fw fa-message"></i>
        <span>Contact</span></a>
</li>



<div class="sidebar-heading">
        Security
</div>             
<li class="nav-item">
    <a class="nav-link" href="admins.php">
        <i class="fas fa-fw fa-lock"></i>
        <span>Admins</span></a>
</li>
        

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


            



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>




                        

                        

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Online Check-ups</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                include 't/db_conn.php';
                
                                                $query = "SELECT id FROM checkup ORDER BY id";  
                                                $query_run = mysqli_query($conn, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo $row.'</h4>';
                                            ?>  </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-male fa-2x text-gray-300"></i>
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
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Messages</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                include 't/db_conn.php';
                
                                                $query = "SELECT id FROM contact ORDER BY id";  
                                                $query_run = mysqli_query($conn, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo $row.'</h4>';
                                            ?>  </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-message fa-2x text-gray-300"></i>
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
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Patients
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                
                                            <?php
                                                include 't/db_conn.php';
                
                                                $query = "SELECT id FROM usertable ORDER BY id";  
                                                $query_run = mysqli_query($conn, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo $row.'</h4>';
                                            ?>  </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-check fa-2x text-gray-300"></i>
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
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Admins</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                include 't/db_conn.php';
                
                                                $query = "SELECT id FROM Admins ORDER BY id";  
                                                $query_run = mysqli_query($conn, $query);
                                                $row = mysqli_num_rows($query_run);
                                                echo $row.'</h4>';
                                            ?>  </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-lock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

<!-- Area Chart -->
<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Patient Stages</h6>
        </div>
        <div class="card-body">
        <?php
        include 't/db_conn.php';
            $sql = "SELECT COUNT(*) as total FROM checkup WHERE CKD_Status = 'Stage 1 normal'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $stage1 = $row['total'];

            $sql = "SELECT COUNT(*) as total FROM checkup WHERE CKD_Status = 'Stage 2 Mild'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $stage2 = $row['total'];

            $sql = "SELECT COUNT(*) as total FROM checkup WHERE CKD_Status = 'Stage 3A Moderate'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $stage3 = $row['total'];

            $sql = "SELECT COUNT(*) as total FROM checkup WHERE CKD_Status = 'Stage 3B Moderate'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $stage3b = $row['total'];

            $sql = "SELECT COUNT(*) as total FROM checkup WHERE CKD_Status = 'Stage 4 Severe'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $stage4 = $row['total'];

            $sql = "SELECT COUNT(*) as total FROM checkup WHERE CKD_Status = 'Stage 5 End Stage'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $stage5 = $row['total'];


            mysqli_close($conn);

        ?>
            <h4 class="small font-weight-bold">Stage #1 <span
                    class="float-right"><?= $stage1 ?></span></h4>
            <div class="progress mb-4">
                <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $stage1 ?>%"
                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <h4 class="small font-weight-bold">Stage #2 <span
                    class="float-right"><?= $stage2 ?></span></h4>
            <div class="progress mb-4">
                <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $stage2 ?>%"
                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <h4 class="small font-weight-bold">Stage #3A <span
                    class="float-right"><?= $stage3 ?></span></h4>
            <div class="progress mb-4">
                <div class="progress-bar" role="progressbar" style="width: <?= $stage3 ?>%"
                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <h4 class="small font-weight-bold">Stage #3B <span
                    class="float-right"><?= $stage3 ?></span></h4>
            <div class="progress mb-4">
                <div class="progress-bar" role="progressbar" style="width: <?= $stage3b ?>%"
                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <h4 class="small font-weight-bold">Stage #4 <span
                    class="float-right"><?= $stage4 ?></span></h4>
            <div class="progress mb-4">
                <div class="progress-bar bg-info" role="progressbar" style="width: <?= $stage4 ?>%"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <h4 class="small font-weight-bold">Stage #5 <span
                    class="float-right"><?= $stage5 ?></span></h4>
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: <?= $stage5 ?>%"
                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>
</div> 
<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Gender analytics</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-pie pt-4 pb-2">
                <canvas id="myPieChart"></canvas>
            </div>
            <div class="mt-4 text-center small">
                <span class="mr-2">
                    <i class="fas fa-circle text-primary"></i> Male
                </span>
                <span class="mr-2">
                    <i class="fas fa-circle text-success"></i> Female
                </span>
            </div>
        </div>
    </div>
</div>
</div>




                    


        

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="t/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <?php
    include 't/db_conn.php';
        $sql = "SELECT COUNT(*) as total FROM checkup WHERE gender = 'Male'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $male = $row['total'];

        $sql = "SELECT COUNT(*) as total FROM checkup WHERE gender = 'Female'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $female = $row['total'];

        mysqli_close($conn);

?>

    <script type="text/javascript">
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Male", "Female"],
        datasets: [{
        data: [<?php echo json_encode($male); ?>, <?php echo json_encode($female); ?>],
        backgroundColor: ['#4e73df', '#1cc88a'],
        hoverBackgroundColor: ['#2e59d9', '#17a673'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        },
        legend: {
        display: false
        },
        cutoutPercentage: 80,
    },
    });
    </script>



    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>
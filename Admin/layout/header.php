<?php
function html_header($active) {

	$Dashboard = "";

	$Manage_Department = "";
	$Add_New_Department = "";

    $Manage_Program = "";
    $Add_New_Program="";

    $Manage_Class="";
    $Add_New_Class="";

    $Manage_Lecturer="";
    $Add_New_Lecturer = "";

	$Manage_Student = "";
    $Add_New_Student = "";

    $Profile = "";

switch ($active) {
    case "Dashboard":
        $Dashboard ="active";
        $active="Dashboard";
        break;

    case "Manage_Department":
        $Manage_Department="active";
        $active="Manage Department";
        break;

    case "Add_New_Department":
        $Add_New_Department = "active";
        $active="Add New Department";
        break;
    
    case "Manage_Program":
        $Manage_Program="active";
        $active="Manage Program";
        break;

    case "Add_New_Program":
        $Add_New_Program="active";
        $active="Add New Program";
        break;

    case "Manage_Class":
        $Manage_Class="active";
        $active="Manage Class";
        break;

    case "Add_New_Class":
        $Add_New_Class="active";
        $active="Add New Class";
        break;

    case "Manage_Lecturer":
        $Manage_Lecturer="active";
        $active="Manage Lecturer";
        break;

    case "Add_New_Lecturer":
        $Add_New_Lecturer="active";
        $active="Add New Lecturer";
        break;

    case "Manage_Student":
        $Manage_Student="active";
        $active="Manage Student";
        break;

	case "Add_New_Student":
        $Add_New_Student="active";
        $active="Add New Student";
        break;

	case "Profile":
        $Profile="active";
        $active="Profile";
        break;

}
$username=$_SESSION['Session_Id'];

echo <<<EOT

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Student Management System">
    <meta name="author" content="Udara Dananjaya">
    <link rel="shortcut icon" href="../img/favicon.png" type="image/png">
    <title>Admin Panel - $active </title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/jquery.dataTables.min.css" rel="stylesheet">

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

</head>

<body id="page-top">
  
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Dashboard">
            <div class="sidebar-brand-icon">
                <img src="../img/brand.png" height="70px" width="200px">
            </div>

        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item $Dashboard">
            <a class="nav-link" href="Dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Department
        </div>
        <li class="nav-item $Manage_Department">
            <a class="nav-link" href="Manage_Department">
                <i class="fas fa-school"></i>
                <span>Manage Department</span></a>
        </li>
        <li class="nav-item $Add_New_Department">
            <a class="nav-link" href="Add_New_Department">
                <i class="fas fa-plus"></i>
                <span>Add New Department</span></a>
        </li>

        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Program
        </div>
 
        <li class="nav-item $Manage_Program">
            <a class="nav-link" href="Manage_Program">
                <i class="fas fa-fw fa-graduation-cap"></i>
                <span>Manage Program</span></a>
        </li>
        <li class="nav-item $Add_New_Program">
            <a class="nav-link" href="Add_New_Program">
                <i class="fas fa-fw fa-plus-circle"></i>
                <span>Add New Program</span></a>
        </li>

        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Class
        </div>

        <li class="nav-item $Manage_Class">
            <a class="nav-link" href="Manage_Class">
                <i class="fas fa-fw fa-users"></i>
                <span>Manage Class</span></a>
        </li>

        <li class="nav-item $Add_New_Class">
            <a class="nav-link" href="Add_New_Class">
                <i class="fas fa-fw fa-plus-square"></i>
                <span>Add New Class</span></a>
        </li>

        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Lecturer
        </div>
    
        <li class="nav-item $Manage_Lecturer">
            <a class="nav-link" href="Manage_Lecturer">
                <i class="fas fa-fw fa-user-tie"></i>
                <span>Manage Lecturer</span></a>
        </li>
        <li class="nav-item $Add_New_Lecturer">
            <a class="nav-link" href="Add_New_Lecturer">
                <i class="far fa-fw fa-plus-square"></i>
                <span>Add New Lecturer</span></a>
        </li>
        

        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Student
        </div>
        <li class="nav-item $Manage_Student">
            <a class="nav-link" href="Manage_Student">
                <i class="fas fa-fw fa-user-alt"></i>
                <span>Manage Student</span></a>
        </li>
        <li class="nav-item $Add_New_Student">
            <a class="nav-link" href="Add_New_Student">
                <i class="fas fa-fw fa-user-plus"></i>
                <span>Add New Student</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
        Profile
        </div>
        <li class="nav-item $Profile">
            <a class="nav-link" href="Profile">
                <i class="fas fa-fw fa-user-cog"></i>
                <span>Profile</span></a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
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
                <nav class="border-left navbar navbar-expand navbar-light bg-gradient-primary topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle"  id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-dark font-weight-bold text-uppercase small">$username</span>
                                <img class="img-profile rounded-circle border" src="../img/profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
EOT;
}
?>
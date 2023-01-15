<?php
session_start();
if(!isset($_SESSION['Session_Id']))
{
    header('Location: ../login.php');
}
if(!($_SESSION['user']=="Lecturer")){
  header('Location: ../login.php');
}

require_once "../config/database.php";
require_once "layout/header.php";
require_once "layout/footer.php";

$sql = "SELECT COUNT(`department_id`) FROM `department`;";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$dep_count= $row["COUNT(`department_id`)"];

$sql = "SELECT COUNT(`program_id`) FROM `program`;";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$prgm_count= $row["COUNT(`program_id`)"];

$sql = "SELECT COUNT(`class_id`) FROM `class`;";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$class_count= $row["COUNT(`class_id`)"];

$sql = "SELECT COUNT(`user_id`) FROM `student` ;";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$stu_count= $row["COUNT(`user_id`)"];

$sql = "SELECT * FROM user LEFT JOIN `student` ON `user`.`user_id`=`student`.`user_id` LEFT JOIN class ON `class`.`class_id`=`student`.`class_id` WHERE `user`.`user_type`='Student';";
$result = $conn->query($sql);

html_header("Dashboard");

echo <<<EOT

<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
<div class="row">

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card bg-gradient-card-2 shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-center text-white">$dep_count</div>
                    <div class="text-xs font-weight-bold text-center text-uppercase mb-1 text-white">Departments </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card bg-gradient-card-4 shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-center text-white">$prgm_count</div>
                    <div class="text-xs font-weight-bold text-center text-uppercase mb-1 text-white">Programs</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-hourglass-start fa-2x text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card bg-gradient-card-1 shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-center text-white">$class_count</div>
                    <div class="text-xs font-weight-bold text-center text-uppercase mb-1 text-white">Classes </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar-alt fa-2x text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card bg-gradient-card-3 shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="h5 mb-0 font-weight-bold text-center text-white">$stu_count</div>
                    <div class="text-xs font-weight-bold text-center text-uppercase mb-1 text-white">students</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-center" style="color:#58cfbb;">Student Data</h6>
    </div>
    
    <div class="card-body">
    <div class="table-responsive">
            <table class="stripe" style="text-align:center; white-space:nowrap;font-size: 15px;" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>E-mail</th>
                        <th>Mobile No</th>
                        <th>Class</th>
                        <th>Birth Date</th>
                    </tr>
                </thead>
                <tbody>
EOT;
   
if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo "<tr style='text-align:center'><td>"
        .$row["user_id"]."</td> <td>"
        .$row["user_name"]."</td> <td>"
        .$row["email"]."</td><td>"
        .$row["mobile"]."</td><td>"
        .$row["class_name"]."</td><td>"
        .$row["birth_date"]."</td></tr>";
    }
        echo"</tbody></table></div></div></div>";
} else {
        echo"</tbody></table></div></div></div>";
}

html_footer();
?>

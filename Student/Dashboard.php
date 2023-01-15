<?php
session_start();
if(!isset($_SESSION['Session_Id']))
{
    header('Location: ../login.php');
}
if(!($_SESSION['user']=="Student")){
  header('Location: ../login.php');
}

require_once "../config/database.php";
require_once "layout/header.php";
require_once "layout/footer.php";

if (isset($_SESSION['user_id'])) { 

    $sql = "SELECT * FROM `student` WHERE `student`.`user_id` = '{$_SESSION['user_id']}';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

$sql = "SELECT * FROM user LEFT JOIN `student` ON `user`.`user_id`=`student`.`user_id` LEFT JOIN class ON `class`.`class_id`=`student`.`class_id` WHERE `student`.`class_id`='{$row["class_id"]}';";
$result = $conn->query($sql);
html_header("Dashboard");

echo <<<EOT

<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-center" style="color:#58cfbb;">Class Students</h6>
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

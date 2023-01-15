<?php
session_start();
if(!isset($_SESSION['Session_Id']))
{
    header('Location: ../login.php');
}
if(!($_SESSION['user']=="Admin")){
  header('Location: ../login.php');
}

require_once "../config/database.php";
require_once "layout/header.php";
require_once "layout/footer.php";

$sql = "SELECT * FROM `user` LEFT JOIN `student` ON `user`.`user_id`=`student`.`user_id` LEFT JOIN `class` ON `student`.`class_id`=`class`.`class_id` WHERE `user`.`user_type` = 'Student';";
$result = $conn->query($sql);

if (isset($_GET['DeleteId'])) { 
    $sql = "DELETE FROM `user` WHERE `user_id` = {$_GET['DeleteId']};";
    $conn->query($sql);
    echo"<script>window.location.href = 'Manage_Student';</script>";
}

html_header("Manage_Student");

echo <<<EOT
<h1 class="h3 mb-4 text-gray-800">Manage Student</h1>
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-center" Style="color:#58cfbb;">Manage Student</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="stripe" style="text-align:center; white-space:nowrap;font-size: 15px;" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th style="text-align: center;">#</th>
                    <th style="text-align: center;">User Name</th>
                    <th style="text-align: center;">Email</th>
                    <th style="text-align: center;">Mobile</th>
                    <th style="text-align: center;">Birth Date</th>
                    <th style="text-align: center;">Address</th>
                    <th style="text-align: center;">Class</th>

                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
EOT;
   
if ($result->num_rows > 0) {
    $i=0;
    while($row = $result->fetch_assoc()) {
        $i++;
        $date = date("Y-m-d", strtotime($row['date']));
        echo <<<EOT
        <tr>
        <td>$i</td> 
        <td>{$row["user_name"]}</td>
        <td>{$row["email"]}</td>
        <td>{$row["mobile"]}</td>
        <td>{$date}</td>
        <td>{$row['address']}</td>
        <td>{$row['class_name']}</td>
        <td> <a href='Update_Student?EditId={$row["user_id"]}'><i class="fas fa-edit"></i></a> || <a href='Manage_Student.php?DeleteId={$row["user_id"]}' onclick="return confirm('Do you really want to Delete ?');"> <i class="fas fa-trash"></i> </a> </td>
        </tr>
        EOT;
    }
        echo"</tbody></table></div></div></div>";

} else {
        echo"</tbody></table></div></div></div>";
}

echo <<<EOT
<script language="JavaScript" type="text/javascript">
    function checkDelete(){
        return confirm('Are you sure want to Delete ?');
    }
</script>
EOT;

html_footer();
?>

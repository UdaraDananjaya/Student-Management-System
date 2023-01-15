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

$sql = "SELECT * FROM `user` WHERE user_type = 'Lecturer' OR user_type = 'Admin';";
$result = $conn->query($sql);

if (isset($_GET['DeleteId'])) { 
    $sql = "DELETE FROM `user` WHERE `user_id` = {$_GET['DeleteId']};";
    $conn->query($sql);
    echo"<script>window.location.href = 'Manage_Lecturer';</script>";
}

html_header("Manage_Lecturer");

echo <<<EOT
<h1 class="h3 mb-4 text-gray-800">Manage lectures</h1>
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-center" Style="color:#58cfbb;">Manage lectures</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="stripe" style="text-align:center; white-space:nowrap;font-size: 15px;" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th style="text-align: center;">#</th>
                    <th style="text-align: center;">User Name</th>
                    <th style="text-align: center;">Email</th>
                    <th style="text-align: center;">User Type</th>
                    <th style="text-align: center;">Mobile</th>
                    <th style="text-align: center;">Created</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
EOT;
   
if ($result->num_rows > 0) {
    $i=0;
    while($row = $result->fetch_assoc()) {
        $i++;
        echo <<<EOT
        <tr>
        <td>$i</td> 
        <td>{$row["user_name"]}</td>
        <td>{$row["email"]}</td>
        <td>{$row["user_type"]}</td>
        <td>{$row["mobile"]}</td>
        <td>{$row["date"]}</td>
        <td> <a href='Update_Lecturer?EditId={$row["user_id"]}'><i class="fas fa-edit"></i></a> || <a href='Manage_Lecturer.php?DeleteId={$row["user_id"]}' onclick="return confirm('Do you really want to Delete ?');"> <i class="fas fa-trash"></i> </a> </td>
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

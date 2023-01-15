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

$sql = "SELECT * FROM `class` LEFT JOIN `program` ON `class`.`program_id` =`program`.`program_id`;";
$result = $conn->query($sql);

html_header("Manage_Class");

if (isset($_GET['DeleteId'])) { 

    $sql = "DELETE FROM `class` WHERE `class_id` = {$_GET['DeleteId']};";
    $conn->query($sql);
    echo"<script>window.location.href = 'Manage_Class';</script>";
}

echo <<<EOT

<h1 class="h3 mb-4 text-gray-800">Manage Class</h1>

<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-center" Style="color:#58cfbb;">Manage Class</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="stripe" style="text-align:center; white-space:nowrap;font-size: 15px;" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><center>#</center></th>
                    <th><center>Class Name</center></th>
                    <th><center>Program Name</center></th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
EOT;
   //        .$row["url"]."</td> <td>"
   
if ($result->num_rows > 0) {
    $i=0;
    while($row = $result->fetch_assoc()) {

        $i++;
        echo <<<EOT
        <tr>
        <td>$i</td> 
        <td>{$row["class_name"]}</td>
        <td>{$row["program_name"]}</td>
        <td> <a href='Update_Class?EditId={$row["class_id"]}'><i class="fas fa-edit"></i></a> || <a href='Manage_Class.php?DeleteId={$row["class_id"]}' onclick="return confirm('Do you really want to Delete ?');"> <i class="fas fa-trash"></i> </a> </td>

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

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

$sql = "SELECT `department_name`,`department`.`department_id`,COUNT(`department`.`department_id`) AS 'p_count' FROM `department` LEFT JOIN `program` ON `department`.`department_id`=`program`.`department_id` GROUP BY `department_id`;";
$result = $conn->query($sql);

html_header("View_Department");


echo <<<EOT

<h1 class="h3 mb-4 text-gray-800">View Department</h1>

<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-center" Style="color:#58cfbb;">View Department</h6>
</div>
<div class="card-body">
        <table class="stripe" style="text-align:center; white-space:nowrap;font-size: 15px;" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th style="text-align: center;">#</th>
                    <th style="text-align: center;">Department Name</th>
                    <th style="text-align: center;">Programs Count</th>
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
        <td>{$row["department_name"]}</td>
        <td>{$row["p_count"]}</td>
        </tr>
        EOT;
    }
        echo"</tbody></table></div></div>";

} else {
        echo"</tbody></table></div></div>";
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

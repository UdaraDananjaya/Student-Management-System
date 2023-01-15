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

$sql = "SELECT * FROM `department`;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $Select_Department = '';
    while ($row = $result->fetch_assoc()) {
        $value = "<option value='" . $row["department_id"] . "'>" . $row["department_name"] . "</option>";
        $Select_Department =  $Select_Department . $value;
    }
} else {
    $Select_Department = "<option></option>";
}

html_header("Add_New_Program");

if (isset($_POST['submit'])) { 

$program_name=$_POST['program_name'];
$department_id=$_POST['department_id'];
    $sql = "INSERT INTO `program`(`program_name`, `department_id`) VALUES ('$program_name','$department_id');";
    $conn->query($sql);
    echo"<script>window.location.href = 'Manage_Program';</script>";
}

echo <<<EOT

<h1 class="h3 mb-4 text-gray-800">Add New Program</h1>
<div class="col-md-8 mx-auto">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-center" Style="color:#58cfbb;">Add New Program</h6>
        </div>
        <div class="card-body">
            <form method="post">
    
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Program Name : </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="program_name" class="form-control" required>
                        </div>
                    </div>
                </div>
    
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Select Department : </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <select class="form-control" name="department_id" id="usergroup" required>
                                <option disabled selected>Click to Select Department</option>
                                $Select_Department
                            </select>
                        </div>
                    </div>
                </div>

                <input class="btn btn-warning" name="Cancel" type="reset" value="Cancel">
                <input class="btn btn-primary" name="submit" type="submit" value="Add Program">

            </form>
        </div>
    </div>
</div>

EOT;
    html_footer();
?>
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

html_header("Add_New_Department");

if (isset($_POST['submit'])) { 

$department_name=$_POST['department_name'];
    $sql = "INSERT INTO `department`( `department_name`) VALUES ('$department_name');";
    $conn->query($sql);
    echo"<script>window.location.href = 'Manage_Department';</script>";
}

echo <<<EOT

<h1 class="h3 mb-4 text-gray-800">Add New Department</h1>
<div class="col-md-8 mx-auto">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-center" Style="color:#58cfbb;">Add New Department</h6>
        </div>
        <div class="card-body">
            <form method="post">
    
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Department Name : </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="department_name" class="form-control" required>
                        </div>
                    </div>
                </div>

                <input class="btn btn-warning" name="Cancel" type="reset" value="Cancel">
                <input class="btn btn-primary" name="submit" type="submit" value="Add Department">
            </form>
        </div>
    </div>
</div>

EOT;
    html_footer();
?>
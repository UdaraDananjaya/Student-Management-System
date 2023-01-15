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

html_header("Manage_Program");

if (isset($_GET['EditId'])) { 
    $sql = "SELECT * FROM `program` LEFT JOIN `department` ON `program`.`department_id` =`department`.`department_id` WHERE program_id = {$_GET['EditId']};";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if (isset($_POST['submit'])) { 
    $sql = "UPDATE `program` SET `program_name`='{$_POST['program_name']}' WHERE `program_id` = {$_GET['EditId']};";
    $conn->query($sql);
    echo"<script>window.location.href='Manage_Program';</script>";
}

echo <<<EOT

<h1 class="h3 mb-4 text-gray-800">Update Program</h1>
<div class="col-md-8 mx-auto">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-center" Style="color:#58cfbb;">Update Program</h6>
        </div>
        <div class="card-body">
            <form method="post">

                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Program Name : </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="program_name" class="form-control" value="{$row["program_name"]}" required>
                        </div>
                    </div>
                </div>
    
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Department Name : </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" class="form-control" value="{$row["department_name"]}" disabled>
                        </div>
                    </div>
                </div>

                <a class="btn btn-warning" href="Manage_Program"> Cancel </a>
                <input class="btn btn-primary" name="submit" type="submit" value="Update Program">
            </form>
        </div>
    </div>
</div>

EOT;
    html_footer();
?>
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

html_header("Manage_Class");

if (isset($_GET['EditId'])) { 
    $sql = "SELECT * FROM `class` LEFT JOIN `program` ON `class`.`program_id` =`program`.`program_id` WHERE class_id = {$_GET['EditId']};";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if (isset($_POST['submit'])) { 
    $sql = "UPDATE `class` SET `class_name`='{$_POST['class_name']}' WHERE `class_id` = {$_GET['EditId']};";
    $conn->query($sql);
    echo"<script>window.location.href='Manage_Class';</script>";
}

echo <<<EOT

<h1 class="h3 mb-4 text-gray-800">Update Class</h1>
<div class="col-md-8 mx-auto">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-center" Style="color:#58cfbb;">Update Class</h6>
        </div>
        <div class="card-body">
            <form method="post">

                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Class Name : </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="class_name" class="form-control" value="{$row["class_name"]}" required>
                        </div>
                    </div>
                </div>
    
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Program Name : </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" class="form-control" value="{$row["program_name"]}" disabled>
                        </div>
                    </div>
                </div>

                <a class="btn btn-warning" href="Manage_Class"> Cancel </a>
                <input class="btn btn-primary" name="submit" type="submit" value="Update Class">
            </form>
        </div>
    </div>
</div>

EOT;
    html_footer();
?>
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

$sql = "SELECT * FROM `program`;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $Select_Program = '';
    while ($row = $result->fetch_assoc()) {
        $value = "<option value='" . $row["program_id"] . "'>" . $row['program_name'] . "</option>";
        $Select_Program =  $Select_Program . $value;
    }
} else {
    $Select_Program = "<option></option>";
}

html_header("Add_New_Class");

if (isset($_POST['submit'])) { 

$class_name = $_POST['class_name'];
$program_id=$_POST['program_id'];
    $sql = "INSERT INTO `class`(`class_name`, `program_id`) VALUES ('$class_name','$program_id');";
    $conn->query($sql);
    echo"<script>window.location.href = 'Manage_Class';</script>";
}

echo <<<EOT

<h1 class="h3 mb-4 text-gray-800">Add New Classes</h1>
<div class="col-md-8 mx-auto">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-center" Style="color:#58cfbb;">Add New Class</h6>
        </div>
        <div class="card-body">
            <form method="post">
    
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Class Name : </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="class_name" class="form-control" required>
                        </div>
                    </div>
                </div>
    
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Program Name : </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <select class="form-control" name="program_id" id="usergroup" required>
                                <option disabled selected>Click to Select Program</option>
                                $Select_Program
                            </select>
                        </div>
                    </div>
                </div>

                <input class="btn btn-warning" name="Cancel" type="reset" value="Cancel">
                <input class="btn btn-primary" name="submit" type="submit" value="Add class">

            </form>
        </div>
    </div>
</div>

EOT;
    html_footer();
?>
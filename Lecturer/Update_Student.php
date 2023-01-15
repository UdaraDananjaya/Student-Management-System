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

html_header("Manage_Student");

$sql = "SELECT * FROM `class`;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $Select_Class = '';
    while ($row = $result->fetch_assoc()) {
        $value = "<option value='" . $row["class_id"] . "'>" . $row["class_name"] . "</option>";
        $Select_Class =  $Select_Class . $value;
    }
} else {
    $Select_Class = "<option></option>";
}

if (isset($_GET['EditId'])) { 
    $sql = "SELECT * FROM `user` LEFT JOIN `student` ON `user`.`user_id`=`student`.`user_id` LEFT JOIN `class` ON `student`.`class_id`=`class`.`class_id` WHERE `user`.`user_id` = {$_GET['EditId']};";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $date = date("Y-m-d", strtotime($row['date']));
}

if (isset($_POST['submit'])) { 

    (isset($_POST['pass'])==true) ?  ($sql_pass = ", `password` = '".md5($_POST['pass'])."'" ):( $sql_pass="");
    $sql = "UPDATE `user` SET `user_name` = '{$_POST['uname']}',`email` = '{$_POST['email']}' $sql_pass  ,`mobile` = '{$_POST['mobile']}' WHERE `user_id` = '{$_GET['EditId']}'";
    $conn->query($sql);
   
    $sql = "UPDATE `student` SET `birth_date` = '{$_POST['birth_date']}',`guardian_name` = '{$_POST['guardian_name']}', `contact_number` = '{$_POST['contact_number']}',`address` = '{$_POST['address']}',`class_id` = '{$_POST['class']}' WHERE `user_id` = '{$_GET['EditId']}'";
    $conn->query($sql);
    echo"<script>window.location.href = 'Manage_Student';</script>";
}

echo <<<EOT

<h1 class="h3 mb-4 text-gray-800">Update Student</h1>
<div class="col-md-8 mx-auto">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-center" Style="color:#58cfbb;">Update Student</h6>
        </div>
        <div class="card-body">
            <form method="post">

                <div class="form-group row">
                    <label class="col-md-3 col-from-label">User Name : </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="uname" class="form-control" value="{$row['user_name']}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Email: </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" value="{$row['email']}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Mobile: </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="Text" name="mobile" class="form-control" value="{$row['mobile']}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Password : </label>
                    <div class="col-md-7">
                        <div class="form-group">
                            <input type="Text" id="pass" name="pass" class="form-control">
                        </div>
                    </div>
                    <a onclick='passgen();' class="col-md-1 btn btn-warning" style="width: 46px;height: 34px;">#</a>

                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Birth Date: </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="date" name="birth_date" class="form-control" value="$date" required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Guardian Name: </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="Text" name="guardian_name" class="form-control" value="{$row['guardian_name']}" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Contact Number: </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="Text" name="contact_number" class="form-control" value="{$row['contact_number']}" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Address: (Line 1,) </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="Text" name="address" class="form-control" value="{$row['address']}" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Select Class : ({$row['class_name']})</label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <select class="form-control" name="class" id="usergroup" required>
                                <option disabled selected>Click to Select Class</option>
                                $Select_Class
                            </select>
                        </div>
                    </div>
                </div>

                <a class="btn btn-warning" href="Manage_Student"> Cancel </a>
                <input class="btn btn-primary" name="submit" type="submit" value="Update Student">
            </form>
        </div>
    </div>
</div>

EOT;

echo <<<EOT
<script language="JavaScript" type="text/javascript">
    function passgen() {
        var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var passwordLength = 8;
        var password = "";
        for (var i = 0; i <= passwordLength; i++) {
            var randomNumber = Math.floor(Math.random() * chars.length);
            password += chars.substring(randomNumber, randomNumber + 1);
        }
        document.getElementById('pass').value = password;
    }

</script>
EOT;

    html_footer();
?>
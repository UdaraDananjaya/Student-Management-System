<?php
session_start();
if(!isset($_SESSION['Session_Id']))
{
    header('Location: ../login.php');
}
if(!($_SESSION['user']=="Student")){
    header('Location: ../login.php');
}

require_once "../config/database.php";
require_once "layout/header.php";
require_once "layout/footer.php";

html_header("Profile");

if (isset($_SESSION['user_id'])) { 
    $sql = "SELECT * FROM `user` WHERE user_id = '{$_SESSION['user_id']}';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
  
}

if (isset($_POST['submit'])) { 
    (isset($_POST['pass'])==true) ?  ($sql_pass = ", `password` = '".md5($_POST['pass'])."'" ):( $sql_pass="");
    $sql = "UPDATE `user` SET `user_name` = '{$_POST['uname']}',`email` = '{$_POST['email']}' $sql_pass ,`mobile` = '{$_POST['mobile']}' WHERE `user_id` = '{$_SESSION['user_id']}'";
    $conn->query($sql);
    echo"<script>window.location.href = 'Profile.php';</script>";
}

echo <<<EOT

<h1 class="h3 mb-4 text-gray-800">Update Profile</h1>
<div class="col-md-8 mx-auto">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-center" Style="color:#58cfbb;">Update Profile</h6>
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
                            <input type="text" name="email" class="form-control" value="{$row['email']}"  required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Mobile: </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="Text" name="mobile" class="form-control" value="{$row['mobile']}"  required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Password : </label>
                    <div class="col-md-7">
                        <div class="form-group">
                            <input type="Text" id="pass" name="pass" class="form-control" required>
                        </div>
                    </div>
                    <a onclick='passgen();' class="col-md-1 btn btn-warning" style="width: 46px;height: 34px;">#</a>

                </div>

                <input class="btn btn-warning" name="Cancel" type="reset" value="Cancel">
                <input class="btn btn-primary" name="submit" type="submit" value="Update Profile">
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
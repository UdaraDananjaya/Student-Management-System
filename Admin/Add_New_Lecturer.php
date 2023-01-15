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

require_once "controller/email.php";

html_header("Add_New_Lecturer");

if (isset($_POST['submit'])) {

    $post_pass = md5($_POST['pass']);

    $sql = "INSERT INTO user (user_name, email, password,user_type,mobile)
    VALUES ('{$_POST['uname']}', '{$_POST['email']}', '$post_pass','{$_POST['usergroup']}','{$_POST['mobile']}')";
    $conn->query($sql);

    $mail_html = " Please Log in to your Account <br> UserName {$_POST['email']} : Password : {$_POST['pass']}";
  //  mailsender("Student Added"," $mail_html","{$_POST['email']}");

    echo"<script>window.location.href = 'Manage_Lecturer.php';</script>";
}

echo <<<EOT

<h1 class="h3 mb-4 text-gray-800">Add New Lecturer</h1>
<div class="col-md-8 mx-auto">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-center" Style="color:#58cfbb;">Add New  Lecturer</h6>
        </div>
        <div class="card-body">
            <form method="post">

                <div class="form-group row">
                    <label class="col-md-3 col-from-label">User Name : </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="uname" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Email: </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-from-label">Mobile: </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="Text" name="mobile" class="form-control" required>
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

                <div class="form-group row">
                    <label class="col-md-3 col-from-label">User Type : </label>
                    <div class="col-md-8">
                        <div class="form-group">
                            <select class="form-control" name="usergroup" id="usergroup" required>
                                <option value="Admin">Admin</option>
                                <option value="Lecturer">Lecturer</option>
                            </select>
                        </div>
                    </div>
                </div>

                <input class="btn btn-warning" name="Cancel" type="reset" value="Cancel">
                <input class="btn btn-primary" name="submit" type="submit" value="Add Lecturer">
            </form>
        </div>
    </div>
</div>

EOT;

echo <<<EOT
<script language="JavaScript" type="text/javascript">
passgen();
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
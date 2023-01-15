<?php
session_start();
unset($_SESSION["Session_Id"]);
unset($_SESSION["user"]);
header("Location:../login.php");
?>
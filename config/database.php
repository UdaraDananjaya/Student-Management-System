<?php

define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'student_management');
// Create connection
$conn = new mysqli(DB_SERVER, DB_USER,DB_PASSWORD, DB_NAME);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//Do not modify anything below unless you know what you are doing.
define('DB_CHARSET', 'utf8');
define('DB_COLLATION', 'utf8_unicode_ci');

?>

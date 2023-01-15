<?php

define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
//define('DB_NAME', 'student_management');
// Create connection
$conn = new mysqli(DB_SERVER, DB_USER,DB_PASSWORD);

$filename = 'student_management.sql';

$op_data = '';
$lines = file($filename);
foreach ($lines as $line)
{
    if (substr($line, 0, 2) == '--' || $line == '')
    {
        continue;
    }
    $op_data .= $line;
    if (substr(trim($line), -1, 1) == ';')
    {
        $conn->query($op_data);
        $op_data = '';
    }
}

echo "Import " . $filename . " file successfully.......";
?>
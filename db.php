<link rel="icon" href="favicon.ico" type="image/ico">
<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "phonebook";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>
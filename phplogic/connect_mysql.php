<?php
	$databse_servername = ${servername};
	$database_username = ${userame};
	$database_password = ${password};
	$database_schamaname = ${schamaname};
    $conn = mysqli_connect($databse_servername, $database_username, $database_password, $database_schamaname);

    // Check connection
    if (!$conn) {
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }
?>
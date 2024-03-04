<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "sistem_informasi_rpl";

$connection = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($connection));
?>
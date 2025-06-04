<?php 
$con = new mysqli("localhost", "root", "", "portfolio");
if($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
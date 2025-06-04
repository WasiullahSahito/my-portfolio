<?php 
$con = new mysqli("localhost", "root", "", "my-portfolio");
if($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
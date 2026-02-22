<?php
$conn = new mysqli("localhost","root","","finance_tracker");
if($conn->connect_error){
 die("Database Connection Failed");
}
?>

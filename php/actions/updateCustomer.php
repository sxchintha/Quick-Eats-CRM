<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: php/Customer.php");
}

include_once 'dbConfig.php';

$SID = $_SESSION["SID"];
$name = $_POST['uName'];
$address = $_POST['uAddress'];
$telNo = $_POST['uTelNo'];
$currentTel = $_POST['currentTel'];
$email = $_POST['uEmail'];
$task = "Update";

date_default_timezone_set("Asia/Colombo"); // Set default  timezone to Asiz/Colombo
$date = date("Y-m-d");
$time = date("H:i:sa");

// $sql = "SET FOREIGN_KEY_CHECKS=0;"; // If foreign key check is enabled, we can't update values.
$sql = "update customer set Name='$name', Address='$address', PhoneNumber=$telNo, Email='$email' where PhoneNumber=$currentTel;";
// $sql .= "insert into customer_manage(SID, Customer, Task, Date, Time) values($SID, $telNo, '$task', '$date', '$time');";
// $sql .= "SET FOREIGN_KEY_CHECKS=1;"; // Enable foreign key check again after updating data

if (mysqli_multi_query($con, $sql)) {
    echo "<script> alert('Customer successfully updated!');";
    echo "window.location.href = '../Customer.php';</script>";
} else {
    echo "<script> alert('Database Error! Please try again.');";
    echo "window.location.href = '../Customer.php';</script>";
}

mysqli_close($con);

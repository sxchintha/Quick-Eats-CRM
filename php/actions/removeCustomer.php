<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: php/Customer.php");
}

include_once 'dbConfig.php';

$SID = $_SESSION["SID"]; // Staff ID of the user who removed the customer
$pNo = $_POST['uTelNo'];
$task = "Remove";

date_default_timezone_set("Asia/Colombo"); // Set default  timezone to Asiz/Colombo
$date = date("Y-m-d");
$time = date("H:i:sa");

$sql = "SET FOREIGN_KEY_CHECKS=0;"; // If foreign key check is enabled, we can't update values.
$sql .= "delete from customer where PhoneNumber = $pNo;";
$sql .= "insert into customer_manage(SID, Customer, Task, Date, Time) values($SID, $pNo, '$task', '$date', '$time');";
$sql .= "SET FOREIGN_KEY_CHECKS=1;"; // Enable foreign key check again after updating data

if (mysqli_multi_query($con, $sql)) {
    echo "<script> alert('Customer successfully removed!');";
    echo "window.location.href = '../Customer.php';</script>";
} else {
    echo "<script> alert('Database Error! Please try again.');";
    echo "window.location.href = '../Customer.php';</script>";
}

mysqli_close($con);

<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: php/Customer.php");
}

include_once 'dbConfig.php';

$SID = $_POST['sendSID'];
$name = $_POST['uName'];
$address = $_POST['uAddress'];
$telNo = $_POST['uTelNo'];
$email = $_POST['uEmail'];
$NIC = $_POST['uNIC'];

$sql = "SET FOREIGN_KEY_CHECKS=0;"; // If foreign key check is enabled, we can't update values.
$sql .= "update staff set Username='$NIC', Name='$name' where SID=$SID;";
$sql .= "update sales_person set Address='$address', Email='$email', NIC='$NIC' where SID=$SID;";
$sql .= "update sales_person_phone set PhoneNumber='$telNo' where SID=$SID;";
$sql .= "SET FOREIGN_KEY_CHECKS=1;"; // Enable foreign key check again after updating data

if (mysqli_multi_query($con, $sql)) {
    echo "<script> alert('User successfully updated!');";
    echo "window.location.href = '../SalesPerson.php';</script>";
} else {
    echo "<script> alert('Database Error! Please try again.');";
    echo "window.location.href = '../SalesPerson.php';</script>";
}

mysqli_close($con);

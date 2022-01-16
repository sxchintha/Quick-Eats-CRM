<?php
include_once 'dbConfig.php';

$SID = $_POST['sendSID'];

// $sql = "SET FOREIGN_KEY_CHECKS=0;"; // If foreign key check is enabled, we can't update values.
$sql .= "delete from sales_person_phone where SID=$SID;";
$sql .= "delete from sales_person where SID=$SID;";
$sql .= "delete from staff where SID=$SID;";
// $sql .= "SET FOREIGN_KEY_CHECKS=1;"; // Enable foreign key check again after updating data

if (mysqli_multi_query($con, $sql)) {
    echo "<script> alert('User successfully removed!');";
    echo "window.location.href = '../SalesPerson.php';</script>";
} else {
    echo "<script> alert('Database Error! Please try again.');";
    echo "window.location.href = '../SalesPerson.php';</script>";
}

mysqli_close($con);

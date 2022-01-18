<?php
include_once 'dbConfig.php';

$name = $_POST['uName'];
$address = $_POST['uAddress'];
$telNo = $_POST['uTelNo'];
$email = $_POST['uEmail'];
$RegisteredBy = 1;

// Check for duplicate details before insert to the table
$chkDuplicateEmail = mysqli_query($con, "select * from customer where Email = '$email'");
$chkDuplicateTel = mysqli_query($con, "select * from customer where PhoneNumber = '$telNo'");

if (mysqli_num_rows($chkDuplicateEmail) > 0) {
    echo "<script> alert('A customer has already registered with this Email');";
    echo "window.location.href = '../Customer.php';</script>";
} else if (mysqli_num_rows($chkDuplicateTel) > 0) {
    echo "<script> alert('A customer has already registered with this Phone number');";
    echo "window.location.href = '../Customer.php';</script>";
}

// If there are no duplicates, insert data into the database
else {
    $SQL = "insert into customer(Name, Address, Email, PhoneNumber, ManagedBy) values('$name', '$address', '$email', '$telNo', '$RegisteredBy')";

    if (mysqli_query($con, $SQL)) {

        // All data added successfully to the table
        echo "<script> alert('Custemer added to the system!');";
        echo "window.location.href = '../Customer.php';</script>";
    }

    // If there is an error with inserting data into the table, show an error
    echo "<script> alert('Database Error! Please try again.');";
    echo "window.location.href = '../Customer.php';</script>";
}

mysqli_close($con);

<?php
include_once 'dbConfig.php';

$name = $_POST['uName'];
$address = $_POST['uAddress'];
$telNo = $_POST['uTelNo'];
$email = $_POST['uEmail'];
$NIC = $_POST['uNIC'];
$password = "quickeats123";
$RegisteredBy = 1;

// Check for duplicate details before insert to the table
$chkDuplicateNIC = mysqli_query($con, "select * from sales_person where NIC = '$NIC'");
$chkDuplicateEmail = mysqli_query($con, "select * from sales_person where Email = '$email'");
$chkDuplicateTel = mysqli_query($con, "select * from sales_person_phone where PhoneNumber = '$telNo'");

if (mysqli_num_rows($chkDuplicateNIC) > 0) {
    echo "<script> alert('A user has already registered with this NIC');";
    echo "window.location.href = '../SalesPerson.php';</script>";
} else if (mysqli_num_rows($chkDuplicateEmail) > 0) {
    echo "<script> alert('A user has already registered with this Email');";
    echo "window.location.href = '../SalesPerson.php';</script>";
} else if (mysqli_num_rows($chkDuplicateTel) > 0) {
    echo "<script> alert('A user has already registered with this Phone number');";
    echo "window.location.href = '../SalesPerson.php';</script>";
}

// If there are no duplicates, insert data into the database
else {
    $staffSQL = "insert into staff(Username, Name, Password) values('$NIC', '$name', '$password')";

    if (mysqli_query($con, $staffSQL)) {
        $SID = mysqli_insert_id($con); // Get the last id from the staff table (to add user details to sales_person and sales_person_phone tables)

        $spSQL = "insert into sales_person(SID, Address, Email, NIC, RegisteredBy) values('$SID', '$address', '$email', '$NIC', '$RegisteredBy')";
        $spTelSQL = "insert into sales_person_phone(SID, PhoneNumber) values('$SID', '$telNo')";


        if (mysqli_query($con, $spSQL)) {
            if (mysqli_query($con, $spTelSQL)) {
                echo "<script> alert('User added to the system!');";
                echo "window.location.href = '../SalesPerson.php';</script>";
            }
        }
    } else {
        echo "<script> alert('Database Error! Please try again.');";
        echo "window.location.href = '../SalesPerson.php';</script>";
    }
}

mysqli_close($con);

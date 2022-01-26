<?php

session_start();

require_once "php/actions/dbConfig.php";

// Check if the user is already logged in, if yes then redirect him to home page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && !empty($_SESSION["SID"])) {
    $chkAdmin = "SELECT `SID` from `admin` where `SID` = " . $_SESSION["SID"];
    $chkResult = $con->query($chkAdmin);

    if ($chkResult->num_rows > 0) {
        $_SESSION["user"] = "Admin";
    } else {
        $_SESSION["user"] = "SalesPerson";
    }
    header("location: php/Tasks.php");
    exit;
}


$username = $password = "";
$login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $login_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $login_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($login_err)) {
        $sql = "SELECT `SID`, `Name` from `staff` where `Username`='$username' and `Password`='$password'";
        $result = $con->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $login_err = "Correct username or password.";

            $_SESSION["loggedin"] = true;
            $_SESSION["SID"] = $row['SID'];
            $_SESSION["uname"] = $row['Name'];

            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && !empty($_SESSION["SID"])) {
                $chkAdmin = "SELECT `SID` from `admin` where `SID` = " . $_SESSION["SID"];
                $chkResult = $con->query($chkAdmin);

                if ($chkResult->num_rows > 0) {
                    $_SESSION["user"] = "Admin";
                } else {
                    $_SESSION["user"] = "SalesPerson";
                }
                header("location: php/Tasks.php");
                exit;
            }
        } else {
            $login_err = "Invalid username or password.";
        }
    }

    // Close connection
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - QuickEats</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/favicon.ico">
</head>

<body>
    <div class="body-container">
        <div class="item-left">
            <div class="logo-container"><img src="img/logowhite.png" alt="logo" class="logow"></div>
            <div class="caption-container">
                <div>
                    <h1>Welcome to quick eats</h1>
                </div>
                <div>
                    <h5>Login to gain access to the company online CRM platform</h5>
                </div>
            </div>
        </div>
        <div class="item-right">
            <div>
                <h2 class="logintitle">Log in</h2>
            </div>
            <?php
            if (!empty($login_err)) {
                echo '<div style="color: red;">' . $login_err . '</div>';
            }
            ?>
            <form method="POST" action="index.php">
                <div class="uname">
                    <caption>Username</caption>
                    <br> <input type="text" name="username" size="30" class="type-name" required>
                </div>

                <div class="pword">
                    <caption>Password</caption>
                    <br> <input type="password" name="password" size="30" class="type-pwrd" required>
                </div>

                <div>
                    <button type="submit" class="login-btn">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
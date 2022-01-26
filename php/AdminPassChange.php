<html>

<head>
    <title>Chane Password</title>
    <link rel="icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/index.css">
</head>

<body>
    <?php
    session_start();

    // Check if the user is logged in, if not then redirect to login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: ../index.php");
        exit;
    }

    require 'actions/dbConfig.php';
    include 'navigation.php'

    ?>

    <div class="colom right">
        <?php

        if (isset($_POST["CurrentPassword"])) {
            $sid = $_SESSION["SID"];
            $curpass = $_POST["CurrentPassword"];
            $new = $_POST["NewPassword"];
            $conf = $_POST["ConfirmNewPassword"];

            if ($new <> $conf) {
                echo "<h4 style='color:red'>New password and Confirm Password is not Matched</h4>";
            } else {

                $sql = "select * from staff where SID='$sid' and password='$curpass'";

                $result = $con->query($sql);

                if (mysqli_num_rows($result) > 0) {
                    $sql = "update staff set password='$new' where SID='$sid' and password='$curpass'";

                    if ($con->query($sql)) {
                        echo "<h4 style='color:green'>Password has been changed</h4>";
                    } else {
                        echo "<h4 style='color:red'>Invalid Current password</h4>";
                    }
                } else {
                    echo "<h4 style='color:red'>Invalid Current password</h4>";
                }
            }
        }

        ?>


        <div class="logo"><img src="../img/logo blue.png"></div>

        <div class="box">
            <h2>Change Your Password</h2>
            <form action="" method="post">
                <p>Current Password</p>
                <input type="password" name="CurrentPassword" placeholder="Enter Current password" class="inputval">
                <p>New Password</p>
                <input type="password" id="NewPassword" name="NewPassword" placeholder="Enter New password" class="inputval">
                <p>Confirm New Password</p>
                <input type="password" id="ConfirmNewPassword" name="ConfirmNewPassword" placeholder="Re Enter New password" class="inputval1">

                <input type="submit" value="Submit" class="button">

            </form>
        </div>
    </div>
</body>

</html>
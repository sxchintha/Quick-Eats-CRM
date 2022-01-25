<html>

<head>
    <title></title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="icon" href="../img/favicon.ico">
</head>

<body>
    <div class="colom left">
        <?php
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!empty($_SESSION["uname"])) {
            echo '<div class="userDisplay"> Welcome ' . $_SESSION["uname"] . ' !</div>';
        }
        ?>
        <div class="centerbtn">
            <a href="home.html"> <button class="btn"> Home </button> </a>
        </div>
        </br>

        <?php

        if (!empty($_SESSION["user"]) && $_SESSION["user"] == "Admin") {
            echo '<div class="centerbtn1">
            <a href="SalesPerson.php"> <button class="btn"> Sales Persons </button> </a>
            </div>
            </br>';
        }
        ?>

        <div class="centerbtn1">
            <a href="Customer.php"> <button class="btn"> Coustomers </button> </a>
        </div>
        </br>
        <div class="centerbtn1">
            <a href="home.html"> <button class="btn"> Activity Log </button> </a>
        </div>
        </br>
        <div class="centerbtn1">
            <a href="home.html"> <button class="btn"> Promotions </button> </a>
        </div>
        </br>
        <div class="centerbtn1">
            <a href="home.html"> <button class="btn"> Change Password </button> </a>
        </div>
        </br>
        <div class="centerbtn1">
            <a href="actions/logout.php"> <button class="btn"> Logout </button> </a>
        </div>
        </br>

    </div>
</body>

</html>
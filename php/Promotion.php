<!DOCTYPE html>
<html>

<head>
    <title>Promotions</title>
    <link rel="stylesheet" href="../css/UserManagement.css">
    <link rel="icon" href="../img/favicon.ico">
</head>

<body>
    <?php
    session_start();

    // Check if the user is logged in, if not then redirect to login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: ../index.php");
        exit;
    }

    include 'navigation.php'
    ?>
    <div class="colom right">
        <form action="Promotion.php">
            <input type="text" id="promo" name="promo" onkeypress="myFunction()">
            <input type="submit" id="sendpromo" value="Send Promotion">
        </form>

        <p id="demo"></p>

        <script>
            function myFunction() {
                var x = document.getElementById("promo").value;
                document.getElementById("demo").innerHTML = encodeURI(x);
            }
        </script>

        <a href="mailto:email1@gmail.com,email2.gmail.com?subject=Quick%20promotion&body=This%20is%20a%20test%20promotion">Send mail</a>
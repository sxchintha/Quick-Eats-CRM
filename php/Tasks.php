<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="../js/tasks.js" defer></script>
    <link rel="stylesheet" href="../css/tasks.css">

    <title>Home</title>
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
        <div class="head-flex">
            <div class="header-container">
                <h3>Tasks</h3>
                <p class="instructions">click + too add a new task--- double click to delete a task</p>
            </div>

            <div class="logo-container">
                <img src="../img/logo blue.png" alt="logo" class="logo">
            </div>
        </div>

        <div id="app">
            <button class="add-note" type="button">+</button>
        </div>
    </div>

</body>

</html>
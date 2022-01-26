<!DOCTYPE html>
<html>

<head>
    <title>Customer - Management</title>
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
        <div class="logo"><img src="../img/logo blue.png"></div>
        <h2>Customers</h2>
        <!-- Add a new User -->
        <button id="addNewButton" onclick="addCus();">
            <span><strong>&#43;</strong></span>
            Add new Customer
        </button>
        <br>
        <hr>

        <!-- Popup form -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <!-- onkeydown="return event.key != 'Enter';" : is used to stop from submitting the form on pressing enter -->
                <form method="POST" action="" id="userForm" onkeydown="return event.key != 'Enter';">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2 id="modalTitle"></h2>
                    </div>
                    <div class="modal-body">
                        <span class="special">Required *</span>
                        <table>
                            <tr id="modalSID" style="display: none;">
                                <td>ID</span></td>
                                <td>:</td>
                                <td><label for="SID" id="uSID"></label></td>
                            </tr>
                            <tr>
                                <td>Name <span class="special">*</span></td>
                                <td>:</td>
                                <td><input type="text" id="uName" name="uName" placeholder="Enter name here..." required></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td><input type="text" id="uAddress" name="uAddress" placeholder="Enter address here..." required></td>
                            </tr>
                            <tr>
                                <td>Tel No <span class="special">*</span></td>
                                <td>:</td>
                                <td><input type="tel" id="uTelNo" name="uTelNo" pattern="[0-9]{10}" placeholder="Enter 10 digit phone number..." required></td>
                            </tr>
                            <tr>
                                <td>Email <span class="special">*</span></td>
                                <td>:</td>
                                <td><input type="email" id="uEmail" name="uEmail" placeholder="Enter e-mail here..." required></td>
                            </tr>
                        </table>
                        <p id="modalNote" style="display: none;">Note: Default password for the account: <span class="special">quickeats123</span></p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="currentTel" name="currentTel"> <!-- Use to send the current telNo of the user when updating the user details -->
                        <input id="btnAdd" type="submit" formaction="actions/addNewCustomer.php" value="Add User">
                        <input id="btnUpdate" type="submit" formaction="actions/updateCustomer.php" value="Update Details">
                        <input id="btnDelete" type="submit" formaction="actions/removeCustomer.php" value="Remove User">
                        <input id="btnClear" type="reset" value="Clear">
                    </div>
                </form>
            </div>

        </div>


        <h2>All Customers</h2>
        <form action="Customer.php" method="GET">
            <input type="text" name="search" placeholder="Search here...">
            <button type="submit" id="addNewButton" style="display: inline-block;">Search</button>
        </form><br>
        <!-- Show the details of all users -->
        <table class="userTable">
            <tr>
                <th></th>
                <th>Name</th>
                <th>Tel No</th>
                <th>Email</th>
                <th>Address</th>
                <th>Manage</th>
            </tr>
            <?php
            require 'actions/dbConfig.php';
            if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["search"])) {
                $search = $_GET["search"];
                // Select searched data of customers
                $sql = "SELECT customer.Name as cusName, PhoneNumber, `Address`, Email FROM `customer`
                WHERE customer.Name = '%$search%' OR `Address` LIKE '%$search%' OR customer.Email LIKE '%$search%' OR PhoneNumber LIKE '%$search%'
                ORDER BY `cusName`";
            } else {
                // Select all data of customers
                $sql = "SELECT customer.Name as cusName, PhoneNumber, `Address`, Email FROM `customer` ORDER BY `cusName`";
            }

            $result = mysqli_query($con, $sql);
            $count = 1;

            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $count++ ?></td>
                    <td><?php echo $row["cusName"]; ?></td>
                    <td><?php echo "0" . $row["PhoneNumber"]; ?></td>
                    <td><?php echo $row["Email"]; ?></td>
                    <td><?php echo $row["Address"]; ?></td>

                    <td>
                        <?php
                        echo "<button onclick=" . '"editUserCus(' . "'" . $row["cusName"] . "', '" . $row["Address"] . "', '0" . $row["PhoneNumber"] . "', '" . $row["Email"] . "'" . ')"' . ">Edit</button>";
                        echo "<button onclick=" . '"deleteUserCus(' . "'" . $row["cusName"] . "', '" . $row["Address"] . "', '0" . $row["PhoneNumber"] . "', '" . $row["Email"] . "'" . ')"' . ">Remove</button>";
                        ?>
                    </td>
                </tr>
            <?php
            }
            $con->close();
            ?>

        </table>
    </div>
    <script src="../js/UserManagement.js"></script>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Salesperson - Management</title>
    <link rel="stylesheet" href="../css/UserManagement.css">
    <link rel="icon" href="../img/favicon.ico">
</head>

<body>
    <?php
    session_start();

    // Check if the user is logged in, if not then redirect to login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user"] != "Admin") {
        header("location: ../index.php");
        exit;
    }

    include 'navigation.php'
    ?>
    <div class="colom right">
        <div class="logo"><img src="../img/logo blue.png"></div>
        <h2>Salespeople </h2>
        <!-- Add a new User -->
        <button id="addNewButton" onclick="addSP();">
            <span><strong>&#43;</strong></span>
            Add new Salesperson
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
                        <br>
                        <span class="special">Required *</span><br>
                        <table>
                            <tr id="modalSID" style="display: none;">
                                <th>ID</span></th>
                                <th>:</th>
                                <th><label for="SID" id="uSID"></label></th>
                            </tr>
                            <tr>
                                <td>Name <span class="special">*</span></td>
                                <td>:</td>
                                <td><input type="text" id="uName" name="uName" placeholder="Enter name here..." required></td>
                            </tr>
                            <tr>
                                <td>Address <span class="special">*</span></td>
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
                            <tr>
                                <td>NIC <span class="special">*</span></td>
                                <td>:</td>
                                <td><input type="text" id="uNIC" name="uNIC" pattern="[0-9]{9}V|.[0-9]{11}" placeholder="Enter NIC here (Ex: 123456789V, 123456789123)" required></td>
                            </tr>
                        </table>
                        <p id="modalNote">Note: Default password for the account: <span class="special">quickeats123</span></p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="sendSID" name="sendSID"> <!-- Use to send the ID of the user when updating the user details -->
                        <input id="btnAdd" type="submit" formaction="actions/addNewSalesPerson.php" value="Add User">
                        <input id="btnUpdate" type="submit" formaction="actions/updateSalesPerson.php" value="Update Details">
                        <input id="btnDelete" type="submit" formaction="actions/removeSalesPerson.php" value="Remove User">
                        <input id="btnClear" type="reset" value="Clear">
                    </div>
                </form>
            </div>

        </div>


        <h2>All Users</h2>
        <form action="SalesPerson.php" method="GET">
            <input type="text" name="search" placeholder="Search here...">
            <button type="submit" id="addNewButton" style="display: inline-block;">Search</button>
        </form><br>

        <!-- Show the details of all users -->
        <table class="userTable">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Tel No</th>
                <th>Email</th>
                <th>NIC</th>
                <th>Manage</th>
            </tr>
            <?php
            require 'actions/dbConfig.php';

            if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["search"])) {
                $search = $_GET["search"];
                // Select searched data of sales people from staff, sales_person and sales_person_phone tables
                $sql = "SELECT * FROM `sales_person` JOIN sales_person_phone ON sales_person.SID = sales_person_phone.SID JOIN staff ON staff.SID=sales_person.SID
                WHERE staff.SID = '$search' OR `Name` LIKE '%$search%' OR `Address` LIKE '%$search%' OR `Email` LIKE '%$search%' OR `NIC` LIKE '%$search%'";
            } else {
                // Select all data of sales people from staff, sales_person and sales_person_phone tables
                $sql = "SELECT * FROM `sales_person` JOIN sales_person_phone ON sales_person.SID = sales_person_phone.SID JOIN staff ON staff.SID=sales_person.SID";
            }
            $result = mysqli_query($con, $sql);

            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row["SID"]; ?></td>
                    <td><?php echo $row["Name"]; ?></td>
                    <td><?php echo $row["Address"]; ?></td>
                    <td><?php echo "0" . $row["PhoneNumber"]; ?></td>
                    <td><?php echo $row["Email"]; ?></td>
                    <td><?php echo $row["NIC"]; ?></td>
                    <td>
                        <?php
                        echo "<button onclick=" . '"editUserSP(' . $row["SID"] . ", '" . $row["Name"] . "', '" . $row["Address"] . "', '0" . $row["PhoneNumber"] . "', '" . $row["Email"] . "', '" . $row["NIC"] . "'" . ')"' . ">Edit</button>";
                        echo "<button onclick=" . '"deleteUserSP(' . $row["SID"] . ", '" . $row["Name"] . "', '" . $row["Address"] . "', '0" . $row["PhoneNumber"] . "', '" . $row["Email"] . "', '" . $row["NIC"] . "'" . ')"' . ">Remove</button>";
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
<!DOCTYPE html>
<html>

<head>
    <title>Sales Person - Management</title>
    <link rel="stylesheet" href="../css/UserManagement.css">
</head>

<body>

    <h2>Sales Person</h2>
    <!-- Add a new Sales person -->
    <button id="addNewButton">
        <span><strong>&#43;</strong></span>
        Add new Sales Person
    </button>

    <!-- Popup form -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <form method="POST" action="" id="userForm" onkeydown="return event.key != 'Enter';">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2 id="modelTitle"></h2>
                </div>
                <div class="modal-body">
                    <span class="special">Required *</span>
                    <table>
                        <tr id="modelSID" style="display: none;">
                            <td>ID</span></td>
                            <td>:</td>
                            <td><label for="SID" id="uSID"></label></td>
                        </tr>
                        <tr>
                            <td>Name <span class="special">*</span></td>
                            <td>:</td>
                            <td><input type="text" id="uName" name="uName" required></td>
                        </tr>
                        <tr>
                            <td>Address <span class="special">*</span></td>
                            <td>:</td>
                            <td><input type="text" id="uAddress" name="uAddress" required></td>
                        </tr>
                        <tr>
                            <td>Tel No <span class="special">*</span></td>
                            <td>:</td>
                            <td><input type="number" min="0" id="uTelNo" name="uTelNo" required></td>
                        </tr>
                        <tr>
                            <td>Email <span class="special">*</span></td>
                            <td>:</td>
                            <td><input type="email" id="uEmail" name="uEmail" required></td>
                        </tr>
                        <tr>
                            <td>NIC <span class="special">*</span></td>
                            <td>:</td>
                            <td><input type="text" id="uNIC" name="uNIC" required></td>
                        </tr>
                    </table>
                    <p id="modelNote">Note: Default password for the account: <span class="special">quickeats123</span></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="sendSID" name="sendSID">
                    <input id="btnAdd" type="submit" formaction="actions/addNewSalesPerson.php" value="Add User">
                    <input id="btnUpdate" type="submit" formaction="actions/updateSalesPerson.php" value="Update Details">
                    <input id="btnDelete" type="submit" formaction="actions/removeSalesPerson.php" value="Remove User">
                    <input id="btnClear" type="reset" value="Clear">
                </div>
            </form>
        </div>

    </div>


    <h2>All Users</h2>
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

        // Select all data of sales people from staff, sales_person and sales_person_phone tables
        $sql = "SELECT * FROM `sales_person` JOIN sales_person_phone ON sales_person.SID = sales_person_phone.SID JOIN staff ON staff.SID=sales_person.SID";
        $result = mysqli_query($con, $sql);

        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td id="showSID"><?php echo $row["SID"]; ?></td>
                <td id="showName"><?php echo $row["Name"]; ?></td>
                <td id="showAddress"><?php echo $row["Address"]; ?></td>
                <td id="showPNo"><?php echo "0" . $row["PhoneNumber"]; ?></td>
                <td id="showEmail"><?php echo $row["Email"]; ?></td>
                <td id="showNIC"><?php echo $row["NIC"]; ?></td>
                <td>
                    <?php
                    echo "<button onclick=" . '"editUser(' . $row["SID"] . ", '" . $row["Name"] . "', '" . $row["Address"] . "', '0" . $row["PhoneNumber"] . "', '" . $row["Email"] . "', '" . $row["NIC"] . "'" . ')"' . ">Edit</button>";
                    echo "<button onclick=" . '"deleteUser(' . $row["SID"] . ", '" . $row["Name"] . "', '" . $row["Address"] . "', '0" . $row["PhoneNumber"] . "', '" . $row["Email"] . "', '" . $row["NIC"] . "'" . ')"' . ">Remove</button>";
                    ?>
                </td>
            </tr>
        <?php
        }
        $con->close();
        ?>

    </table>
    <script src="../js/UserManagement.js"></script>
</body>

</html>
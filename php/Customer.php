<!DOCTYPE html>
<html>

<head>
    <title>Customer - Management</title>
    <link rel="stylesheet" href="../css/UserManagement.css">
</head>

<body>

    <h2>Sales Person</h2>
    <!-- Add a new User -->
    <button id="addNewButton" onclick="addCus();">
        <span><strong>&#43;</strong></span>
        Add new Customer
    </button>

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
                            <td><input type="text" id="uName" name="uName" required></td>
                        </tr>
                        <tr>
                            <td>Address</td>
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
                    </table>
                    <p id="modalNote">Note: Default password for the account: <span class="special">quickeats123</span></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="sendSID" name="sendSID"> <!-- Use to send the ID of the user when updating the user details -->
                    <input id="btnAdd" type="submit" formaction="" value="Add User">
                    <input id="btnUpdate" type="submit" formaction="" value="Update Details">
                    <input id="btnDelete" type="submit" formaction="" value="Remove User">
                    <input id="btnClear" type="reset" value="Clear">
                </div>
            </form>
        </div>

    </div>


    <h2>All Users</h2>
    <!-- Show the details of all users -->
    <table class="userTable">
        <tr>
            <th></th>
            <th>Name</th>
            <th>Tel No</th>
            <th>Email</th>
            <th>Address</th>
            <th>Registered by</th>
            <th>Manage</th>
        </tr>
        <?php
        require 'actions/dbConfig.php';

        // Select all data of sales people from staff, sales_person and sales_person_phone tables
        $sql = "SELECT customer.Name as cusName, staff.Name as SPName, PhoneNumber, Address, Email FROM `customer` join staff on staff.SID = customer.ManagedBy order by 'Name'";
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
                <td><?php echo $row["SPName"]; ?></td>
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
    <script src="../js/UserManagement.js"></script>
</body>

</html>
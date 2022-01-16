<!DOCTYPE html>
<html>

<head>
    <title>Sales Person - Management</title>
    <link rel="stylesheet" href="../css/UserManagement.css">
</head>

<body>

    <h2>Sales Person</h2>
    <!-- Add a new Sales person -->
    <button id="addNewButton">Add new Sales Person</button>
    <!-- Popup form -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <form method="POST" action="actions/addNewSalesPerson.php">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2>Add new User</h2>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><input type="text" id="uName" name="uName"></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><input type="text" id="uAddress" name="uAddress"></td>
                        </tr>
                        <tr>
                            <td>Tel No</td>
                            <td>:</td>
                            <td><input type="number" min="0" id="uTelNo" name="uTelNo"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><input type="email" id="uEmail" name="uEmail"></td>
                        </tr>
                        <tr>
                            <td>NIC</td>
                            <td>:</td>
                            <td><input type="text" id="uNIC" name="uNIC"></td>
                        </tr>
                    </table>
                    <p>Default password for the account: quickeats123</p>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Add User">
                    <input type="reset" value="Clear">
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
        </tr>
        <?php
        require 'actions/dbConfig.php';
        $sql = "SELECT * FROM `sales_person` JOIN sales_person_phone ON sales_person.SID = sales_person_phone.SID JOIN staff ON staff.SID=sales_person.SID";
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
            </tr>
        <?php
        }
        $con->close();
        ?>

    </table>
    <script src="../js/UserManagement.js"></script>
</body>

</html>
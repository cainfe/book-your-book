<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="..\styles\style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Book Your Book | Customers</title>
    </head>

    <body>
        <!-- Navigation bar -->
        <?php $isIndex = FALSE; ?>
        <?php include '../scripts/popNavbar.php' ?>

        <!-- Header and homepage link-->
        <h1 id="index-pg-hdr"><a class="link-no-display" href="../index.php">Book Your Book</a></h1>
        
        <?php 
            if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
                echo("<button onclick=\"toggleForm('add-customer', 1)\">Add customer</button>");
            }
        ?>

        <!--Search bar-->
        <!--form action="" method="post" class="bar">
            <input type="text" id="search-customer" placeholder="Search..">
            <button type="submit" name="submit">Search</button>
        </form-->

        <table id="btable">
            <tr>
                <th>Customer</th>
                <th>Username</th>
                <th>Password</th>
                <th>Options</th>
            </tr>
            
            <!-- Populate the book list -->
            <?php
                // Connect to the database
                $dbConn = new PDO('sqlite:../Data.db');

                $result = $dbConn->query("SELECT customerID, fName, lName, contactID, username, password FROM Customers ORDER BY lname;");

                foreach($result as $row) {
                    $customerID = $row['customerID'];
                    $customerFName = $row['fName'];
                    $customerLName = $row['lName'];
                    $contactID = $row['contactID'];
                    $username = $row['username'];
                    $password = $row['password'];

                    if ($_SESSION['customerID'] != 0 AND ($_SESSION['customerID'] == $customerID OR $_SESSION['isAdmin'])) {
                        echo("<tr>");
                        echo("    <td>$customerFName $customerLName</td>");
                        echo("<td>$username</td>");
                        echo("<td>$password</td>");
                        echo("    <td>");
                        echo("    <button class=\"edit-customer-btn\" name=\"$customerID\" >E</button>");
                        if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
                            echo("    <button class=\"remove-customer-btn\" name=\"$customerID\" >R</button>");
                        }
                        echo("    </td>");
                        echo("</tr>");
                    }
                }
                ?>
        </table>

        <!-- popup form - add customer -->
        <div class="popup-form container form-container" id="add-customer">
            <button class="form-close-btn" onclick="toggleForm('add-customer', 0)">x</button>
            <h2 class="form-title">ADD CUSTOMER</form></h2>
            <form id="add-customer-form" action="../scripts/addCustomer.php" method="post">
                <div class="form-data">
                    <label>First Name</label>
                    <input type="text" name="fname" class="data-input" id="add-customer-fname-field" required>
                </div>
                <div class="form-data">
                    <label>Last Name</label>
                    <input type="text" name="lname" class="data-input" id="add-customer-lname-field" required>
                </div>
                <div class="form-data">
                    <label>Username</label>
                    <input type="text" name="username" class="data-input" id="add-customer-username-field" required>
                </div>
                <div class="form-data">
                    <label>Password</label>
                    <input type="password" name="password" class="data-input" id="add-customer-password-field" required>
                </div>
                <div class="form-data">
                    <label>Email</label>
                    <input type="email" name="email" class="data-input" id="add-customer-email-field">
                </div>
                <div class="form-data">
                    <label>Phone</label>
                    <input type="text" name="phone" class="data-input" id="add-customer-phone-field">
                </div>
                <div class="form-data">
                    <label>Address</label>
                    <input type="text" name="address" class="data-input" id="add-customer-address-field">
                </div>

                <button type="submit" id="btn-submit-customer" class="form-submit-btn btn-submit-book">Add</button>
            </form>
        </div>

        <!-- popup form - edit Customer -->
        <div class="popup-form container form-container" id="edit-customer">
                <button class="form-close-btn" onclick="toggleForm('edit-customer', 0)">x</button>
                <h2 class="form-title">EDIT CUSTOMER</form></h2>
                <form id="add-customer-form">
                <div class="form-data">
                    <label>First Name</label>
                    <input type="text" name="fname" class="data-input" id="edit-customer-fname-field">
                </div>
                <div class="form-data">
                    <label>Last Name</label>
                    <input type="text" name="lname" class="data-input" id="edit-customer-lname-field">
                </div>
                <div class="form-data">
                    <label>Username</label>
                    <input type="text" name="username" class="data-input" id="edit-customer-username-field">
                </div>
                <div class="form-data">
                    <label>Password</label>
                    <input type="password" name="password" class="data-input" id="edit-customer-password-field">
                </div>
                <div class="form-data">
                    <label>Email</label>
                    <input type="email" name="email" class="data-input" id="edit-customer-email-field">
                </div>
                <div class="form-data">
                    <label>Phone</label>
                    <input type="text" name="phone" class="data-input" id="edit-customer-phone-field">
                </div>
                <div class="form-data">
                    <label>Address</label>
                    <input type="text" name="address" class="data-input" id="edit-customer-address-field">
                </div>

                <button type="submit" id="btn-submit-customer" class="form-submit-btn btn-submit-book edit-customer-submit-btn">Confirm</button>
            </form>
            </div>
    </body>
</html>

<script>
    var cID = 0;

    function toggleForm(form, show) 
    {
        var x = document.getElementById(form);
        if (show) {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>

<script>
    $('.edit-customer-btn').click(function() {
        cID = $(this).attr('name');
        toggleForm("edit-customer", 1);
    });
</script>

<script>
    $('.edit-customer-submit-btn').click(function() {
    var fname = document.getElementById("edit-customer-fname-field").value;
    var lname = document.getElementById("edit-customer-lname-field").value;
    var username = document.getElementById("edit-customer-username-field").value;
    var password = document.getElementById("edit-customer-password-field").value;
    var email = document.getElementById("edit-customer-email-field").value;
    var address = document.getElementById("edit-customer-address-field").value;
    var phone = document.getElementById("edit-customer-phone-field").value;
    $.ajax({
            type: "POST",
            url: "../scripts/editCustomers.php",
            data: { cID, fname, lname, username, password, email, address, phone }
        }).done(function(msg) {
            location.reload();
        });
    });
</script>

<script>
    $('.remove-customer-btn').click(function() {
        if (window.confirm("This action will permanantly delete the customer, continue?")) {
            $.ajax({
                type: "POST",
                url: "../scripts/removeCustomer.php",
                data: { customerID: $(this).attr('name') }
            }).done(function(msg) {
                location.reload();
            });
        }
    });
</script>


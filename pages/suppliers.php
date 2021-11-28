<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="..\styles\style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Book Your Book | Suppliers</title>
    </head>

    <body>
        <!-- Navigation bar -->
        <?php $isIndex = FALSE; ?>
        <?php include '../scripts/popNavbar.php' ?>

        <!-- Header and homepage link-->
        <h1 id="index-pg-hdr"><a class="link-no-display" href="../index.php">Book Your Book</a></h1>
    
        <?php 
            if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
                echo("<button onclick=\"toggleForm('add-supplier', 1)\">Add supplier</button>");
            }
        ?>

        <!--Search bar-->
        <form action="" method="post" class="bar">
            <input type="text" id="search-suppliers" placeholder="Search..">
            <button type="submit" name="submit">Search</button>
        </form>

        <table id="btable">
            <tr>
                <th>Supplier</th>
                <th>Options</th>
            </tr>
            
            <!-- Populate the book list -->
            <?php
                // Connect to the database
                $dbConn = new PDO('sqlite:../Data.db');

                $result = $dbConn->query("SELECT supplierID, name FROM Suppliers ORDER BY name;");

                foreach($result as $row) {
                    $supplierID = $row['supplierID'];
                    $name = $row['name'];
                    echo("<tr>");
                    echo("    <td>$name</td>");
                    echo("    <td>");
                    if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
                        echo("    <button id=\"edit-supplier-btn\" class=\"edit-supplier-btn\" name=\"$supplierID\" >E</button>");
                        echo("    <button class=\"remove-supplier-btn\" name=\"$supplierID\" >R</button>");
                    }
                    echo("    </td>");
                    echo("</tr>");
                }
                ?>
        </table>
            
        <!-- popup form - add supplier -->
        <div class="popup-form container form-container" id="add-supplier">
            <button class="form-close-btn" onclick="toggleForm('add-supplier', 0)">x</button>
            <h2 class="form-title">ADD SUPPLIER</form></h2>
            <form id="add-supplier-from" action="../scripts/addSupplier.php" method="post">
                <div class="form-data">
                    <label>Name</label>
                    <input type="text" name="name" class="data-input" id="add-supplier-name-field" required>
                </div>

                <button type="submit" id="btn-submit-author" class="form-submit-btn btn-submit-book">Add</button>
            </form>
        </div>
            
        <!-- popup form - edit supplier -->
        <div class="popup-form container form-container" id="edit-supplier-form">
            <button class="form-close-btn" onclick="toggleForm('edit-supplier-form', 0)">x</button>
            <h2 class="form-title">EDIT SUPPLIER</form></h2>
            <form id="edit-supplier-form">
                <div class="form-data">
                    <label>Name</label>
                    <input type="text" name="name" class="data-input" id="edit-supplier-name-field" required>
                </div>
                
                <button type="submit" id="btn-submit-edit-supplier" class="form-submit-btn edit-supplier-submit-btn">Confirm</button>
            </form>
        </div>
    </body>
</html>


<script>
    var sID = 0;

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
    $('.edit-supplier-btn').click(function() {
        sID = $(this).attr('name');
        toggleForm("edit-supplier-form", 1);
    });
</script>

<script>
    $('.edit-supplier-submit-btn').click(function() {
    $.ajax({
            type: "POST",
            url: "../scripts/editSupplier.php",
            data: { supplierID: sID, name: document.getElementById("edit-supplier-name-field").value }
        }).done(function(msg) {
            location.reload();
        });
    });
</script>

<script>
    $('.remove-supplier-btn').click(function() {
        if (window.confirm("This action will permanantly delete the supplier and its supplied books, continue?")) {
            $.ajax({
                type: "POST",
                url: "../scripts/removeSupplier.php",
                data: { supplierID: $(this).attr('name') }
            }).done(function(msg) {
                location.reload();
            });
        }
    });
</script>


<?php
    // DONT TOUCH
    if (isset($_POST['supplierID']) AND isset($_POST['name'])) {
        // Connect to the database
        $dbConn = new PDO('sqlite:../Data.db');

        $supplierID = $_POST['supplierID'];
        $name = $_POST['name'];

        echo "$name $supplierID";
        $dbConn->query("UPDATE Suppliers SET name = '$name' WHERE Suppliers.supplierID = $supplierID;");
    }
?>
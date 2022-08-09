<?php
    // DONT TOUCH
    if (isset($_POST['supplierID'])) {
        // Connect to the database
        $dbConn = new PDO('sqlite:../Data.db');

        $supplierID = $_POST['supplierID'];

        $result = $dbConn->query("SELECT ISBN FROM Books
        WHERE $supplierID = Books.suppliedBy;");

        foreach ($result as $isbn) {
            $dbConn->query("DELETE FROM AssignedCategory
            WHERE $isbn = AssignedCategory.bookID;");
            
            $dbConn->query("DELETE FROM BookAuthors
            WHERE $isbn = BookAuthors.bookID;");

            $dbConn->query("DELETE FROM Books
            WHERE $isbn = Books.ISBN;");
        }

        $dbConn->query("DELETE FROM SupplierReps
        WHERE $supplierID = Suppliers.worksFor;");

        $dbConn->query("DELETE FROM Suppliers
        WHERE $supplierID = Suppliers.supplierID;");
    }
?>
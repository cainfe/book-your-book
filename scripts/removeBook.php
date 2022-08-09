<?php
    // DONT TOUCH
    if (isset($_POST['isbn'])) {
        // Connect to the database
        $dbConn = new PDO('sqlite:../Data.db');

        $isbn = $_POST['isbn'];
        $dbConn->query("DELETE FROM AssignedCategory
         WHERE $isbn = AssignedCategory.bookID;");
         
        $dbConn->query("DELETE FROM BookAuthors
         WHERE $isbn = BookAuthors.bookID;");

        $dbConn->query("DELETE FROM Books
         WHERE $isbn = Books.ISBN;");
    }
?>
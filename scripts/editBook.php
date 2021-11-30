<?php
    if (session_status() == 1) {
        session_start();
    }

    $oldIsbn = $_POST['oldIsbn'];
    $isbn = $_POST['isbn'];
    $title = str_replace("'", "''", $_POST['title']);
    $authorID = $_POST['authorID'];
    $supplierID = $_POST['supplierID'];
    $publicationDate = $_POST['publicationDate'];
    $price = $_POST['price'];
    $reviews = $_POST['reviews'];
    $categoryID = json_decode($_POST['categoryIDs']);

    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

    if ($title != '') {
        $dbConn->query("UPDATE Books SET title = '$title' WHERE Books.ISBN = $oldIsbn;");
    }
    if ($authorID != '') {
        $dbConn->query("UPDATE BookAuthors SET authorID = $authorID WHERE BookAuthors.bookID = $oldIsbn;");
    }
    if ($supplierID != '') {
        $dbConn->query("UPDATE Books SET suppliedBy = $supplierID WHERE Books.ISBN = $oldIsbn;");
    }
    if ($publicationDate != '') {
        $dbConn->query("UPDATE Books SET publicationDate = '$publicationDate' WHERE Books.ISBN = $oldIsbn;");
    }
    if ($price != '') {
        $dbConn->query("UPDATE Books SET price = $price WHERE Books.ISBN = $oldIsbn;");
    }
    if ($reviews != '') {
        $dbConn->query("UPDATE Books SET reviews = $reviews WHERE Books.ISBN = $oldIsbn;");
    }

    if ($categoryID != '') {
        $dbConn->query("DELETE FROM AssignedCategory WHERE $oldIsbn = AssignedCategory.bookID;");
        foreach($categoryID as $row) {
            $dbConn->query("INSERT INTO AssignedCategory (bookID, categoryCode) VALUES ($oldIsbn, $row);");
        }
    }

    if ($isbn != '') {
        $dbConn->query("UPDATE Books SET ISBN = '$isbn' WHERE Book.ISBN = $oldIsbn;");
    }
?>
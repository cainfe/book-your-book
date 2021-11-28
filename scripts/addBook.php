<?php
    if (session_status()) {
        session_start();
    }

    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $authorID = $_POST['author'];                     // Returns the ID of the Author
    $supplierID = $_POST['supplier'];                 // Returns the ID of the publisher
    $publicationDate = $_POST['publication-date'];
    $price = $_POST['price'];
    $reviews = $_POST['reviews'];
    $categoryID = array();

    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

    $result = $dbConn->query("SELECT code FROM BookCategories;");

    foreach($result as $row) {
        if (isset($_POST["$row"])) {
            array_push($categoryID, $row);
        }
    }
    echo("<script> alert(\"" . implode(" ", $categoryID) . "\");</script>");

    //Check if we need $result here when site is working. Also check if we need % before and after variables.
    $result = $dbConn->query("INSERT INTO Books(ISBN, title, publicationDate, price, suppliedBy, reviews) 
                            VALUES($isbn, '$title', '$publicationDate', $price, $supplierID, $reviews);");

    $result = $dbConn->query("INSERT INTO BookAuthors(authorID, bookID) VALUES($authorID, $isbn);");

    // Return to previous page.
    $previous = "javascript:history.go(-1)";
    if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
    header("location:$previous");
    exit;
?>
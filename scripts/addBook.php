<?php
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $authorID = $_POST['author'];                     // Returns the ID of the Author
    $supplierID = $_POST['supplier'];                 // Returns the ID of the publisher
    $publicationDate = $_POST['publication-date'];
    $price = $_POST['price'];
    $reviews = $_POST['reviews'];

    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

    //Check if we need $result here when site is working. Also check if we need % before and after variables.
    $result = $dbConn->query("INSERT INTO Books(ISBN, title, publicationDate, price, suppliedBy, reviews) 
                            VALUES($isbn, '$title', '$publicationDate', $price, $supplierID, $reviews);");

    $result = $dbConn->query("INSERT INTO BookAuthors(authorID, bookID) VALUES($authorID, $isbn);");

    // Return to admin page.
    header('Location: ../pages/AdminFE.php');
?>
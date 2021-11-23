<?php
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $author = $_POST['author'];                     // Returns the ID of the Author
    $supplier = $_POST['supplier'];               // Returns the ID of the publisher
    $publicationDate = $_POST['publication-date'];
    $price = $_POST['price'];
    $reviews = $_POST['reviews'];

    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

    //Check if we need $result here when site is working. Also check if we need % before and after variables.
    $result = $dbConn->query("INSERT INTO Books(ISBN, title, publicationDate, price, suppliedBy, reviews) 
    VALUES($isbn, $title, $publicationDate, $price, $supplier, $reviews;");

    $authorID = $dbConn->query("SELECT authorID FROM Authors WHERE fName = %$author%; ");

   $result = $dbConn->query("INSERT INTO BookAuthors(authorID, bookID)
    VALUES(%$authorID%,%$isbn%)");
?>
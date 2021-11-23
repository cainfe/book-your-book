<?php
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $author = $_POST['author'];                     // Returns the ID of the Author
    $publisher = $_POST['publisher'];               // Returns the ID of the publisher
    $publicationDate = $_POST['publication-date'];
    $price = $_POST['price'];
    $reviews = $_POST['reviews'];

    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

    $result = $dbConn->query("");
?>
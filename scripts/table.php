<?php
    //Connect database
    $dbConn = new PDO('sqlite:../Data.db');

    //Need to add category to query
    $result = $dbConn->query("SELECT * FROM Books");

    while($row = $result->fetch_assoc())
    {
        $title = $row['title']
        $publication = $row['publicationDate']
        $category = //$row['description']
        $review = $row['reviews']
    }
?>
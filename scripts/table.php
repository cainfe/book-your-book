<?php
    //Connect database
    $dbConn = new PDO('sqlite:../Data.db');

    //Need to add category to query
    /* $result = $dbConn->query("SELECT title, publicationDate, description, reviews 
                            FROM Books, AssignedCategory
                            WHERE Books.ISBN = AssignedCategory.bookID AND AssignedCategory.categoryCode = BookCategories.code
                            INNER JOIN AssignedCategory ON ");
 */
    while($row = $result->fetch_assoc())
    {
        $title = $row['title']
        $publication = $row['publicationDate']
        $category = $row['description']
        $review = $row['reviews']
    }
?>
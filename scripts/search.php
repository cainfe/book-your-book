<!-- Add to Customer Page? -->

<?php
    //Create variables 
    $bookinfo = '';

    //Connect Database
    $dbConn = new PDO('sqlite:../Data.db');

    //Search for books using keyword
    
    //if search box is not empty search for books using text
    if(isset($_POST['submit'])){
        if(!empty($_POST['search'])){
            $search = $_POST['search'];

            //Need to add category to query
            $sql = "SELECT distinct name, fName, lName, ISBN, title, reviews 
            FROM Books, Authors, BookAuthors, Suppliers, BookCategories, AssignedCategory
            WHERE BookAuthors.bookID = Books.isbn AND BookAuthors.authorID = Authors.authorID 
            AND Suppliers.supplierID = Books.suppliedBy AND Books.ISBN = AssignedCategory.bookID
            AND AssignedCategory.categoryCode = BookCategories.code
            AND (Books.title LIKE '%$search%' OR Books.reviews LIKE '%$search%'
            OR Authors.fname LIKE '%$search%' OR Authors.lname LIKE '%$search%'
            OR Suppliers.name LIKE '%$search%' OR BookCategories.description LIKE '%$search%');"
            
            $result = $dbConn->query($sql);
            $bookinfo = $result->fetch_assoc()
        }
    }
    
?>

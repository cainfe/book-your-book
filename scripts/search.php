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
            $sql = "SELECT name, fName, lName, ISBN, title, reviews FROM Books, Authors, BookAuthors, Suppliers
            WHERE BookAuthors.bookID = Books.isbn AND BookAuthors.authorID = Authors.authorID AND Suppliers.supplierID = Books.suppliedBy ORDER BY title;"
            //HELP
            $sql = "SELECT * FROM Books WHERE title LIKE '%$search% 
                    OR publicationDate LIKE '%$search%
                    OR reviews LIKE '%$search%'";

            $result = $dbConn->query($sql);
            $bookinfo = $result->fetch_assoc()
        }
    }
    
?>

<?php
    //Create variables 
    $search = $_POST["bsearch"];
    $bookinfo = '';

    //Connect Database
    $dbConn = new PDO('sqlite:../Data.db');

    //Search for books using keyword
    
    //if search box is not empty search for books using text
    if(isset($_POST['submit'])){
        if(!empty($_POST["bsearch"])){
            $search = $_POST["bsearch"];

            //Need to add category to query
            $sql = "SELECT * FROM Books WHERE title OR publicationDate
                    OR reviews LIKE '%$search%'";

            $result = $dbConn->query($sql);
            $bookinfo = $result->fetch_assoc()
        }
    }
    
?>

<?php
     $name = $_POST['name'];

    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

     $result = $dbConn->querry("INSERT INTO suppliers(name) VALUES('$name');");

?>
<?php
     $name = $_POST['name'];

    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

    $result = $dbConn->query("INSERT INTO suppliers(name) VALUES ('$name');");

    // Return to previous page.
    header('location:javascript://history.go(-1)');
    exit;
?>
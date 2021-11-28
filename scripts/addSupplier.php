<?php
    if (session_status()) {
        session_start();
    }
    
    $name = $_POST['name'];

    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

    $result = $dbConn->query("INSERT INTO suppliers(name) VALUES ('$name');");

    // Return to previous page.
    $previous = "javascript:history.go(-1)";
    if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
    header("location:$previous");
    exit;
?>
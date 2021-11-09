<?php
    // Create variables
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user = 0;
    
    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

    $result = $dbConn->query("SELECT username, password, userID FROM UserAccount");

    // Check to see if username and password correspond
    foreach($result as $row) {
        if ($row['username'] == $username) {
            if ($row['password'] == $password) {
                // if so, begin session and store user variables
                $user = $row['userID'];
                session_start();
                $_SESSION["userID"] = "$user";
                $_SESSION["username"] = "$username";
            }
        }
    }

    if ($user == 0) {
        // Close database connection and return to login screen for failed
        // attempt
        $dbConn = null;
        header('Location: ../pages/login.html');
    }
    else {
        // Close database connection and go on to homepage for successful 
        // login
        $dbConn = null;
        header('Location: ../index.php');
    }
?>
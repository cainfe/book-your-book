<?php
    // Create variables
    $username = $_POST["username"];
    $password = $_POST["password"];
    $user = 0;
    
    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

    $result = $dbConn->query("SELECT username, password, customerID, isAdmin FROM Customers");

    // Check to see if username and password correspond
    foreach($result as $row) {
        if ($row['username'] == $username) {
            if ($row['password'] == $password) {
                // if so, begin session and store user variables
                $user = $row['customerID'];
                session_start();
                $_SESSION["customerID"] = "$user";
                $_SESSION["username"] = "$username";
                $_SESSION["isAdmin"] = $row['isAdmin'];
            }
        }
    }

    if ($user == 0) {
        // Close database connection and return to login screen for failed
        // attempt
        $dbConn = null;
        // Return to the calling page.
        header('Location:javascript://history.go(-1)');
        exit;
    }
    else {
        // Close database connection.
        $dbConn = null;
        // Return to the calling page.
        header('Location: ../index.php');
        exit;
    }
?>
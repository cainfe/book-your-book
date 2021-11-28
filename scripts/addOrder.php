<?php
    if (session_status()) {
        session_start();
    }
    if ($_SESSION['customerID'] == 0) {
        header('location: ../pages/cart.php');
        exit;
    }

    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

    $customerID = $_SESSION['customerID'];
    $date = date("Y-m-d");
    $dbConn->query("INSERT INTO Orders (date, customerID)
     VALUES ($date, $customerID);");

    $orderID = $dbConn->lastInsertId();

    foreach($_SESSION['cart'] as $item) {
        $dbConn->query("INSERT INTO OrderItems (orderID, bookID)
         VALUES ($orderID, $item);");
    }

    $_SESSION['cart'] = array();

    // Return to previous page.
    $previous = "javascript:history.go(-1)";
    if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
    header("location:$previous");
    exit;
?>
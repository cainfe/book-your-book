<?php
    if (session_status() == 1) {
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

    // Go to orders page.
    header("location:../pages/Order.php");
    exit;
?>
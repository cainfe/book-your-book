<?php
    if (session_status() == 1) {
        session_start();
    }
    
    if (isset($_POST['orderID'])) {
        // Connect to the database
        $dbConn = new PDO('sqlite:../Data.db');

        $orderID = $_POST['orderID'];
        $dbConn->query("DELETE FROM OrderItems
         WHERE $orderID = OrderItems.orderID;");

        $dbConn->query("DELETE FROM Orders
         WHERE $orderID = Orders.orderID;");
    }
?>
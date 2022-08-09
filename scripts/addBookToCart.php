<?php
    if (session_status() == 1) {
        session_start();
    }
    
    if (isset($_POST['isbn'])) {
        $isbn = $_POST['isbn'];
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        if (!in_array($isbn, $_SESSION['cart'])) {
            array_push($_SESSION['cart'], $isbn);
        }
        //echo implode(" ", $_SESSION['cart']); //temp testing
    }
?>
<?php
    if (session_status() == 1) {
        session_start();
    }
    
    // DONT TOUCH
    if (isset($_POST['isbn'])) {
        $isbn = $_POST['isbn'];
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        array_push($_SESSION['cart'], $isbn);
        //echo implode(" ", $_SESSION['cart']); //temp testing
    }
?>
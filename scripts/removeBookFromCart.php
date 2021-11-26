<?php
    if (session_status() == 1) {
        session_start();
    }
    
    if (isset($_POST['isbn'])) {
        $isbn = $_POST['isbn'];
        if (isset($_SESSION['cart'])) {
            // Find the isbn equal to the one being removed and remove it from the list.
            unset($_SESSION['cart'][array_search($isbn, $_SESSION['cart'])]);
        }
    }
?>
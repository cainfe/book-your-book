<?php
    session_start();
    
    // if the session is empty (no one has logged in) then set the sessions 
    // 'userID' to 0.
    if (!isset($_SESSION["customerID"])) {
        $_SESSION["customerID"] = 0;
    }

    $username = "Login"; // placeholder, if no one is logged in.
    if ($_SESSION["customerID"] !== 0) {
        $username = $_SESSION["username"];
    }
    
    if (!$isIndex) {
        // Not index page
        $string = "<div class=\"nav-bar\">";
        $string .= "    <a class=\"link-no-display navbar-link\" href=\"../index.php\">Home</a>";
        $string .= "    <a class=\"link-no-display navbar-link\" href=\"CustomerFE.php\">Book Shelf</a>";
        $string .= "    <a class=\"link-no-display navbar-link\" href=\"cart.php\">Cart</a>";
        $string .= "    <a class=\"link-no-display navbar-link\" href=\"order.php\">Orders</a>";
        if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
            $string .= "<a class=\"link-no-display navbar-link\" href=\"AdminFE.php\">Admin</a>";
        }
        if ($username == "Login") {
            // If user is not logged in
            $string .= "    <a class=\"link-no-display navbar-link navbar-user\" name=\"navbar-user-link\" href=\"login.html\">$username</a>";
            $string .= "    <a class=\"navbar-link navbar-join\" name=\"navbar-join-link\" href=\"join.html\">Join</a>";
        } else {
            // user is logged in
            $string .= "    <a class=\"link-no-display navbar-link navbar-user\" name=\"navbar-user-link\" href=\"profile.php\">$username</a>";
        }
        $string .= "</div>";
        echo($string);
    }
    else {
        // index page
        $string = "<div class=\"nav-bar\">";
        $string .= "    <a class=\"link-no-display navbar-link\" href=\"index.php\">Home</a>";
        $string .= "    <a class=\"link-no-display navbar-link\" href=\"pages/CustomerFE.php\">Book Shelf</a>";
        $string .= "    <a class=\"link-no-display navbar-link\" href=\"pages/cart.php\">Cart</a>";
        $string .= "    <a class=\"link-no-display navbar-link\" href=\"pages/order.php\">Orders</a>";
        if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
            $string .= "<a class=\"link-no-display navbar-link\" href=\"pages/AdminFE.php\">Admin</a>";
        }
        if ($username == "Login") {
            // If user is not logged in
            $string .= "    <a class=\"link-no-display navbar-link navbar-user\" name=\"navbar-user-link\" href=\"pages/login.html\">$username</a>";
            $string .= "    <a class=\"navbar-link navbar-join\" name=\"navbar-join-link\" href=\"pages/join.html\">Join</a>";
        } else {
            // user is logged in
            $string .= "    <a class=\"link-no-display navbar-link navbar-user\" name=\"navbar-user-link\" href=\"pages/profile.php\">$username</a>";
        }
        $string .= "</div>";
        echo($string);
    }
?>
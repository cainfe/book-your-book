<?php
    session_start();
    
    // if the session is empty (no one has logged in) then set the sessions 
    // 'userID' to 0.
    if (!isset($_SESSION["userID"])) {
        $_SESSION["userID"] = 0;
    }

    $username = "Login"; // placeholder, if no one is logged in.
    if ($_SESSION["userID"] !== 0) {
        $username = $_SESSION["username"];
    }
    
    if (!$isIndex) {
        $string = "<div class=\"nav-bar\">";
        $string .= "    <a class=\"link-no-display navbar-link\" href=\"../index.php\">Home</a>";
        $string .= "    <a class=\"link-no-display navbar-link\" href=\"CustomerFE.php\">Customer</a>";
        if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
            $string .= "<a class=\"link-no-display navbar-link\" href=\"AdminFE.php\">Admin</a>";
        }
        if ($username == "Login") {
            $string .= "    <a class=\"link-no-display navbar-link navbar-user\" name=\"navbar-user-link\" href=\"../scripts/login.php\">$username</a>";
        } else {
            $string .= "    <a class=\"link-no-display navbar-link navbar-user\" name=\"navbar-user-link\">$username</a>";
        }
        $string .= "</div>";
        echo($string);
    }
    else {
        $string = "<div class=\"nav-bar\">";
        $string .= "    <a class=\"link-no-display navbar-link\" href=\"index.php\">Home</a>";
        $string .= "    <a class=\"link-no-display navbar-link\" href=\"pages/CustomerFE.php\">Customer</a>";
        if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
            $string .= "<a class=\"link-no-display navbar-link\" href=\"pages/AdminFE.php\">Admin</a>";
        }
        if ($username == "Login") {
            $string .= "    <a class=\"link-no-display navbar-link navbar-user\" name=\"navbar-user-link\" href=\"../scripts/login.php\">$username</a>";
        } else {
            $string .= "    <a class=\"link-no-display navbar-link navbar-user\" name=\"navbar-user-link\">$username</a>";
        }
        $string .= "</div>";
        echo($string);
    }
?>
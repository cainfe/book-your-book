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
        echo("
        <div class=\"nav-bar\">
            <a class=\"link-no-display navbar-link\" href=\"../index.php\">Home</a>
            <a class=\"link-no-display navbar-link\" href=\"CustomerFE.php\">Customer</a>
            <a class=\"link-no-display navbar-link\" href=\"AdminFE.php\">Admin</a>
            <a class=\"link-no-display navbar-link navbar-user\" name=\"navbar-user-link\" href=\"login.html\">$username</a>
        </div>
        ");
    }
    else {
        echo("
        <div class=\"nav-bar\">
            <a class=\"link-no-display navbar-link\" href=\"index.php\">Home</a>
            <a class=\"link-no-display navbar-link\" href=\"pages/CustomerFE.php\">Customer</a>
            <a class=\"link-no-display navbar-link\" href=\"pages/AdminFE.php\">Admin</a>
            <a class=\"link-no-display navbar-link navbar-user\" name=\"navbar-user-link\">$username</a>
        </div>
        ");
    }
?>
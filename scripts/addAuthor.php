<?php
    $fname = $_POST['first-name'];
    $lname = $_POST['last-name'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    echo("$fname, $lname, $gender, $birthday, $email, $phone, $address");

    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');
?>
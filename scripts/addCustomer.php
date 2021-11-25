<?php
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $isAdmin = 0;

    echo("$fname, $lname, $birthday, $email, $phone, $address");

    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

    $result = $dbConn->query("SELECT MAX(contactID) FROM ContactDetails;");
    $contactID = $result->fetch()[0]; // Have to get 'contactId' from PDOStatement object

    if($contactID == null){
        $contactID = 1;
    }
    else {
        $contactID++;
    }

    $dbConn->query("INSERT INTO ContactDetails(ContactID) VALUES($contactID);");

    $result = $dbConn->query("INSERT INTO Customers(fName, lName, username, password, isAdmin, contactID) VALUES('$fname','$lname', '$username', '$password', '$isAdmin', $contactID);");


    $dbConn->query("INSERT INTO ContactAddress (contactID, address) VALUES($contactID, '$address');");
    $dbConn->query("INSERT INTO ContactEmail (contactID, email) VALUES($contactID, '$email');");
    $dbConn->query("INSERT INTO ContactPhone ( contactID, phone) VALUES($contactID, $phone);");




?>
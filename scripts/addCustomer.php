<?php
     $fname = $_POST['first-name'];
    $lname = $_POST['last-name'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $isAdmin = $_POST['isAdmin'];

    echo("$fname, $lname, $gender, $birthday, $email, $phone, $address");

    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

    $contactID = $dbConn->querry("SELECT MAX(contactID) FROM ContactDetails");
    if($contactID == null){
        $contactID = 1;
    }
    else {

    $contactID++;
    }

    $dbConn->querry("INSERT INTO ContactDetails(ContactID) VALUES($contactID);");

    $result = $dbConn->querry("INSERT INTO Customers(fName, lName)
VALUES('$fname','$lname', '$gender', '$birthday', $contactID)");


        $dbConn->querry("INSERT INTO ContactEmail (contactID, email) VALUES($contactID, '$email');");
        $dbConn->querry("INSERT INTO ContactPhone ( contactID, phone) VALUES($contactID, $phone);");
        $dbConn->querry("INSERT INTO UserAccount (username, password, isAdmin, contactID) VALUES('$username','$password', '$isAdmin' ,'$contactID');");




?>
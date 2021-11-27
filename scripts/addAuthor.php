<?php
    $fname = $_POST['first-name'];
    $lname = $_POST['last-name'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

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

    $result = $dbConn->query("INSERT INTO Authors(fName, lName, gender, birthDate, contactID) VALUES('$fname','$lname', '$gender', '$birthday', $contactID);");

    if ($address != "") {
        $dbConn->query("INSERT INTO ContactAddress (contactID, address) VALUES($contactID, '$address');");
    }
    if ($email != "") {
        $dbConn->query("INSERT INTO ContactEmail (contactID, email) VALUES($contactID, '$email');");
    }
    if ($phone != "") {
        $dbConn->query("INSERT INTO ContactPhone (contactID, phone) VALUES($contactID, $phone);");
    }

    // Return to previous page.
    header('location:javascript://history.go(-1)');
    exit;
?>
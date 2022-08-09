<?php
$authorID = $_POST['aID'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$gender = $_POST['gender'];
$birthDate = $_POST['birthDate'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];


// Connect to the database
$dbConn = new PDO('sqlite:../Data.db');

$contactID = $dbConn->query("SELECT contactID FROM Authors WHERE Authors.authorID = $authorID;")->fetch()[0];

if ($fname != '') {
    $dbConn->query("UPDATE Authors SET fname = '$fname' WHERE Authors.authorID = $authorID;");
}
if ($lname != '') {
    $dbConn->query("UPDATE Authors SET lname = '$lname' WHERE Authors.authorID = $authorID;");
}
if ($gender != '') {
    $dbConn->query("UPDATE Authors SET gender = '$gender' WHERE Authors.authorID = $authorID;");
}
if ($email != '') {
    $dbConn->query("UPDATE ContactEmail SET email = '$email' WHERE ContactEmail.contactID = $contactID;");
}
if ($address != '') {
    $dbConn->query("UPDATE ContactAddress SET address = '$address' WHERE ContactAddress.contactID = $contactID;");
}
if ($phone != '') {
    $dbConn->query("UPDATE ContactPhone SET phone = '$phone' WHERE ContactPhone.contactID = $contactID;");
}
if ($birthDate != '') {
    $dbConn->query("UPDATE Authors SET birthDate = '$birthDate' WHERE Authors.authorID = $authorID;");
}
?>
<?php
$customerID = $_POST['cID'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];


// Connect to the database
$dbConn = new PDO('sqlite:../Data.db');

$contactID = $dbConn->query("SELECT contactID FROM Customers WHERE Customers.customerID = $customerID;")->fetch()[0];

if ($fname != '') {
    $dbConn->query("UPDATE Customers SET fname = '$fname'WHERE Customers.customerID = $customerID;");
}
if ($lname != '') {
    $dbConn->query("UPDATE Customers SET lname = '$lname' WHERE Customers.customerID = $customerID;");
}
if ($gender != '') {
    $dbConn->query("UPDATE Customers SET username = $username 'WHERE Customers.customerID = $customerID;");
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
    $dbConn->query("UPDATE Customers SET password = '$password' WHERE Customers.customerID = $customerID;");
}
?>
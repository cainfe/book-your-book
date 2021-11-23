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
?>

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

    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

    $contactID = $dbConn->query("SELECT MAX(contactID) FROM ContactDetails");
    if($contactID == null){
        $contactID = 1;
    }
    else {
        $contactID++;
    }

    $dbConn->query("INSERT INTO ContactDetails(ContactID) VALUES($contactID);");

    $result = $dbConn->query("INSERT INTO Authors(fName, lName, gender, birthDate, contactID)
VALUES('$fname','$lname', '$gender', '$birthday', $contactID)");


        $dbConn->query("INSERT INTO ContactEmail (contactID, email) VALUES($contactID, '$email');");
        $dbConn->query("INSERT INTO ContactPhone (contactID, phone) VALUES($contactID, $phone);");

?>

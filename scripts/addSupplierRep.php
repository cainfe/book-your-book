<?php
    $fname = $_POST['first-name'];
    $lname = $_POST['last-name'];
    $email = $_POST['email'];
    $workNumber = $_POST['work-phone'];
    $cellNumber = $_POST['cell-phone'];
    $worksFor = $_POST['supplier'];

    echo("$fname, $lname, $email, $workNumber,$cellNumber, $worksFor");

    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

    $result= $dbConn->query("INSERT INTO SupplierReps(fName, lName, email, workNumber, cellNumber, worksfor)
     VALUES('$fname', '$lname', '$email', $workNumber, $cellNumber, $worksFor);");

?>
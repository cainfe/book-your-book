<?php
    fname = $_POST['first-name'];
    $lname = $_POST['last-name'];
    $email = $_POST['email'];
    $workNumber = $_POST['workNumber'];
    $cellNumber = $_POST['cellNumber'];
    $worksFor = $_POST['worksfor'];

    echo("$fname, $lname, $email, $workNumber,$cellNumber, $worksFor");

    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');

    $result= $dbConn->querry("INSERT INTO supplierReps(fName, lName, email, workNumber, cellNumber, worksfor)
     VALUES('$fname', '$lname', '$email', $workNumber, $cellNumber, $worksFor);");

?>
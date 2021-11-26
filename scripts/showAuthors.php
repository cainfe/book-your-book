<?php
    
    // Connect to the database
    $dbConn = new PDO('sqlite:../Data.db');


    $sql = "SELECT fName, lName, gender, birthDate, ContactPhone.phone, ContactAddress.address, ContactEmail.email 
FROM (((Authors
INNER JOIN ContactPhone ON Authors.ContactID = ContactPhone.ContactID)
INNER JOIN ContactEmail ON Authors.ContactID = ContactEmail.ContactID)
INNER JOIN ContactAddress ON Authors.ContactID = ContactAddress.ContactID);";

    $result = $dbConn->querry($sql);

    while($row = $result->fetch_assoc())
    {
            $fName = $row['First Name']
            $lname = $row['Last Name']
            $gender = $row['Gender']
            $birthDate =$row['Birth Date']
            $ContactPhone.phone = $row['Phone']
            $ContactAddress.address = $row['Address']
            $ContactEmail.email =$row['Email']  
    
    
    }


  
    


    // Return to admin page.
    header('Location: ../pages/AdminFE.php');
?>
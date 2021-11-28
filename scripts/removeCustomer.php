<?php
    // DONT TOUCH
    if (isset($_POST['customerID'])) {
        // Connect to the database
        $dbConn = new PDO('sqlite:../Data.db');

        $customerID = $_POST['customerID'];
        
        $contactID = $dbConn->query("SELECT contactID FROM Customers
         WHERE $customerID = Customers.customerID;")->fetch()[0];

        $dbConn->query("DELETE FROM ContactAddress
         WHERE $contactID = contactAddress.contactID;");
        
        $dbConn->query("DELETE FROM ContactEmail
         WHERE $contactID = contactEmail.contactID;");
        
        $dbConn->query("DELETE FROM ContactPhone
         WHERE $contactID = contactPhone.contactID;");
        
        $dbConn->query("DELETE FROM ContactDetails
         WHERE $contactID = contactDetails.contactID;");

        $dbConn->query("DELETE FROM Customers
         WHERE $customerID = Customers.customerID;");
    }
?>
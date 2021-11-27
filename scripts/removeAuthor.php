<?php
    // DONT TOUCH
    if (isset($_POST['authorID'])) {
        // Connect to the database
        $dbConn = new PDO('sqlite:../Data.db');

        $authorID = $_POST['authorID'];
        
        $contactID = $dbConn->query("SELECT contactID FROM Authors
         WHERE $authorID = Authors.authorID;")->fetch()[0];

        $dbConn->query("DELETE FROM ContactAddress
         WHERE $contactID = contactAddress.contactID;");
        
        $dbConn->query("DELETE FROM ContactEmail
         WHERE $contactID = contactEmail.contactID;");
        
        $dbConn->query("DELETE FROM ContactPhone
         WHERE $contactID = contactPhone.contactID;");
        
        $dbConn->query("DELETE FROM ContactDetails
         WHERE $contactID = contactDetails.contactID;");

        $dbConn->query("DELETE FROM BookAuthors
         WHERE $authorID = BookAuthors.authorID;");

        $dbConn->query("DELETE FROM Authors
         WHERE $authorID = Authors.authorID;");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
        <link rel = "stylesheet"  href="../styles/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Book Your Book | Order</title>
    </head>

    <body>
        <!-- Navigation bar -->
        <?php $isIndex = FALSE; ?>
        <?php include '../scripts/popNavbar.php' ?>

        <!-- Header and homepage link-->
        <h1 id="index-pg-hdr"><a class="link-no-display" href="../index.php">Book Your Book</a></h1>
        
        <h1>My Orders</h1>
        <table id="btable">
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Items</th>
                <th>Value</th>
                <th>Options</th>
            </tr>
            
            <!-- Populate the book list -->
            <?php
            // Connect to the database
            $dbConn = new PDO('sqlite:../Data.db');
            $result = $dbConn->query("SELECT orderID, date, customerID FROM Orders;");

            $noOrders = 1;
            foreach($result as $row) {
                if ($row['customerID'] == $_SESSION['customerID']) {
                    $orderID = $row['orderID'];
                    $date = $row['date'];
                    $value = $dbConn->query("SELECT SUM(price) FROM OrderItems, Books WHERE OrderItems.orderID = $orderID AND OrderItems.bookID = Books.ISBN;")->fetch()[0];;
                    $numItems = $dbConn->query("SELECT COUNT(IDNumber) FROM OrderItems WHERE OrderItems.orderID = $orderID;")->fetch()[0];
                    echo("<tr>");
                    echo("    <td>$orderID</td>");
                    echo("    <td>$date</td>");
                    echo("    <td>$numItems</td>");
                    echo("    <td>\$$value</td>");
                    echo("    <td><button name=\"$orderID\" class=\"order-details-btn\">Details</button><button name=\"$orderID\" class=\"remove-order-btn\">Cancel</button></td>");
                    echo("</tr>");
                    $noOrders = 0;
                }
            }
            if ($noOrders) {
                echo("<td>There are currently no orders.</td>");
            }
            ?>
        </table>
        
        <script>
            // DONT TOUCH! It's beautiful ),:
            $('.remove-order-btn').click(function() {
                $.ajax({
                    type: "POST",
                    url: "../scripts/removeOrder.php",
                    data: { orderID: $(this).attr('name') }
                }).done(function(msg) {
                    location.reload();
                });
            });
        </script>
    </body>
</html>

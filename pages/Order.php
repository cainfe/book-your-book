<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
        <link rel = "stylesheet"  href="../styles/style.css">
        <link rel="stylesheet" href="/styles/Order.css">
        <title>Book Your Book | Order</title>
    </head>

    <body>
        <!-- Navigation bar -->
        <?php $isIndex = FALSE; ?>
        <?php include '../scripts/popNavbar.php' ?>

        <!-- Header and homepage link-->
        <h1 id="index-pg-hdr"><a class="link-no-display" href="../index.php">Book Your Book</a></h1>
        
        <h1>My Cart</h1>
        <p></p>
        <table id="btable">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Supplier</th>
                <th>Category</th>
                <th>Reviews</th>
                <th>Add Book</th>
            </tr>
            
            <!-- Populate the book list -->
            <?php
            if (!isset($_SESSION['cart'])){
                echo("<td>There are no items in the cart.</td>");
            } else {
                // Connect to the database
                $dbConn = new PDO('sqlite:../Data.db');

                $result = $dbConn->query("SELECT fName, lName, ISBN, title, suppliedBy, reviews FROM Books, Authors, BookAuthors
                WHERE BookAuthors.bookID = Books.ISBN AND BookAuthors.authorID = Authors.authorID;");

                foreach($result as $row) {
                    if (in_array($row['ISBN'], $_SESSION['cart'])) {
                        $title = $row['title'];
                        $authorFName = $row['fName'];
                        $authorLName = $row['lName'];
                        $supplier = $row['suppliedBy'];
                        $category = "none";
                        $reviews = $row['reviews'];
                        echo("<tr>");
                        echo("    <td>$title</td>");
                        echo("    <td>$authorFName $authorLName</td>");
                        echo("    <td>$supplier</td>");
                        echo("    <td>$category</td>");
                        echo("    <td>$reviews</td>");
                        echo("    <td><button class=\"remove-book-btn\" onclick=\"myalert()\">Remove Book</button></td>");
                        echo("</tr>");
                    }
                }
            }
            ?>
        </table>

        <!--Order summary
            Place Order 
            View order-->
    </body>
</html>

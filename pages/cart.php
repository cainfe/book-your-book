<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
        <link rel = "stylesheet"  href="../styles/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Book Your Book | Cart</title>
    </head>

    <body>
        <!-- Navigation bar -->
        <?php $isIndex = FALSE; ?>
        <?php include '../scripts/popNavbar.php' ?>

        <!-- Header and homepage link-->
        <h1 id="index-pg-hdr"><a class="link-no-display" href="../index.php">Book Your Book</a></h1>
        
        <h1>My Cart</h1>
        <table id="btable">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Supplier</th>
                <th>Category</th>
                <th>Price</th>
                <th>Options</th>
            </tr>
            
            <form  action="../scripts/addOrder.php"><button type="submit" id="submit-cart-btn" class="form-submit-btn">Submit Order</button></form>
            
            <!-- Populate the book list -->
            <?php
            if (!isset($_SESSION['cart']) or count($_SESSION['cart']) == 0) {
                echo("<td>There are no items in the cart.</td>");
            } else {
                // Connect to the database
                $dbConn = new PDO('sqlite:../Data.db');

                $result = $dbConn->query("SELECT name, fName, lName, ISBN, title, price FROM Books, Authors, BookAuthors, Suppliers
                WHERE BookAuthors.bookID = Books.isbn AND BookAuthors.authorID = Authors.authorID AND Suppliers.supplierID = Books.suppliedBy;");

                foreach($result as $row) {
                    if (in_array($row['ISBN'], $_SESSION['cart'])) {
                        $isbn = $row['ISBN'];
                        $title = $row['title'];
                        $authorFName = $row['fName'];
                        $authorLName = $row['lName'];
                        $supplier = $row['name'];
                        $category = "none";
                        $price = $row['price'];
                        echo("<tr>");
                        echo("    <td>$title</td>");
                        echo("    <td>$authorFName $authorLName</td>");
                        echo("    <td>$supplier</td>");
                        echo("    <td>$category</td>");
                        echo("    <td>$price</td>");
                        echo("    <td><button class=\"remove-book-btn\" name=\"$isbn\">Remove Book</button></td>");
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
        
<script>
    $('.remove-book-btn').click(function() {
        //var isbn = $(this).attr('name');
        $.ajax({
            type: "POST",
            url: "../scripts/removeBookFromCart.php",
            data: { isbn: $(this).attr('name') }
        }).done(function(msg) {
            location.reload();
        });
    });
</script>

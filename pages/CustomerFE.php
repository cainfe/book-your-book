<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="..\styles\style.css">
        <link rel="stylesheet" href="..\styles\CustomerFE.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Book Your Book | Customer Account</title>
    </head>

    <body>
        <!-- Navigation bar -->
        <?php $isIndex = FALSE; ?>
        <?php include '../scripts/popNavbar.php' ?>

        <!-- Header and homepage link-->
        <h1 id="index-pg-hdr"><a class="link-no-display" href="../index.php">Book Your Book</a></h1>

        <!--Search bar-->
        <form action="" method="post" class="bar">
            <input type="text" id="search-books" placeholder="Search..">
            <button type="submit" name="submit">Search</button>
        </form>

        <table id="btable">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Supplier</th>
                <th>Category</th>
                <th>Reviews</th>
                <th>Options</th>
            </tr>
            
            <!-- Populate the book list -->
            <?php
                // Connect to the database
                $dbConn = new PDO('sqlite:../Data.db');

                $result = $dbConn->query("SELECT name, fName, lName, ISBN, title, reviews FROM Books, Authors, BookAuthors, Suppliers
                WHERE BookAuthors.bookID = Books.isbn AND BookAuthors.authorID = Authors.authorID AND Suppliers.supplierID = Books.suppliedBy;");

                foreach($result as $row) {
                    $isbn = $row['ISBN'];
                    $title = $row['title'];
                    $authorFName = $row['fName'];
                    $authorLName = $row['lName'];
                    $supplier = $row['name'];
                    $category = "none";
                    $reviews = $row['reviews'];
                    echo("<tr>");
                    echo("    <td>$title</td>");
                    echo("    <td>$authorFName $authorLName</td>");
                    echo("    <td>$supplier</td>");
                    echo("    <td>$category</td>");
                    echo("    <td>$reviews</td>");
                    echo("    <td><button class=\"add-book-btn\" name=\"$isbn\" >+</button>");
                    if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
                        //echo("    <button class=\"add-book-btn\" name=\"$isbn\" >E</button>");
                        echo("    <button class=\"remove-book-btn\" name=\"$isbn\" >R</button>");
                    }
                    echo("</td>");
                    echo("</tr>");
                }
                ?>
        </table>
        <p></p>
        
        <script>
            $('.add-book-btn').click(function() {
                $.ajax({
                    type: "POST",
                    url: "../scripts/addBookToCart.php",
                    data: { isbn: $(this).attr('name') }
                }).done(function(msg) {
                    if (window.confirm("Book has been succefully added. Go to cart?")){
                        location.assign("cart.php");
                    }
                });
            });
        </script>

        <script>
            $('.remove-book-btn').click(function() {
                if (window.confirm("This action will permanantly delete the book, continue?")) {
                    $.ajax({
                        type: "POST",
                        url: "../scripts/removeBook.php",
                        data: { isbn: $(this).attr('name') }
                    }).done(function(msg) {
                        location.reload();
                    });
                }
            });
        </script>

    </body>
</html>


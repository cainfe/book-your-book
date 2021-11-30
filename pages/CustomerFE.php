<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="..\styles\style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Book Your Book | Book Shelf</title>
    </head>

    <body>
        <!-- Navigation bar -->
        <?php $isIndex = FALSE; ?>
        <?php include '../scripts/popNavbar.php' ?>

        <!-- Header and homepage link-->
        <h1 id="index-pg-hdr"><a class="link-no-display" href="../index.php">Book Your Book</a></h1>
        
        <?php 
            if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
                echo("<button onclick=\"toggleForm('add-book', 1)\">Add book</button>");
            }
        ?>

        <!--Search bar-->
        <form class="bar">
            <input type="text" id="books-search-bar" name="search" placeholder="Search..">
            <button type="submit" id="book-search-submit-btn" name="submit">Search</button>
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
                
                if (isset($_SESSION["ba"])) {
                    $search = $_SESSION["ba"];
                    $result = $dbConn->query("SELECT name, fName, lName, ISBN, title, reviews 
                    FROM Books, Authors, BookAuthors, Suppliers, BookCategories, AssignedCategory
                    WHERE BookAuthors.bookID = Books.isbn AND BookAuthors.authorID = Authors.authorID 
                    AND Suppliers.supplierID = Books.suppliedBy AND Books.ISBN = AssignedCategory.bookID
                    AND AssignedCategory.categoryCode = BookCategories.code
                    AND (Books.title LIKE '%$search%' OR Books.reviews LIKE '%$search%'
                    OR Authors.fname LIKE '%$search%' OR Authors.lname LIKE '%$search%'
                    OR Suppliers.name LIKE '%$search%' OR BookCategories.description LIKE '%$search%');");
                    unset($_SESSION['ba']);
                } else {
                    $result = $dbConn->query("SELECT name, fName, lName, ISBN, title, reviews FROM Books, Authors, BookAuthors, Suppliers
                    WHERE BookAuthors.bookID = Books.isbn AND BookAuthors.authorID = Authors.authorID AND Suppliers.supplierID = Books.suppliedBy ORDER BY title;");
                }

                //Category and a book have 2?
                /* SELECT name, fName, lName, ISBN, title, reviews, description FROM Books, Authors, BookAuthors, Suppliers, BookCategories, AssignedCategory
                WHERE BookAuthors.bookID = Books.isbn AND BookAuthors.authorID = Authors.authorID AND Suppliers.supplierID = Books.suppliedBy
                AND Books.ISBN = AssignedCategory.bookID AND AssignedCategory.categoryCode = BookCategories.code; */

                foreach($result as $row) {
                    $isbn = $row['ISBN'];
                    $title = $row['title'];
                    $authorFName = $row['fName'];
                    $authorLName = $row['lName'];
                    $supplier = $row['name'];
                    $category = $dbConn->query("SELECT description FROM BookCategories, AssignedCategory WHERE $isbn = AssignedCategory.bookID AND AssignedCategory.categoryCode = BookCategories.code");
                    $reviews = $row['reviews'];
                    echo("<tr>");
                    echo("    <td>$title</td>");
                    echo("    <td>$authorFName $authorLName</td>");
                    echo("    <td>$supplier</td>");
                    echo("    <td>");
                    foreach($category as $name) {
                        echo($name['description'] . ", ");
                    }
                    echo("    </td>");
                    echo("    <td>$reviews</td>");
                    echo("    <td>");
                    echo("    <button class=\"add-book-btn\" name=\"$isbn\" >+</button>");
                    if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
                        echo("    <button class=\"edit-book-btn\" name=\"$isbn\" >E</button>");
                        echo("    <button class=\"remove-book-btn\" name=\"$isbn\" >R</button>");
                    }
                    echo("    </td>");
                    echo("</tr>");
                }
                ?>
        </table>

        <!-- popup form - add book -->
        <div class="popup-form container form-container" id="add-book">
            <button class="form-close-btn" onclick="toggleForm('add-book', 0)">x</button>
            <h2 class="form-title">ADD BOOK</form></h2>
            <form id="add-book-form" action="../scripts/addBook.php" method="post">
                <div class="form-data">
                    <label>ISBN</label>
                    <input type="text" name="isbn" class="data-input" id="add-book-isbn-field" required>
                </div>
                <div class="form-data">
                    <label>Title</label>
                    <input type="text" name="title" class="data-input" id="add-book-title-field" required>
                </div>
                <div class="form-data">
                    <label>Author</label><br>
                    <select type="text" name="author" class="data-input" id="add-book-author-field" required>
                        <option disabled selected value></option>
                        <?php
                        $dbConn = new PDO('sqlite:../Data.db');
                        $result = $dbConn->query("SELECT authorID, fName, lName FROM Authors ORDER BY lName");

                        foreach($result as $row) {
                            $authorID = $row['authorID'];
                            $fName = $row['fName'];
                            $lName = $row['lName'];
                            echo("<option value=\"$authorID\">$fName $lName</option>");
                        }
                        ?>
                    </select>
                </div>
                <div class="form-data" id="category-input">
                    <label>Categories</label><br>
                    <?php
                    $dbConn = new PDO('sqlite:../Data.db');
                    $result = $dbConn->query("SELECT code, description FROM BookCategories ORDER BY description");

                    foreach($result as $row) {
                        $code = $row['code'];
                        $description = $row['description'];
                        echo("<label class=\"category-label\"><input type=\"checkbox\" id=\"$description\" name=\"categories[]\" class=\"category-checkbox\" value=\"$code\"> $description</label>");
                    }
                    ?>
                </div>
                <div class="form-data">
                    <label>Supplier</label><br>
                    <select type="text" name="supplier" class="data-input" id="add-book-supplier-field" required>
                        <option disabled selected value></option>
                        <?php
                        $dbConn = new PDO('sqlite:../Data.db');
                        $result = $dbConn->query("SELECT supplierID, name FROM Suppliers ORDER BY name");

                        foreach($result as $row) {
                            $supplierID = $row['supplierID'];
                            $name = $row['name'];
                            echo("<option value=\"$supplierID\">$name</option>");
                        }
                        ?>
                    </select>
                </div>
                <div class="form-data">
                    <label>Publication Date</label>
                    <input type="date" name="publication-date" class="data-input" id="add-book-publicaton-date-field" required>
                </div>
                <div class="form-data">
                    <label>Price</label>
                    <input type="number" step="any" name="price" class="data-input" id="add-book-price-field" required>
                </div>
                <div class="form-data">
                    <label>Reviews</label>
                    <input type="number" min="0" max="5" step="any" name="reviews" class="data-input" id="add-book-reviews-field" required>
                </div>

                <button type="submit" id="btn-submit-book" class="form-submit-btn btn-submit-book">Add</button>
            </form>
        </div>
        <!-- popup form - edit book -->
        <div class="popup-form container form-container" id="edit-book">
            <button class="form-close-btn" onclick="toggleForm('edit-book', 0)">x</button>
            <h2 class="form-title">EDIT BOOK</form></h2>
            <form id="edit-book">
                <div class="form-data">
                    <label>ISBN</label>
                    <input type="text" name="isbn" class="data-input" id="edit-book-isbn-field">
                </div>
                <div class="form-data">
                    <label>Title</label>
                    <input type="text" name="title" class="data-input" id="edit-book-title-field">
                </div>
                <div class="form-data">
                    <label>Author</label><br>
                    <select type="text" name="author" class="data-input" id="edit-book-author-field">
                        <option disabled selected value></option>
                        <?php
                        $dbConn = new PDO('sqlite:../Data.db');
                        $result = $dbConn->query("SELECT authorID, fName, lName FROM Authors ORDER BY lName");

                        foreach($result as $row) {
                            $authorID = $row['authorID'];
                            $fName = $row['fName'];
                            $lName = $row['lName'];
                            echo("<option value=\"$authorID\">$fName $lName</option>");
                        }
                        ?>
                    </select>
                </div>
                <div class="form-data" id="category-input">
                    <label>Categories</label><br>
                    <?php
                    $dbConn = new PDO('sqlite:../Data.db');
                    $result = $dbConn->query("SELECT code, description FROM BookCategories ORDER BY description");

                    foreach($result as $row) {
                        $code = $row['code'];
                        $description = $row['description'];
                        echo("<label class=\"category-label\"><input type=\"checkbox\" id=\"$description\" name=\"categories[]\" class=\"category-checkbox\" value=\"$code\"> $description</label>");
                    }
                    ?>
                </div>
                <div class="form-data">
                    <label>Supplier</label><br>
                    <select type="text" name="supplier" class="data-input" id="edit-book-supplier-field">
                        <option disabled selected value></option>
                        <?php
                        $dbConn = new PDO('sqlite:../Data.db');
                        $result = $dbConn->query("SELECT supplierID, name FROM Suppliers ORDER BY name");

                        foreach($result as $row) {
                            $supplierID = $row['supplierID'];
                            $name = $row['name'];
                            echo("<option value=\"$supplierID\">$name</option>");
                        }
                        ?>
                    </select>
                </div>
                <div class="form-data">
                    <label>Publication Date</label>
                    <input type="date" name="publication-date" class="data-input" id="edit-book-publication-date-field">
                </div>
                <div class="form-data">
                    <label>Price</label>
                    <input type="number" step="any" name="price" class="data-input" id="edit-book-price-field">
                </div>
                <div class="form-data">
                    <label>Reviews</label>
                    <input type="number" min="0" max="5" step="any" name="reviews" class="data-input" id="edit-book-reviews-field">
                </div>

                <button type="submit" id="btn-submit-book-edit" class="form-submit-btn edit-book-submit-btn">Confirm</button>
            </form>
        </div>

    </body>
</html>

<script>
    var oldIsbn = 0;

    function toggleForm(form, show) 
    {
        var x = document.getElementById(form);
        if (show) {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>

<script>
    $('.edit-book-btn').click(function() {
        oldIsbn = $(this).attr('name');
        toggleForm("edit-book", 1);
    });
</script>

<script>
    $('#btn-submit-book-edit').click(function() {
    var isbn = document.getElementById("edit-book-isbn-field").value;
    var title = document.getElementById("edit-book-title-field").value;
    var authorID = document.getElementById("edit-book-author-field").value;
    var supplierID = document.getElementById("edit-book-supplier-field").value;
    var publicationDate = document.getElementById("edit-book-publication-date-field").value;
    var price = document.getElementById("edit-book-price-field").value;
    var reviews = document.getElementById("edit-book-reviews-field").value;
    var categoryID = document.getElementsByName("categories[]");
    var categoryIDs = [];
    for (var i = 0; categoryID[i]; ++i) {
        if (categoryID[i].checked) {
            categoryIDs.push(categoryID[i].value);
        }
    }
    categoryIDs = JSON.stringify(categoryIDs);
    $.ajax({
            type: "POST",
            url: "../scripts/editBook.php",
            data: { oldIsbn, isbn, title, authorID, supplierID, publicationDate, price, reviews, categoryIDs }
        }).done(function(msg) {
            location.reload();
        });
    });
</script>

<script>
    $('#book-search-submit-btn').click(function() {
        var searchTerm = document.getElementById("books-search-bar").value;
        $.ajax({
            type: "POST",
            url: "../scripts/searchBook.php",
            data: { searchTerm }
        }).done(function(msg) {
            $_SESSION['bookSearchTerm'] = msg;
            location.reload();
        });
    });
</script>
        
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
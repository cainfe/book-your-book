<!DOCTYPE html>
<html lang= "en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
        <link rel = "stylesheet"  href="styles/style.css">
        <title>Book your Book</title>
    </head>

    <body>
        <!-- Navigation bar -->
        <?php $isIndex = TRUE; ?>
        <?php include 'scripts/popNavbar.php' ?>

        <!-- Header and homepage link-->
        <h1 id="index-pg-hdr"><a class="link-no-display" href="index.php">Book Your Book</a></h1>


        <!-- Testing -->
        <?php 
            if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
                echo("<button onclick=\"toggleForm('add-book', 1)\">Add book</button>");
            }
        ?>

        <!-- popup form - add book -->
        <div class="opup-form container form-container" id="add-book">
			<button class="form-close-btn" onclick="toggleForm('add-book', 0)">x</button>
            <h2 class="form-title">ADD BOOK</form></h2>
			<form id="login-form" action="../scripts/addBook.php" method="post">
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
                        $dbConn = new PDO('sqlite:Data.db');
                        $result = $dbConn->query("SELECT authorID, fName, lName FROM Authors");

                        foreach($result as $row) {
                            $authorID = $row['authorID'];
                            $fName = $row['fName'];
                            $lName = $row['lName'];
                            echo("<option value=\"$authorID\">$fName $lName</option>");
                        }
                        ?>
                    </select>
				</div>
				<div class="form-data">
					<label>Publisher</label><br>
					<select type="text" name="publisher" class="data-input" id="add-book-publisher-field" required>
                        <option disabled selected value></option>
                        <?php
                        $dbConn = new PDO('sqlite:Data.db');
                        $result = $dbConn->query("SELECT supplierID, name FROM Suppliers");

                        foreach($result as $row) {
                            $supplierID = $row['supplierID'];
                            $name = $row['name'];
                            echo("<option value=\"$authorID\">$name</option>");
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

        
        <script>
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
    </body>
</html>
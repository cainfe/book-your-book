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
        <div class="popup-form container form-container" id="add-book">
			<button class="form-close-btn" onclick="toggleForm('add-book', 0)">x</button>
            <h2 class="form-title">ADD BOOK</form></h2>
			<form id="login-form" action="../scripts/addBook.php" method="post">
				<div class="form-data">
					<label>Title</label>
					<input type="text" name="title" class="data-input" id="add-book-title-field" required>
				</div>
				<div class="form-data">
					<label></label>
					<input type="text" name="" class="data-input" id="add-book--field" required>
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
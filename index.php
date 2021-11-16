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
        <button>Add book</button>

        <!-- popup form - add book -->
        <div class="popup-form container form-container" id="add-book">
			<button class="form-close-btn">x</button>
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

				<button type="submit" id="btn-submit-book" class="btn-submit btn-submit-book">Add</button>
			</form>
		</div>
    </body>
</html>
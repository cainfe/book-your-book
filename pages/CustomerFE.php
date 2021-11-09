<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="..\styles\style.css">
        <link rel="stylesheet" href="..\styles\CustomerFE.css">
        <title>Book Your Book | Customer Account</title>
    </head>

    <body>
        <!-- Navigation bar -->
        <?php $isIndex = FALSE; ?>
        <?php include '../scripts/popNavbar.php' ?>

        <!-- Header and homepage link-->
        <h1 id="index-pg-hdr"><a class="link-no-display" href="../index.php">Book Your Book</a></h1>

        <!--Search bar-->
        <div class="bar">
            <input type="text" placeholder="Search..">
        </div>
        <p></p>
        
        <!--Browse for books-->
        <div class="bbar">
            <a href="#title">Title</a>
            <a href="#publication">Publication</a>
            <a href="#category">Category</a>
            <a href="#reviews">Reviews</a>
        </div>
        <p></p>


        <div class="container" id="ccontainer">
            <div class="cbutton Skeywords">Search using keywords</div>
            <div class="cbutton browse">Browse for books</div>
            <div class="cbutton addbook">Add book to order</div>
            <div class="cbutton change">Change order</div>
            <div class="cbutton place">Place order</div>
            <div class="cbutton view">View order</div>
        </div>
    </body>
</html>

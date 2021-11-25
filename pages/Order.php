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
                <th>Publication</th>
                <th>Category</th>
                <th>Reviews</th>
                <th>Remove</th>
            </tr>
            <!--Books added in table-->
        </table>

        <!--Order summary
            Place Order 
            View order-->
    </body>
</html>

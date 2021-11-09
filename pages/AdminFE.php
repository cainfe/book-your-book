<!DOCTYPE html>
<html lang= "en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
        <link rel = "stylesheet"  href="../styles/style.css">
        <link rel = "stylesheet"  href="../styles/AdminFE.css">
        <title>Book your Book | Admin</title>
    </head>

    <body>
        <!-- Navigation bar -->
        <?php $isIndex = FALSE; ?>
        <?php include '../scripts/popNavbar.php' ?>

        <!-- Header and homepage link-->
        <h1 id="index-pg-hdr"><a class="link-no-display" href="../index.php">Book Your Book</a></h1>

        <div class ="container" id="acontainer">
            <div class="abutton VCustomer">Customers</div>
            <div class="abutton VOrder">Orders</div>
            <div class="abutton VBook">Books</div>
            <div class="abutton VSupplier">Suppliers</div>
            <div class="abutton VAuthor">Authors</div>
            <div class="abutton CCustomer">Update Customer Details</div>
            <div class="abutton CAuthor">Update Author Details</div>
            <div class="abutton CBook">Update Book Details</div>
            <div class="abutton RCustomer">Remove Customer</div>
            <div class="abutton RAuthor">Remove Author</div>
            <div class="abutton RBook">Remove Book</div>
            <div class="abutton RSupplier">Remove Supplier</div>
        </div>
    </body>
</html>
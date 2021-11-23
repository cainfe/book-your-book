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
        <form action="" method="post" class="bar">
            <input type="text" id="search" placeholder="Search..">
            <button type="submit" name="submit">Search</button>
        </form>
        
        <!-- <div class="bar">
            <input type="text" id="search" placeholder="Search..">
        </div> -->
        <p></p>
        
        <!--Browse for books-->
        <div class="bbar">
            <a href="#title">Title</a>
            <a href="#publication">Publication</a>
            <a href="#category">Category</a>
            <a href="#reviews">Reviews</a>
            <!-- <a>Add</a> -->
        </div>
        <p></p>


        <!--addbook button-->
        <script>
            function myalert(){
                if (window.confirm("Book has been succefully added. Go to cart.")){
                    window.open("Order.html");
                }
            }
        </script>

        <table id="btable">
            <tr>
                <th>Title</th>
                <th>Publication</th>
                <th>Category</th>
                <th>Reviews</th>
                <th>Add Book</th>
            </tr>
            
            <tr>
                <td>Dune</td>
                <td>1956-6-1</td>
                <td>Science Fiction</td>
                <td>4.16</td>
                <td><button id="addbook" onclick="myalert()">Add Book</button></td>
            </tr>
        </table>
        <p></p>
        
        

    </body>
</html>


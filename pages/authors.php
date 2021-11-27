<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="..\styles\style.css">
        <link rel="stylesheet" href="..\styles\CustomerFE.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Book Your Book | Authors</title>
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
                <th>Author</th>
                <th>Gender</th>
                <th>Birthdate</th>
                <th>Options</th>
            </tr>
            
            <!-- Populate the book list -->
            <?php
                // Connect to the database
                $dbConn = new PDO('sqlite:../Data.db');

                $result = $dbConn->query("SELECT authorID, fName, lName, gender, birthDate FROM Authors;");

                foreach($result as $row) {
                    $authorID = $row['authorID'];
                    $authorFName = $row['fName'];
                    $authorLName = $row['lName'];
                    $gender = $row['gender'];
                    $birthdate = $row['birthDate'];
                    echo("<tr>");
                    echo("    <td>$authorFName $authorLName</td>");
                    echo("    <td>$gender</td>");
                    echo("    <td>$birthdate</td>");
                    echo("    <td>");
                    if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
                        //echo("    <button class=\"add-author-btn\" name=\"$isbn\" >E</button>");
                        echo("    <button class=\"remove-author-btn\" name=\"$authorID\" >R</button>");
                    }
                    echo("    </td>");
                    echo("</tr>");
                }
                ?>
        </table>
        <p></p>

        <script>
            $('.remove-author-btn').click(function() {
                if (window.confirm("This action will permanantly delete the author, continue?")) {
                    $.ajax({
                        type: "POST",
                        url: "../scripts/removeAuthor.php",
                        data: { isbn: $(this).attr('name') }
                    }).done(function(msg) {
                        location.reload();
                    });
                }
            });
        </script>

    </body>
</html>


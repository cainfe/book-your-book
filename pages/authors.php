<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="..\styles\style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Book Your Book | Authors</title>
    </head>

    <body>
        <!-- Navigation bar -->
        <?php $isIndex = FALSE; ?>
        <?php include '../scripts/popNavbar.php' ?>

        <!-- Header and homepage link-->
        <h1 id="index-pg-hdr"><a class="link-no-display" href="../index.php">Book Your Book</a></h1>
        
        <?php 
            if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
                echo("<button onclick=\"toggleForm('add-author', 1)\">Add author</button>");
            }
        ?>

        <!--Search bar-->
        <form action="" method="post" class="bar">
            <input type="text" id="search-authors" placeholder="Search..">
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
                        echo("    <button class=\"edit-author-btn\" name=\"$authorID\" >E</button>");
                        echo("    <button class=\"remove-author-btn\" name=\"$authorID\" >R</button>");
                    }
                    echo("    </td>");
                    echo("</tr>");
                }
                ?>
        </table>

        <!-- popup form - add author -->
        <div class="popup-form container form-container" id="add-author">
            <button class="form-close-btn" onclick="toggleForm('add-author', 0)">x</button>
            <h2 class="form-title">ADD AUTHOR</form></h2>
            <form id="add-author-form" action="../scripts/addAuthor.php" method="post">
                <div class="form-data">
                    <label>First Name</label>
                    <input type="text" name="first-name" class="data-input" id="add-author-fname-field" required>
                </div>
                <div class="form-data">
                    <label>Last Name</label>
                    <input type="text" name="last-name" class="data-input" id="add-author-lname-field" required>
                </div>
                <div class="form-data">
                    <label>Gender</label><br>
                    <select type="text" name="gender" class="data-input" id="add-author-gender-field" required>
                        <option disabled selected value></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-data">
                    <label>Birthday</label>
                    <input type="date" name="birthday" class="data-input" id="add-author-birthday-date-field" required>
                </div>
                <div class="form-data">
                    <label>Email</label>
                    <input type="email" name="email" class="data-input" id="add-author-email-field">
                </div>
                <div class="form-data">
                    <label>Phone</label>
                    <input type="text" name="phone" class="data-input" id="add-author-phone-field">
                </div>
                <div class="form-data">
                    <label>Address</label>
                    <input type="text" name="address" class="data-input" id="add-author-address-field">
                </div>

                <button type="submit" id="btn-submit-author" class="form-submit-btn btn-submit-book">Add</button>
            </form>
        </div>

        <!-- popup form - edit author -->
        <div class="popup-form container form-container" id="edit-author">
                <button class="form-close-btn" onclick="toggleForm('edit-author', 0)">x</button>
                <h2 class="form-title">EDIT AUTHOR</form></h2>
                <form id="edit-author-form">
                    <div class="form-data">
                        <label>First Name</label>
                        <input type="text" name="first-name" class="data-input" id="edit-author-fname-field">
                    </div>
                    <div class="form-data">
                        <label>Last Name</label>
                        <input type="text" name="last-name" class="data-input" id="edit-author-lname-field">
                    </div>
                    <div class="form-data">
                        <label>Gender</label><br>
                        <select type="text" name="gender" class="data-input" id="edit-author-gender-field">
                            <option disabled selected value></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-data">
                        <label>Birthday</label>
                        <input type="date" name="birthday" class="data-input" id="edit-author-birth-date-field">
                    </div>
                    <div class="form-data">
                        <label>Email</label>
                        <input type="email" name="email" class="data-input" id="edit-author-email-field">
                    </div>
                    <div class="form-data">
                        <label>Phone</label>
                        <input type="text" name="phone" class="data-input" id="edit-author-phone-field">
                    </div>
                    <div class="form-data">
                        <label>Address</label>
                        <input type="text" name="address" class="data-input" id="edit-author-address-field">
                    </div>

                    <button type="submit" id="btn-submit-author-edit" class="form-submit-btn edit-author-submit-btn">Confirm</button>
                </form>
            </div>
    </body>
</html>

<script>
    var sID = 0;

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
    $('.edit-author-btn').click(function() {
        aID = $(this).attr('name');
        toggleForm("edit-author", 1);
    });
</script>

<script>
    $('.edit-author-submit-btn').click(function() {
    var fname = document.getElementById("edit-author-fname-field").value;
    var lname = document.getElementById("edit-author-lname-field").value;
    var gender = document.getElementById("edit-author-gender-field").value;
    var birthDate = document.getElementById("edit-author-birth-date-field").value;
    var email = document.getElementById("edit-author-email-field").value;
    var address = document.getElementById("edit-author-address-field").value;
    var phone = document.getElementById("edit-author-phone-field").value;
    $.ajax({
            type: "POST",
            url: "../scripts/editAuthor.php",
            data: { aID, fname, lname, gender, birthDate, email, address, phone }
        }).done(function(msg) {
            location.reload();
        });
    });
</script>

<script>
    $('.remove-author-btn').click(function() {
        if (window.confirm("This action will permanantly delete the author, continue?")) {
            $.ajax({
                type: "POST",
                url: "../scripts/removeAuthor.php",
                data: { authorID: $(this).attr('name') }
            }).done(function(msg) {
                location.reload();
            });
        }
    });
</script>


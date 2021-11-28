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
        
        <!-- POPUP FORMS -->
        <div>
            <?php 
                if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
                    echo("<button onclick=\"toggleForm('add-book', 1)\">Add book</button>");
                }
            ?>
            <?php 
                if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
                    echo("<button onclick=\"toggleForm('add-author', 1)\">Add author</button>");
                }
            ?>
            <?php 
                if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
                    echo("<button onclick=\"toggleForm('add-supplier', 1)\">Add supplier</button>");
                }
            ?>
            <?php 
                if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
                    echo("<button onclick=\"toggleForm('add-supplier-rep', 1)\">Add supplier representative</button>");
                }
            ?>
            <?php 
                if (isset($_SESSION['isAdmin']) AND $_SESSION['isAdmin']) {
                    echo("<button onclick=\"toggleForm('add-customer', 1)\">Add customer</button>");
                }
            ?>

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
                            $result = $dbConn->query("SELECT authorID, fName, lName FROM Authors ORDER BY lname;");

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
                            echo("<label class=\"category-label\"><input type=\"checkbox\" id=\"$description\" name=\"$code\" class=\"category-checkbox\" value=\"$code\"> $description</label>");
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
            
            <!-- popup form - add supplier -->
            <div class="popup-form container form-container" id="add-supplier">
                <button class="form-close-btn" onclick="toggleForm('add-supplier', 0)">x</button>
                <h2 class="form-title">ADD SUPPLIER</form></h2>
                <form id="add-supplier-from" action="../scripts/addSupplier.php" method="post">
                    <div class="form-data">
                        <label>Name</label>
                        <input type="text" name="name" class="data-input" id="add-supplier-name-field" required>
                    </div>

                    <button type="submit" id="btn-submit-author" class="form-submit-btn btn-submit-book">Add</button>
                </form>
            </div>

            <!-- popup form - add supplierRep -->
            <div class="popup-form container form-container" id="add-supplier-rep">
                <button class="form-close-btn" onclick="toggleForm('add-supplier-rep', 0)">x</button>
                <h2 class="form-title">ADD SUPPLIER REPRESENTATIVE</form></h2>
                <form id="add-author-form" action="../scripts/addSupplierRep.php" method="post">
                    <div class="form-data">
                        <label>First Name</label>
                        <input type="text" name="first-name" class="data-input" id="add-supplier-rep-fname-field" required>
                    </div>
                    <div class="form-data">
                        <label>Last Name</label>
                        <input type="text" name="last-name" class="data-input" id="add-supplier-rep-lname-field" required>
                    </div>
                    <div class="form-data">
                        <label>Email</label>
                        <input type="email" name="email" class="data-input" id="add-author-email-field" required>
                    </div>
                    <div class="form-data">
                        <label>Work Phone</label>
                        <input type="text" name="work-phone" class="data-input" id="add-author-work-phone-field" required>
                    </div>
                    <div class="form-data">
                        <label>Cell Phone</label>
                        <input type="text" name="cell-phone" class="data-input" id="add-author-cell-phone-field" required>
                    </div>
                    <div class="form-data">
                        <label>Works For</label><br>
                        <select type="text" name="supplier" class="data-input" id="add-supplier-rep-supplier-field" required>
                            <option disabled selected value></option>
                            <?php
                            $dbConn = new PDO('sqlite:../Data.db');
                            $result = $dbConn->query("SELECT supplierID, name FROM Suppliers ORDER BY name;");

                            foreach($result as $row) {
                                $supplierID = $row['supplierID'];
                                $name = $row['name'];
                                echo("<option value=\"$supplierID\">$name</option>");
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" id="btn-submit-supplier-rep" class="form-submit-btn btn-submit-book">Add</button>
                </form>
            </div>
            <div class="popup-form container form-container" id="add-customer">
                <button class="form-close-btn" onclick="toggleForm('add-customer', 0)">x</button>
                <h2 class="form-title">ADD CUSTOMER</form></h2>
                <form id="add-customer-form" action="../scripts/addCustomer.php" method="post">
                    <div class="form-data">
                        <label>First Name</label>
                        <input type="text" name="first-name" class="data-input" id="add-customer-fname-field" required>
                    </div>
                    <div class="form-data">
                        <label>Last Name</label>
                        <input type="text" name="last-name" class="data-input" id="add-customer-lname-field" required>
                    </div>
                    <div class="form-data">
                        <label>Username</label>
                        <input type="text" name="username" class="data-input" id="add-customer-username-field" required>
                    </div>
                   
                    <div class="form-data">
                        <label>Password</label>
                        <input type="text" name="password" class="data-input" id="add-customer-password-field" required>
                    </div>
                    <div class="form-data">
                        <label>Email</label>
                        <input type="email" name="email" class="data-input" id="add-customer-email-field">
                    </div>
                    <div class="form-data">
                        <label>Phone</label>
                        <input type="text" name="phone" class="data-input" id="add-customer-phone-field">
                    </div>
                    <div class="form-data">
                        <label>Address</label>
                        <input type="text" name="address" class="data-input" id="add-customer-address-field">
                    </div>

                    <button type="submit" id="btn-submit-customer" class="form-submit-btn btn-submit-book">Add</button>
                </form>
            </div>
        </div>
    </body>
</html>

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
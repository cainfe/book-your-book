<?php
session_start();

$_SESSION["ba"] = $_POST["searchTerm"];
echo $_POST["searchTerm"];

?>

<?php
require_once "functions.php";
require_once "templates.php";
require_once "model/movies.php";
require_once "view/movies.php";
require_once "view/login.php";

?>

<?php

if (!isset($_SESSION) && ($_SESSION['loggedIn'])) {
    $htmlContent = displayWelcome();
} else {
    $htmlContent = createLoginScreen();
}
?>

<?php include_once "base.php" ?>
<?php
require_once "functions.php";
require_once "templates.php";
require_once "model/movies.php";
require_once "view/movies.php";
require_once "view/login.php";
include_once "session.php";
?>

<?php

if (isset($_SESSION['loggedIn']) && ($_SESSION['loggedIn'])) {
    $htmlContent = displayWelcome();
} elseif (isset($_SESSION['loginError'])) {
    $htmlContent = '<div class="rood SpanC2R2">' . $_SESSION['loginError']  . '</div>';
    $htmlContent .= createLoginScreen();
} else {
    $htmlContent = createLoginScreen();
}

$htmlContent .= '<div>' . var_dump($_SESSION) . '</div>';

?>

<?php include_once "base.php" ?>
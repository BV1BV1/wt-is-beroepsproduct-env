<?php
require_once "functions.php";
require_once "view/templates.php";
require_once "model/movies.php";
require_once "view/movies.php";
require_once "view/login.php";
include_once "session.php";

?>

<?php

$previous_page = $_SERVER['HTTP_REFERER'];
$path_parts = pathinfo($previous_page);
$result = $path_parts['basename'];
$_SESSION['prevpage'] = $result;

if (isset($_SESSION['loggedIn']) && ($_SESSION['loggedIn'])) {
    $htmlContent = displayWelcome();
} elseif (isset($_SESSION['loginError'])) {
    $htmlContent = '<div class="rood SpanC2R2">' . $_SESSION['loginError']  . '</div>';
    $htmlContent .= createLoginScreen();
} else {
    $htmlContent = createLoginScreen();
}
$htmlContent .= createSpecificFiller(30);

?>

<?php include_once "base.php" ?>
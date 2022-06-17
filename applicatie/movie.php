<?php
require_once "functions.php";
require_once "templates.php";
require_once "model/movies.php";
require_once "view/movies.php";
?>

<?php
$htmlContent = getMovieDetailsToHtml(getMovieDetails($_GET['movie_id']))
    . getMovieCastToHtml(getMovieCast())
    . createSpecificFiller(20)
?>

<?php include_once "base.php" ?>
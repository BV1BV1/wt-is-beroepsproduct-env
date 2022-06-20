<?php
require_once "functions.php";
require_once "templates.php";
require_once "model/movies.php";
require_once "view/movies.php";
include "session.php";
?>

<?php
$htmlContent = getMovieDetailsToHtml(getMovieDetails($_GET['movie_id']))
    . getMovieCastToHtml(getMovieCast())
    . createSpecificFiller(8)
    . searchedMoviesToHtml(getMoviesFromMoviecast())
    . createSpecificFiller(12)
?>

<?php include_once "base.php" ?>
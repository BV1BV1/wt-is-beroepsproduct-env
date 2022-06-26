<?php
// require_once "functions.php";
require_once "view/templates.php";
require_once "model/movies.php";
require_once "view/movies.php";
include_once "session.php";
?>

<?php
$htmlContent =
    getMovieDetailsToHtml(getMovieDetails($_GET['movie_id']))
    . getMovieCastToHtml(getMovieCast($_GET['movie_id']))
    . createSpecificFiller(8)
    . searchedMoviesToHtml(getMoviesFromMoviecast($_GET['movie_id']))
    . createSpecificFiller(12)
    . createWishlistButton();
?>

<?php include_once "base.php" ?>
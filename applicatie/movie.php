<?php
require_once "functions.php";
require_once "templates.php";
require_once "genres.php";
require_once "model/movies.php";
require_once "view/movies.php";
?>

<?php
$htmlContent = getMovieDetailsToHtml(getMovieDetails( $_GET['movie_id'])) 
              .getMovieCastToHtml(getMovieCast())
?>

<?php include_once "base.php" ?>
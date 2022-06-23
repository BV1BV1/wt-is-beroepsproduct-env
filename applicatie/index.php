<?php
require_once "functions.php";
require_once "view/templates.php";
require_once "view/movies.php";
include_once "session.php";

?>

<?php

$htmlContent = generateGenretab();
$htmlContent .= createSlider(getDefaultMovies());

if ((sizeof($_GET) == 1) && isset($_GET['person_id'])) {
    $htmlContent .= getCastmemberToHtml(getMoviesFromMoviecastmember());
} elseif (sizeof($_GET) > 0) {
    $htmlContent .= searchedMoviesToHtml(getMovieBySearch());
} else {
    $htmlContent .= searchedMoviesToHtml(getDefaultMovies());
}

?>


<?php include_once "base.php" ?>
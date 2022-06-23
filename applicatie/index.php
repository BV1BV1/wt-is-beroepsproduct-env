<?php
// require_once "functions.php";
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
    //als er minstens 3 films in wishlist staan dan tonen we deze ipv de standaard lijst
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] && getWishlist() && count(getWishlist()) > 2) {
        $htmlContent .= searchedMoviesToHtml(getWishlist());
    } else {
        $htmlContent .= searchedMoviesToHtml(getDefaultMovies());
    }
}

?>


<?php include_once "base.php" ?>
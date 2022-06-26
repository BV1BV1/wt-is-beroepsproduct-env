<?php
// require_once "functions.php";
require_once "view/templates.php";
require_once "view/movies.php";
include_once "session.php";

?>

<?php

$htmlContent = generateGenretab();
$htmlContent .= createSlider(getSliderContent());

//De standaard invulling van de pagina (en de slider) is nu als volgt geimplementeerd:
//Als er een zoekopdracht is gedaan dan worden de resultaten van de zoekopdracht getoond
//Als er geen zoekopdracht is gedaan maar een klant is ingelogd en heeft een wishlist met meer dan 2 titels dan worden deze titels getoond
//Als aan beide bovenstaande criteria niet wordt voldaan dan wordt een standaard invulling getoond (films die fletnix in de etalage wil zetten) 

if ((sizeof($_GET) == 1) && isset($_GET['person_id'])) {
    $htmlContent .= getCastmemberToHtml(getMoviesFromMoviecastmember($_GET['person_id']));
} elseif (sizeof($_GET) > 0) {
    $htmlContent .= searchedMoviesToHtml(getMovieBySearch());
} else {
    //als er minstens 3 films in wishlist staan dan tonen we deze ipv de standaard lijst
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] && getWishlist($_SESSION['email']) && count(getWishlist($_SESSION['email'])) > 2) {
        $htmlContent .= searchedMoviesToHtml(getWishlist($_SESSION['email']));
    } else {
        $htmlContent .= searchedMoviesToHtml(getDefaultMovies());
    }
}

?>


<?php include_once "base.php" ?>
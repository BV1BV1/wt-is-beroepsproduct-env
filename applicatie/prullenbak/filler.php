<?php
include_once "view/movies.php";

global $filler;
global $main;

if ((sizeof($_GET) == 1) && isset($_GET['person_id'])) {
    $filler = getCastmemberToHtml(getMoviesFromMoviecastmember());
    // $filler = searchedMoviesToHtml(getMovieBySearch());
} elseif (sizeof($_GET) > 0) {
    $filler = searchedMoviesToHtml(getMovieBySearch());
} else {
    $filler = searchedMoviesToHtml(getDefaultMovies());
}

// $main = createSlider(getDefaultMovies());    
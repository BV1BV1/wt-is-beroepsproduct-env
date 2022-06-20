<?php
global $filler;
global $main;

if ((sizeof($_GET) == 1) && isset($_GET['person_id'])) {
    $filler = getCastmemberToHtml(getMoviesFromMoviecastmember());
} elseif (sizeof($_GET) > 0) {
    // return getMovieBySearch();
    $filler = searchedMoviesToHtml(getMovieBySearch());
} else {
    $text = "";
    for ($i = 0; $i < 30; $i++) {
        $color = getColor();
        $size = getSize();
        $line = "<div class='{$color} {$size}'> {$i} </div>";
        $text .= $line;
    }
    $filler = $text;
}

// $main = '<div class="rood main ">TEST
// </div>';

$main = '
<div class="rood thumbnail-container main">
    
    <div class="thumb rood">
        <span id="tn-1"> &nbsp; </span>
        <img src="assets/HA_pic.jpg">
        <a class="movielink" href="movie.php?movie_id=100667">titel</a>
        <a class="next" href="#tn-2" aria-label="next">
        NEXT
        </a>
    </div>

    <div class="thumb rood">
        <span id="tn-2"> &nbsp; </span>
        <a class="prev" href="#tn-1" aria-label="prev">
        PREV
        </a>
        <img src="assets/HA_pic.jpg">
        <a href="movie.php?movie_id=100667">titel</a>
        <a class="next" href="#tn-3" aria-label="next">
        NEXT
        </a>
    </div>

    <div class="thumb rood">
        <span id="tn-3"> &nbsp; </span>
        <a class="prev" href="#tn-2" aria-label="prev">
        PREV
        </a>
        <img src="assets/HA_pic.jpg">
        <a href="movie.php?movie_id=100667">titel</a>
        <a class="next" href="#tn-4" aria-label="next">
        NEXT
        </a>
    </div>

    <div class="thumb rood">
        <span id="tn-4"> &nbsp; </span>
        <a class="prev" href="#tn-3" aria-label="prev">
        PREV
        </a>
        <img src="assets/HA_pic.jpg">
        <a href="movie.php?movie_id=100667">titel</a>
        <a class="next" href="#tn-5" aria-label="next">
        NEXT
        </a>
    </div>

</div>';
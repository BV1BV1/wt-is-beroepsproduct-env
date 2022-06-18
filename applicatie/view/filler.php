<?php 
    global $filler;
    
    if ( (sizeof($_GET) == 1) && isset($_GET['person_id']) ){
        $filler = getCastmemberToHtml(getMoviesFromMoviecastmember());
    }
    if (sizeof($_GET) > 0) {
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
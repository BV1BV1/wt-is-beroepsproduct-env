<?php 

function getMovieDetailsToHtml($movies)
{
    $html = "";
    foreach ($movies as $movie) {
        $color = getColor();
        $html .= "<div class='{$color} thumbnail mainDetail'>" . "<img src='assets/" . $movie['cover_image'] . "' alt='" . $movie['title']  . "'><div>" . $movie['title'] . "</div></div>";
        $html .= "<div class='blauw smallDetails'><p class='blauw'>duration:" . $movie['duration'] .
            "</p> <p class='blauw'>year: " . $movie['publication_year'] . "</p> <p class='blauw'>price: " . $movie['price'] .
            "</p></div> ";
        $html .= "<div class='geel description'><h2 class='geel'>Description:</h2><p class='geel'>" . $movie['description'] . "</p></div>";
    }
    return $html;
}

function getMovieCastToHtml($movies)
{
    $text = "";
    $html = "<div class='wit castDetails'><h1 class='wit'>Cast:</h1> <p class='wit'>";

    foreach ($movies as $movie) {
        $text .= $movie['actor'] . ", ";
    }
    $text = rtrim($text, ", ");
    $html .= $text . "</p>";
    $html .= "<h1 class='wit'>Director: </h1><p class='wit'>";
    $html .= $movies[0]['director'];

    $html .= "</p></div>";
    return $html;
}


?>
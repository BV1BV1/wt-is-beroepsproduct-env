<?php
require_once "./model/movies.php";
require_once "helperfunctions.php";

function searchedMoviesToHtml($movies)
{
    $html = "";
    // $results = numberOfSearchresults(getMovieBySearch());
    $results = count($movies);
    $color = getColor();

    //boodschap als er geen films voldoen aan de zoekcriteria
    if ($results == 0) {
        $html .= "<div class='{$color} thumbnail'> Sorry, we couldn't find a match.</div>";
    }

    //elke film wordt in een thumbnail gezet met wat "padding" van lege vakjes er om heen voor esthetische redenen
    if ($movies && count($movies) > 0) {
        foreach ($movies as $movie) {
            $cleanTitle = str_replace(['"', "'"], '', $movie['title']);
            $html .= createFiller();
            $color = getColor();
            // $html .= "<div class='{$color} thumbnail'>" . "<img src='assets/" . $movie['cover_image'] . "' alt='" . $movie['title']  . "'><div>" . $movie['title'] . "</div></div>";
            $html .= '<div class="{$color} thumbnail">' . '<img src="assets/' . $movie['cover_image'] . '" alt="' . $cleanTitle  . '"><div><a href="movie.php?movie_id=' . $movie['movie_id'] . '">"' .  $movie['title'] . '</a></div></div>';
        }
    }

    //we willen bij klein aantal zoekpagina geen lege pagina maar nog steeds een soort van schilderij tonen
    if ($results < 40) {
        $html .= createSpecificFiller(40 - $results);
    }
    return $html;
}

function getMovieDetailsToHtml($movies)
{
    $html = "";

    foreach ($movies as $movie) {
        $details = "<div class='blauw smallDetails'><p class='blauw'>duration:" . $movie['duration'] .
            "</p> <p class='blauw'>year: " . $movie['publication_year'] . "</p> <p class='blauw'>price: " . $movie['price'] .
            "</p></div> ";
        $html .= "<div class='geel description'><h2 class='geel'>Description:</h2><p class='geel'>" . $movie['description'] . "</p></div>";

        if (isset($_SESSION['loggedIn'])  && ($_SESSION['loggedIn'])) {
            $html .= '<video class="thumbnail mainDetail" controls src="assets/' . $movie['URL'] . '" alt="' . $movie['title'] . '" poster="assets/' . $movie['cover_image'] .
                '" preload="metadata"></video>                  
                ';
            $html .= $details;
        } else {
            $html .= "<div class='rood thumbnail mainDetail'>" . "<img src='assets/" . $movie['cover_image'] . "' alt='" . $movie['title']  . "'><div><a href='login.php'><h1 class='transparent'>log in to watch movie</h1></a></div></div>";
            $html .= $details;
        }
    }

    return $html;
}

function getCastmemberToHtml($movies)
{
    $html = "";
    $results = numberOfSearchresults(getMoviesFromMoviecastmember());
    $color = getColor();

    //boodschap als er geen films voldoen aan de zoekcriteria
    if ($results == 0) {
        $html .= "<div class='{$color} thumbnail'> Sorry, we couldn't find a match.</div>";
    }

    //elke film wordt in een thumbnail gezet met wat "padding" van lege vakjes er om heen voor esthetische redenen
    foreach ($movies as $movie) {
        $html .= createFiller();
        $color = getColor();
        // $html .= "<div class='{$color} thumbnail'>" . "<img src='assets/" . $movie['cover_image'] . "' alt='" . $movie['title']  . "'><div>" . $movie['title'] . "</div></div>";
        $html .= "<div class='{$color} thumbnail'>" . "<img src='assets/" . $movie['cover_image'] . "' alt='" . $movie['title']  . "'><div><a href='movie.php?movie_id=" . $movie['movie_id'] . "'>" .  $movie['title'] . "</a></div></div>";
    }

    // we willen bij klein aantal zoekpagina geen lege pagina maar nog steeds een soort van schilderij tonen
    if ($results < 40) {
        $html .= createSpecificFiller(40 - $results);
    }
    return $html;
}


function getMovieCastToHtml($movies)
{
    $html = '';
    if (count($movies) > 0) {
        $text = "";
        $html = "<div class='wit castDetails'><h1 class='wit'>Cast:</h1> <p class='wit'>";

        foreach ($movies as $movie) {

            $text .= "<a class='wit' href='index.php?person_id=" . $movie['person_id']
                . "'>" . $movie['actor'] . "</a> ";
        }

        $text = rtrim($text, ", ");
        $html .= $text . "</p>";
        $html .= "<h1 class='wit'>Director: </h1><p class='wit'>";


        $html .= "<a class='wit' href='index.php?person_id=" . $movie['person_id']
            . "'>" . $movie['director'] . "</a> ";

        $html .= "</p></div>";
    } else {
        $html = "<div class='wit castDetails'><h1 class='wit'>Geen castdetails beschikbaar</h1></div>";
    }
    return $html;
}



function getGenretabHtml($genres)
{
    $html = "";
    foreach ($genres as $genre) {
        $line = "<a class='links' href='index.php?genre=$genre'>$genre</a><br>";
        $html .= $line;
    }
    return $html;
}

// $genreLinks = getGenretabHtml(getPopularGenres());

///eind genre-index

function createWishlistButton()
{
    $html = '';
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
        if (!checkMovieOnWishlist()) {
            $html = ' <form class="red wishlistForm" action="addMovieToWishlist.php" method="post">
                            <input type="hidden" name="movie_id" value="' . $_GET['movie_id'] . '">
                            <input class="rood submitbutton" type="submit" value="add to wishlist">
                        </form>';
        } else {
            $html = ' <form class="red wishlistForm" action="removeMovieFromWishlist.php" method="post">
                            <input type="hidden" name="movie_id" value="' . $_GET['movie_id'] . '">
                            <input class="rood submitbutton" type="submit" value="remove from wishlist">
                        </form>';
        }
    }

    return $html;
}

function createSlider($movies)
{
    $nMovies = count($movies);

    $count = 1;
    $html = '<div class="rood thumbnail-container main">';
    foreach ($movies as $movie) {
        $cleanTitle = str_replace(['"', "'"], '', $movie['title']);
        if ($count == 1) {
            if ($nMovies > 1) {
                $html .= '  <div class="thumb rood">
                                <span id="tn-' . $count  . '"> &nbsp; </span>
                                <img src="assets/' . $movie['cover_image'] . '" alt="' . $cleanTitle  . '">
                                <a class="movielink" href="movie.php?movie_id=' . $movie['movie_id']  . '">' . $movie['title']  . '</a>
                                <a class="next" href="#tn-' . ($count + 1) . '" aria-label="next">
                                NEXT
                                </a>
                            </div>';
            } else {
                $html .= '  <div class="thumb rood">
                                <span id="tn-' . $count  . '"> &nbsp; </span>
                                <img src="assets/' . $movie['cover_image'] . '" alt="' . $cleanTitle  . '">
                                <a class="movielink" href="movie.php?movie_id=' . $movie['movie_id']  . '">' . $movie['title']  . '</a>
                            </div>';
            }
        } elseif ($count == $nMovies) {
            $html .= '  <div class="thumb rood">
                            <a class="prev" href="#tn-' . ($count - 1) . '" aria-label="previous">
                            PREV
                            </a>
                            <span id="tn-' . $count  . '"> &nbsp; </span>
                            <img src="assets/' . $movie['cover_image'] . '" alt="' . $cleanTitle . '">
                            <a class="movielink" href="movie.php?movie_id=' . $movie['movie_id']  . '">' . $movie['title']  . '</a>
                        </div>';
        } else {
            $html .= '  <div class="thumb rood">
                            <a class="prev" href="#tn-' . ($count - 1) . '" aria-label="previous">
                            PREV
                            </a>
                            <span id="tn-' . $count  . '"> &nbsp; </span>
                            <img src="assets/' . $movie['cover_image'] . '" alt="' . $cleanTitle  . '">
                            <a class="movielink" href="movie.php?movie_id=' . $movie['movie_id']  . '">' . $movie['title']  . '</a>
                            <a class="next" href="#tn-' . ($count + 1) . '" aria-label="next">
                            NEXT
                            </a>
                        </div>';
        }
        $count++;
    }
    $html .= '</div>';
    return $html;
}
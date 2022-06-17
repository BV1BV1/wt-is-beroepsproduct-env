<?php
require_once 'db_connectie.php';
require_once 'helperfunctions.php';

function getMovieDetails()
{
    $db = maakVerbinding();
    $sql = "select m.movie_id, m.title, m.cover_image, m.duration, m.publication_year, m.price, m.description from movie m
            where m.movie_id = (:movie_id)";
    $movie_id = $_GET['movie_id'];
    $query = $db->prepare($sql);
    $query->execute(['movie_id' => $movie_id]);
    return $query->fetchAll();
}

// test movie_id 332548

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

function getMovieCast()
{
    $db = maakVerbinding();
    $sql = "select CONCAT(pc.firstname, ' ', pc.lastname) as actor, pc.person_id, CONCAT(pd.firstname, ' ', pd.lastname) as director, pd.person_id from movie m 
    join movie_Cast mc on m.movie_id = mc.movie_id 
    join movie_director md on m.movie_id = md.movie_id 
    join person pc on mc.person_id = pc.person_id 
    join person pd on md.person_id = pd.person_id 
    where m.movie_id = (:movie_id)";
    $movie_id = $_GET['movie_id'];
    $query = $db->prepare($sql);
    $query->execute(['movie_id' => $movie_id]);
    return $query->fetchAll();
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
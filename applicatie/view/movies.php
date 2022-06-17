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


//hieronder ophalen data en creeeren HTML niet goed gescheiden
//op pagina index moet ik een variabele gebruiken omdat een functie in een heredoc niet goed werkt
//als ik de onderstaande functies echter verdeel over view en model dan kan ik niet zomaar de variabele
//getPopularGenres() in mijn html-functie gebruiken zonder dat ik de model-pagina zou includen in de view-pagina
//en dat leek me minder efficient

function getPopularGenres()
{
    $db = maakVerbinding();
    $sql =    "SELECT TOP 8 G.genre_name as Genre, count(mg.movie_id) as Aantal
                FROM Genre G left outer join Movie_Genre MG 
                    on G.genre_name = MG.genre_name
                group by G.genre_name
                ORDER by count(mg.movie_id) DESC";

    $data = $db->query($sql);

    $genres = [];

    while ($rij = $data->fetch()) {
        $genre = $rij['Genre'];
        $genres[] = $genre;
    }

    return $genres;
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

$genreLinks = getGenretabHtml(getPopularGenres());

///eind genre-index
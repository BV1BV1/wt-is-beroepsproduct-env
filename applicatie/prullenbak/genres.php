<?php
require_once 'db_connectie.php';





$db = maakVerbinding();

$query =    "SELECT TOP 8 G.genre_name as Genre, count(mg.movie_id) as Aantal
            FROM Genre G left outer join Movie_Genre MG 
                on G.genre_name = MG.genre_name
            group by G.genre_name
            ORDER by count(mg.movie_id) DESC";

$data = $db->query($query);

$genres = [];

while ($rij = $data->fetch()) {
    $genre = $rij['Genre'];
    $genres[] = $genre;
}

$genreTekst = "";

foreach ($genres as $genre) {
    $line = "<a class='links' href='index.php?genre=$genre'>$genre</a><br>";
    $genreTekst .= $line;
}
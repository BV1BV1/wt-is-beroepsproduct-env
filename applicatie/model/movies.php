<?php
require_once 'db_connectie.php';
require_once 'helperfunctions.php';


function getMovieDetails($movie_id)
{
    $db = maakVerbinding();
    $sql = "select m.movie_id, m.title, m.cover_image, m.duration, m.publication_year, m.price, m.description from movie m
                where m.movie_id = (:movie_id)";
    $query = $db->prepare($sql);
    $query->execute(['movie_id' => $movie_id]);
    return  $query->fetchAll();
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

function getMoviesFromMoviecast()
{
    $db = maakVerbinding();
    $personArray = [];
    $movie_id = $_GET['movie_id'];

    $sql = "select person_id
            from movie_cast
            where movie_cast.movie_id = (:movie_id)";
    $query = $db->prepare($sql);
    $query->execute(['movie_id' => $movie_id]);
    $personArray = $query->fetchAll();

    $sql = "select person_id
            from movie_director
            where movie_director.movie_id = (:movie_id)";
    $query = $db->prepare($sql);
    $query->execute(['movie_id' => $movie_id]);
    $personArray += $query->fetchAll();

    $sql = "select m.movie_id, m.title, m.cover_image from movie m
            join movie_Cast mc on m.movie_id = mc.movie_id 
            join movie_director md on m.movie_id = md.movie_id 
            join person pc on mc.person_id = pc.person_id 
            join person pd on md.person_id = pd.person_id
            where (";

    $counter = 0;

    foreach ($personArray as $person) {
        $person_id = $person['person_id'];
        if ($counter > 0) {
            $sql .= " OR ";
        }
        $sql .= "(pc.person_id=" . $person_id . " OR pd.person_id=" . $person_id . ")";
        $counter++;
    }
    $sql .= ") AND NOT (m.movie_id=" . $movie_id  . ") group by m.movie_id, m.title, m.cover_image";

    $query = $db->query($sql);
    return $query->fetchAll();
}

// function getMoviesFromMoviecastmember()
// {
//     $db = maakVerbinding();
//     $person_id = $_GET['person_id'];

//     $sql = "select m.movie_id, m.title, m.cover_image from movie m
//             join movie_Cast mc on m.movie_id = mc.movie_id 
//             join movie_director md on m.movie_id = md.movie_id 
//             join person pc on mc.person_id = pc.person_id 
//             join person pd on md.person_id = pd.person_id
//             where (pc.person_id=" . $person_id . " OR pd.person_id=" . $person_id . ")
//             group by m.movie_id, m.title, m.cover_image";

//     $query = $db->query($sql);
//     return $query->fetchAll();
// }
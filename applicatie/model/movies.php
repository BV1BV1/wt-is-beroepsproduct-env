<?php
require_once 'db_connectie.php';
require_once 'helperfunctions.php';


function getDefaultMovies()
{
    $db = maakVerbinding();
    $sql = "select m.movie_id, m.title, m.cover_image, m.duration, m.publication_year, m.price, m.description, URL from movie m
    where m.movie_id%8 = 0";
    $query = $db->query($sql);
    return $query->fetchAll();
}

$params = [];

function getMovieBySearch()
{
    global $params;
    $db = maakVerbinding();
    $params = [];

    $genre = "";
    if (isset($_GET['genre']) && (strlen(trim($_GET['genre'])) > 0)) {
        // if (isset($_GET['genre'])) {
        $genre = $_GET['genre'];
        $params += ['genre' => $genre];
    };
    $year = "";
    if (isset($_GET['year']) && (strlen(trim($_GET['year'])) > 0)) {
        $year = $_GET['year'];
        $params += ['year' => $year];
    };
    $title = "";
    if (isset($_GET['title']) && (strlen(trim($_GET['title'])) > 0)) {
        $title = $_GET['title'];
        $params += ['title' => $title];
    };
    $name = "";
    $name2 = "";
    if (isset($_GET['name']) && (strlen(trim($_GET['name'])) > 0)) {
        $name = $_GET['name'];
        $name2 = $_GET['name'];
        $params += ['name' => $name];
        $params += ['name2' => $name2];
    };

    $counter = 0; //bij de eerste toevoeging moet geen "AND" staan in de query , maar bij elke volgende wel

    //onze select statement is altijd hetzelfde, maar de where statement wordt opgebouwd nav de opgegeven zoekwaardes
    $whereClause = " where (";
    if (isset($_GET['genre']) && (strlen(trim($_GET['genre'])) > 0)) {
        $whereClause .= " (mg.genre_name = (:genre)) ";
        $counter++;
    }
    if (isset($_GET['year']) && (strlen(trim($_GET['year'])) > 0)) {
        if ($counter > 0) {
            $whereClause .= "AND ";
        }
        $whereClause .= " (m.publication_year = (:year)) ";
        $counter++;
    }
    if (isset($_GET['title']) && (strlen(trim($_GET['title'])) > 0)) {
        if ($counter > 0) {
            $whereClause .= "AND ";
        }
        $whereClause .= " m.title like concat ('%', (:title), '%') ";
        $counter++;
    }
    if (isset($_GET['name']) && (strlen(trim($_GET['name'])) > 0)) {
        if ($counter > 0) {
            $whereClause .= "AND ";
        }
        $whereClause .= " (pc.lastname like concat ('%', (:name), '%') OR pd.lastname like concat ('%', (:name2), '%') )";
    }
    $whereClause .= ")
                    GROUP BY m.movie_id, m.title, m.cover_image";

    $sql = "select m.movie_id, m.title, m.cover_image from movie m
            join movie_genre mg on m.movie_id = mg.movie_id
            join movie_Cast mc on m.movie_id = mc.movie_id
            join movie_director md on m.movie_id = md.movie_id
            join person pc on mc.person_id = pc.person_id
            join person pd on md.person_id = pd.person_id";

    if (count($params) > 0) {
        $sql .= $whereClause;
    }

    if (count($params) > 0) {
        $query = $db->prepare($sql);
        $query->execute($params);
    } else {
        $query = $db->query($sql);
    }

    return $query->fetchAll();
}

function getMoviesFromMoviecastmember($id)
{
    $db = maakVerbinding();
    // $person_id = $_GET['person_id'];
    $person_id = $id;

    $sql = "select m.movie_id, m.title, m.cover_image from movie m
            join movie_Cast mc on m.movie_id = mc.movie_id 
            join movie_director md on m.movie_id = md.movie_id 
            join person pc on mc.person_id = pc.person_id 
            join person pd on md.person_id = pd.person_id
            where (pc.person_id=" . $person_id . " OR pd.person_id=" . $person_id . ")
            group by m.movie_id, m.title, m.cover_image";

    $query = $db->query($sql);
    return $query->fetchAll();
}

function getMovieDetails($movie_id)
{
    $db = maakVerbinding();
    $sql = "select m.movie_id, m.title, m.cover_image, m.duration, m.publication_year, m.price, m.description, URL from movie m
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

    if (count($personArray) > 0) {
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
}

// function getDataForSlider()
// {
// }

function addMovieToWatchlist()
{
    $movie_id = $_POST['movie_id'];
    $email = $_SESSION['email'];
    // $date = getdate();

    $sql = "insert into Watchhistory(movie_id, customer_mail_address, watch_date, price, invoiced)
    values (" . $movie_id . ", (:email), getdate() , 1, 0)
    ";
    $db = maakVerbinding();
    $query = $db->prepare($sql);
    $query->execute([':email' => $email]);
}

function removeMovieFromWatchlist()
{
    $movie_id = $_POST['movie_id'];
    $email = $_SESSION['email'];

    $sql = "delete from watchhistory
            where movie_id =" . $movie_id . " AND customer_mail_address = (:email)
            ";
    $db = maakVerbinding();
    $query = $db->prepare($sql);
    $query->execute(['email' => $email]);
}

function checkMovieOnWishlist()
{
    $movie_id = $_GET['movie_id'];
    $email = $_SESSION['email'];
    $results = [];

    $sql = "select * from watchhistory
            where movie_id =" . $movie_id . " AND customer_mail_address = (:email)
            ";
    $db = maakVerbinding();
    $query = $db->prepare($sql);
    $query->execute(['email' => $email]);
    $results = $query->fetchAll();

    if (count($results) == 0) {
        return false;
    } else {
        return true;
    }
}


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

function getWishlist()
{
    $db = maakVerbinding();
    $email = $_SESSION['email'];
    $sql = 'select m.movie_id, m.title, m.cover_image from movie m
            join Watchhistory w on m.movie_id = w.movie_id
            where customer_mail_address = (:email)';
    $db = maakVerbinding();
    $query = $db->prepare($sql);
    $query->execute(['email' => $email]);
    $results = $query->fetchAll();

    return $results;
}
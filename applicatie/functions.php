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

// function getMovie($id)
// {
//     $db = maakVerbinding();
//     $sql = "select * from movie
//             where movie_id = (:movie_id)";
//     $query = $db->prepare($sql);
//     $query->execute(['movie_id' => $id]);
//     $content = "";

//     while ($rij = $query->fetch()) {
//         $content .= "<div class='wit thumbnail'>" . "<img src='assets/" . $rij['cover_image']  . "' alt='." . $rij['title'] . "'><div>" . $rij['title'] . "</div></div>";
//     }

//     return $content;
// }


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



function searchedMoviesToHtml($movies)
{
    $html = "";
    $results = numberOfSearchresults(getMovieBySearch());
    $color = getColor();

    //boodschap als er geen films voldoen aan de zoekcriteria
    if ($results == 0) {
        $html .= "<div class='{$color} thumbnail'> Sorry, we couldn't find a match.</div>";
    }

    //elke film wordt in een thumbnail gezet met wat "padding" van lege vakjes er om heen voor esthetische redenen
    if ($movies && count($movies) > 0) {
        foreach ($movies as $movie) {
            $html .= createFiller();
            $color = getColor();
            // $html .= "<div class='{$color} thumbnail'>" . "<img src='assets/" . $movie['cover_image'] . "' alt='" . $movie['title']  . "'><div>" . $movie['title'] . "</div></div>";
            $html .= "<div class='{$color} thumbnail'>" . "<img src='assets/" . $movie['cover_image'] . "' alt='" . $movie['title']  . "'><div><a href='movie.php?movie_id=" . $movie['movie_id'] . "'>" .  $movie['title'] . "</a></div></div>";
        }
    }

    //we willen bij klein aantal zoekpagina geen lege pagina maar nog steeds een soort van schilderij tonen
    if ($results < 40) {
        $html .= createSpecificFiller(40 - $results);
    }
    return $html;
}

function getMoviesFromMoviecastmember()
{
    $db = maakVerbinding();
    $person_id = $_GET['person_id'];

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

function generateCustomerHtml()
{
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
        // $greeting = generateGreeting() . ' ' .  htmlspecialchars($_SESSION['username']);
        $html = '<div class="wit customerhtml">
                    <div class="wit">' .  generateGreeting() . '<br><small class="wit highlightRed">' . htmlspecialchars($_SESSION['username'])  . '</small>'  . '</div>
                    <div class="wit">
                        <a href="logout.php" class="wit side"><small class="wit">sign out</small></a>
                    </div>
                </div>
        ';
        return $html;
    } else {
        $html = '<div class="wit customerhtml">
                    <a href="login.php" class="wit"><h1 class="wit">sign in</h1></a>
                    <div class="wit">
                        <a href="register.php" class="wit side"><small class="wit">or register an account</small></a>
                    </div>
                </div>';
    }

    return $html;
}
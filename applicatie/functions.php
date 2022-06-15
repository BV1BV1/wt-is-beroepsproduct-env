<?php
require_once 'db_connectie.php';
require_once 'helperfunctions.php';

function getContent()
{
    if (sizeof($_GET) > 0) {
        // return getMovieBySearch();
        return searchedMoviesToHtml(getMovieBySearch());
    } else {
        $text = "";
        for ($i = 0; $i < 30; $i++) {
            $color = getColor();
            $size = getSize();
            $line = "<div class='{$color} {$size}'> {$i} </div>";
            $text .= $line;
        }
        return $text;
    }
}



function getMovie($id)
{
    $db = maakVerbinding();
    $sql = "select * from movie
            where movie_id = (:movie_id)";
    $query = $db->prepare($sql);
    $query->execute(['movie_id' => $id]);
    $content = "";

    while ($rij = $query->fetch()) {
        $content .= "<div class='wit thumbnail'>" . "<img src='assets/" . $rij['cover_image']  . "' alt='." . $rij['title'] . "'><div>" . $rij['title'] . "</div></div>";
    }

    return $content;
}


$params = [];

function getMovieBySearch()
{
    global $params;
    $db = maakVerbinding();

    $genre = "";
    if (isset($_GET['genre'])) {
        $genre = $_GET['genre'];
        $params = ['genre' => $genre];
    };
    $year = "";
    if (isset($_GET['year'])) {
        $year = $_GET['year'];
        $params += ['year' => $year];
    };
    $title = "";
    if (isset($_GET['title'])) {
        $title = $_GET['title'];
        $params += ['title' => $title];
    };
    $name = "";
    $name2 = "";
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
        $name2 = $_GET['name'];
        $params += ['name' => $name];
        $params += ['name2' => $name2];
    };

    $counter = 0; //bij de eerste toevoeging moet geen "AND" staan in de query , maar bij elke volgende wel

    //onze select statement is altijd hetzelfde, maar de where statement wordt opgebouwd nav de opgegeven zoekwaardes
    $whereClause = " where (";
    if (isset($_GET['genre'])) {
        $whereClause .= " (mg.genre_name = (:genre)) ";
        $counter++;
    }
    if (isset($_GET['year'])) {
        if ($counter > 0) {
            $whereClause .= "AND ";
        }
        $whereClause .= " (m.publication_year = (:year)) ";
        $counter++;
    }
    if (isset($_GET['title'])) {
        if ($counter > 0) {
            $whereClause .= "AND ";
        }
        $whereClause .= " m.title like concat ('%', (:title), '%') ";
        $counter++;
    }
    if (isset($_GET['name'])) {
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
    $sql .= $whereClause;

    $query = $db->prepare($sql);
    $query->execute($params);

    return $query->fetchAll();
}



function searchedMoviesToHtml($movies)
{
    $sql = "";
    $results = numberOfSearchresults(getMovieBySearch());
    $color = getColor();

    //boodschap als er geen films voldoen aan de zoekcriteria
    if ($results == 0) {
        $sql .= "<div class='{$color} thumbnail'> Sorry, we couldn't find a match.</div>";
    }

    //elke film wordt in een thumbnail gezet met wat "padding" van lege vakjes er om heen voor esthetische redenen
    foreach ($movies as $movie) {
        $sql .= createFiller();
        $color = getColor();
        $sql .= "<div class='{$color} thumbnail'>" . "<img src='assets/" . $movie['cover_image'] . "' alt='" . $movie['title']  . "'><div>" . $movie['title'] . "</div></div>";
    }

    //we willen bij klein aantal zoekpagina geen lege pagina maar nog steeds een soort van schilderij tonen
    if ($results < 40) {
        $sql .= createSpecificFiller(40 - $results);
    }
    return $sql;
}
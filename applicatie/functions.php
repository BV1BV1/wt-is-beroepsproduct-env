<?php
require_once 'db_connectie.php';

function getContent()
{
    if (count($_GET) == 2) {
    } elseif ((count($_GET) == 1) && (isset($_GET['movie_id']))) {
        return getMovie($_GET['movie_id']);
    } elseif ((count($_GET) == 1) && (isset($_GET['genre']))) {
        return getMovieByGenre($_GET['genre']);
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

function getColor()
{
    $randNumber = rand(1, 10);
    if ($randNumber < 6) {
        return "wit";
    } elseif ($randNumber < 8) {
        return "blauw";
    } elseif ($randNumber < 9) {
        return "rood";
    } else {
        return "geel";
    }
}

function getSize()
{
    $randNumber = rand(0, 10);
    if ($randNumber < 2) {
        return "spanC2";
    } elseif ($randNumber < 4) {
        return "spanR2";
    } else {
        return "";
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

function getMovieByGenre($id)
{
    $db = maakVerbinding();
    $sql = "select * from movie m
            join movie_genre mg on m.movie_id=mg.movie_id
            where genre_name = (:genre)";
    $query = $db->prepare($sql);
    $query->execute(['genre' => $id]);
    $content = "";

    while ($rij = $query->fetch()) {
        $color = getColor();
        $size = getSize();
        $line = "<div class='{$color} thumbnail'>" . "<img src='assets/" . $rij['cover_image'] . "' alt='" . $rij['title']  . "'><div>" . $rij['title'] . "</div></div>";
        $content .= $line;
    }

    return $content;
}
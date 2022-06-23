<?php
require_once 'db_connectie.php';
require_once 'helperfunctions.php';

function getYearOptions()
{
    $db = maakVerbinding();
    $sql = "select publication_year
            from movie
            group by publication_year";
    $data = $db->query($sql);

    return $data->fetchAll();
}

function getGenreOptions()
{
    $db = maakVerbinding();
    $sql = "select mg.genre_name
            from movie m
            join movie_genre mg on m.movie_id = mg.movie_id
            group by mg.genre_name";
    $data = $db->query($sql);
    return $data->fetchAll();
}
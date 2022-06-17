<?php
require_once 'db_connectie.php';
require_once 'helperfunctions.php';

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

function genreToHtml($genres)
{
    $html = "";
    $html .= '
    <div class="genreOptions geel">
        <label class="geel genreOptions" for="genre">select genre</label>
        <select class="geel" id="genre" name="genre">
        <option class="geel" value="any" deafult>any</option> 
    ';

    foreach ($genres as $genreOption) {
        $genre = $genreOption['genre_name'];
        $html .= '
        <option class="geel" value="' . $genre . '">' . $genre . '</option>
        ';
    }
    $html .= '
    </select></div>
    ';

    return $html;
}

function getYearOptions()
{
    $db = maakVerbinding();
    $sql = "select publication_year
            from movie
            group by publication_year";
    $data = $db->query($sql);

    return $data->fetchAll();
}

function getYearToHtml($years)
{
    $html = '
    <div class="yearoptions blauw">
        <label class="blauw yearoptions" for="year">select year</label>
        <select class="blauw" id="year" name="year">
        <option class="blauw" value="any" deafult>any</option> 
    ';

    foreach ($years as $yearOption) {
        $year = $yearOption['publication_year'];
        $html .= '
        <option class="blauw" value="' . $year . '">' . $year . '</option>
        ';
    }
    $html .= '
    </select></div>
    ';

    return $html;
}
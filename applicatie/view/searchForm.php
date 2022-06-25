<?php
require_once 'db_connectie.php';
require_once 'helperfunctions.php';
require_once './model/searchForm.php';


function genreToHtml($genres)
{
    $html = "";
    $html .= '
    <div class="genreOptions geel">
        <label class="geel genreOptions" for="genre">select genre</label>
        <select class="geel" id="genre" name="genre">
        <option class="geel" value="" disabled selected>any</option> 
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


function getYearToHtml($years)
{
    $html = '
    <div class="yearoptions blauw">
        <label class="blauw yearoptions" for="year">select year</label>
        <select class="blauw" id="year" name="year">
        <option class="blauw" value="" disabled selected>any</option> 
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

function getStaticSearchformHtml()
{
    $html = '
            <div class="title wit">
                <label class="wit" for="movietitle">Title</label>
                <input class="wit" type="text" id="movietitle" name="title">
                <p class="explanation wit">will return any movie that partially matches searchterm</p>
            </div>
            <input class="rood submitbutton" type="submit" value="Search">
            <div class="cast geel">
                <label class="geel" for="name">cast and crew</label>
                <input class="geel" type="text" id="name" name="name" placeholder="last name">
                <p class="explanation geel">will return any partial last name match for castmember or director</p>
            </div>
    ';
    return $html;
}
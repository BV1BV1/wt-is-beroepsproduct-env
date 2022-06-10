<?php
require_once 'db_connectie.php';

function getContent()
{
    if (count($_GET) == 0) {
    } elseif ((count($_GET) == 1) && (isset($_GET['movie_id']))) {
    } elseif ((count($_GET) == 1) && (isset($_GET['movie_id']))) {
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
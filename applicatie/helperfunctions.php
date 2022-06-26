<?php

//deze functie gebruiken we om de klasse wit, blauw, rood of geel aan een kleurvlak toe te voegen
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

//deze functie gebruiken we om de grootte van een bepaald kleurvlak te bepalen
function getSize()
{
    $randNumber = rand(0, 100);
    if ($randNumber < 10) {
        return "spanC2";
    } elseif ($randNumber < 20) {
        return "spanR2";
    } elseif ($randNumber < 26) {
        return "spanC2R2";
    } elseif ($randNumber < 32) {
        return "spanR3";
    } elseif ($randNumber < 36) {
        return "spanC3";
    } elseif ($randNumber < 40) {
        return "spanC2R3";
    } else {
        return "";
    }
}

//deze functie creert een random aantal kleurvlakken zodat vlakken met een cover image afgewisseld worden door lege kleurvlakken
function createFiller()
{
    $fillerText = "";
    $randomNumber = rand(0, 3);
    for ($i = 0; $i < ($randomNumber); $i++) {
        $color = getColor();
        $size = getSize();
        $line = "<div class='{$color} {$size}'></div>";
        $fillerText .= $line;
    }
    return $fillerText;
}

//deze functie wordt gebruikt om een specifiek aantal kleurvlakken toe te voegen als paginavulling
function createSpecificFiller($ammount)
{
    $fillerText = "";
    for ($i = 0; $i < $ammount; $i++) {
        $color = getColor();
        $size = getSize();
        $line = "<div class='{$color} {$size}'></div>";
        $fillerText .= $line;
    }
    return $fillerText;
}

function numberOfSearchresults($searchresults)
{
    $numberOfResults = "no search done";
    if (count($_GET) > 0) {
        $numberOfResults = (int)count($searchresults);
    }
    return $numberOfResults;
}

function generateGreeting()
{
    $hour = date('H');
    if ($hour < 12) {
        return 'good morning';
    } elseif ($hour < 18) {
        return 'good afternoon';
    } else {
        return 'good evening';
    }
}
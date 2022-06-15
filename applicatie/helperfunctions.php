<?php

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
    $numberOfResults = (int)count($searchresults);
    return $numberOfResults;
}
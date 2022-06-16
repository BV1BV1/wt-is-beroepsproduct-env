<?php

function generateHead()
{

    $html = '
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>NETFLIX</title>
</head>
    ';
    return $html;
}

function generateTop()
{
    $html =  '
    <header>
    <div class="logowrapper wit">
    <div class="wit logo" id="top"><a href="index.php"><img class="wit" alt="logo" src="assets/logo.svg"></a></div>
    </div>
    <div class="wit searchbar">' . numberOfSearchresults(getMovieBySearch()) . '</div>
</header>
<aside class="wit">
    <span class="wit">loginicoon en naam</span>
</aside>
';
    return $html;
}

function generateFooter()
{
    $html = '
    <footer>
        <div class="wit back">
        <a class="wit logo" href="#top"><img class="wit" alt="logo" src="assets/logo.svg"></a>
        <a class="wit logo" href="#top">back to top</a>
        </div>
        <adress class="wit">
        Website made by <a href = "mailto: bobvogel@hotmail.com"> Bob Vogel</a>. <br>
        Corporate office at: <br>
        Fletnix Enterprises <br>
        Ruitenberglaan 31 <br>
        6826 CC Arnhem <br>
        </adress>
        <div class="generallinks wit"> useful links
        <ul class="wit">
        <li class="wit"><a href="underconstruction.php">frequently asked questions</a></li>
        <li class="wit"><a href="underconstruction.php">terms and conditions</a></li>
        <li class="wit"><a href="underconstruction.php">business opportunities</a></li>
        <li class="wit"><a href="underconstruction.php">privacy</a></li>
        <li class="wit"><a href="underconstruction.php">cookie preferences</a></li>
        <li class="wit"><a href="underconstruction.php">netflix exclusives</a></li>
        <li class="wit"><a href="underconstruction.php">gift certificates</a></li>
        <li class="wit"><a href="underconstruction.php">job openings</a></li>
        </ul>
        </div>
    </footer>
    ';

    return $html;
}
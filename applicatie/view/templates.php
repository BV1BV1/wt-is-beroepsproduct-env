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
    <div class="wit searchbar"> 
        <form class="wit quickSearch" action="index.php" method="get">
            <label class="wit" for="title">quick title search</label>
            <input class="wit" type="text" id="title" name="title">
        </form>
        <a class="wit" href="search.php">advanced search</a> 
    </div>
</header>' . generateCustomerHtml();

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
        <div class="wit">
        Website made by <a href = "mailto:bobvogel@hotmail.com"> Bob Vogel</a>. <br>
        Corporate office at: <br>
        Fletnix Enterprises <br>
        Ruitenberglaan 31 <br>
        6826 CC Arnhem <br>
        </div>
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

function generateGenretab()
{
    $html = '
            <div class="genreselectie">
                <div class="geel genretab">
                    <h1 class="geel">genres</h1> <br>
                    <div class="genrelijst geel"> ' . getGenretabHtml(getPopularGenres())   .  ' </div>
                </div>
            <div class="ondergenretab">
            <div class="wit genrewit"></div>
                <div class="wit genrewit"></div>
                </div>
            </div>
            ';
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
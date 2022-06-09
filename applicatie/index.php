<?php
require_once "genres.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>Index</title>
</head>

<body>
    <header>
        <div class="wit logo">logo</div>
        <div class="wit searchbar">searchbar</div>
        <div class="filler9 blauw">thumbnail</div>
        <div class="filler5 wit"></div>
    </header>
    <aside class="wit">
        <span class="wit">loginicoon en naam</span>
    </aside>
    <div class="filler wit">thumbnail</div>
    <div class="filler2 wit">thumbnail</div>
    <div class="filler3 wit"></div>
    <div class="filler4 rood">thumbnail</div>
    <div class="filler5 wit"></div>
    <div class="filler6 geel">thumbnail</div>
    <div class="filler7 geel"></div>
    <div class="filler8 wit">thumbnail</div>
    <div class="filler9 blauw">thumbnail</div>
    <div class="filler10 wit"></div>
    <div class="rood main">
        <p> <?php var_dump($genres) ?> </p>
        <p> <?php echo ($genreTekst) ?> </p>
    </div>
    <div class="genreselectie">
        <div class="geel genretab"> genres <br> <br> <br>
            <div class="genrelijst geel"><?php echo ($genreText) ?></div>
        </div>
        <div class="ondergenretab">
            <div class="wit genrewit"></div>
            <div class="wit genrewit"></div>
        </div>
    </div>


</body>

</html>
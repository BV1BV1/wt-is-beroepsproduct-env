<?php
require_once "genres.php";
require_once "functions.php";
require_once "templates.php"
?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>Index</title>
</head> -->

<?= generateHead() ?>

<body>
    <?= generateTop() ?>
    <?= getContent() ?>

    <div class="rood main">
        <!-- <p> <?php var_dump($genres) ?> </p>
        <p> <?php echo $genreTekst ?> </p> -->
    </div>
    <div class="genreselectie">
        <div class="geel genretab">
            <h1 class="geel">genres</h1> <br>
            <div class="genrelijst geel"><?php echo $genreTekst ?></div>
        </div>
        <div class="ondergenretab">
            <div class="wit genrewit"></div>
            <div class="wit genrewit"></div>
        </div>
    </div>

    <?= generateFooter() ?>
</body>

</html>
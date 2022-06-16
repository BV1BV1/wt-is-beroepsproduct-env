<?php
require_once "functions.php";
require_once "templates.php";
require_once "genres.php";
require_once "movieDetailFunctions.php"
?>

<?= generateHead() ?>

<body>
    <?= generateTop() ?>

    <?= getMovieDetailsToHtml(getMovieDetails()) ?>

    <?= generateFooter() ?>
    <?= getMovieCastToHtml(getMovieCast()) ?>
</body>

</html>
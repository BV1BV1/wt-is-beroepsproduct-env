<?php
require_once "functions.php";
require_once "templates.php";
require_once "view/filler.php";
require_once "view/movies.php";
include_once "session.php";

?>

<?php
$htmlContent = <<<HTML
<div class="genreselectie">
    <div class="geel genretab">
        <h1 class="geel">genres</h1> <br>
        <div class="genrelijst geel"> $genreLinks </div>
</div>
<div class="ondergenretab">
    <div class="wit genrewit"></div>
    <div class="wit genrewit"></div>
</div>
</div>
HTML;
?>


<?php include_once "base.php" ?>
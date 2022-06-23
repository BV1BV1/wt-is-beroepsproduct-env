<?php
require_once "functions.php";
require_once "view/templates.php";
require_once "view/searchdata.php";
include_once "session.php";
?>



<?php
$htmlContent = createSpecificFiller(40) . '
    <form class="searchForm" action="index.php" method="get">
        <div class="title wit">
            <label class="wit" for="text">Title</label>
            <input class="wit" type="text" id="title" name="title">
            <p class="explanation wit">will return any movie that partially matches searchterm</p>
        </div>
        <input class="rood submitbutton" type="submit" value="Search">
        <div class="cast geel">
            <label class="geel" for="text">cast and crew</label>
            <input class="geel" type="text" id="name" name="name" placeholder="last name">
            <p class="explanation geel">will return any partial last name match for castmember or director</p>
        </div>' .
    getYearToHtml(getYearOptions()) .
    genreToHtml(getGenreOptions()) .
    '</form>
'
?>

<?php include_once "base.php" ?>
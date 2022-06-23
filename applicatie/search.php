<?php
// require_once "functions.php";
require_once "view/templates.php";
require_once "view/searchForm.php";
include_once "session.php";
?>



<?php
$htmlContent = createSpecificFiller(40) . '
    <form class="searchForm" action="index.php" method="get">' .
    getStaticSearchformHtml() .
    getYearToHtml(getYearOptions()) .
    genreToHtml(getGenreOptions()) .
    '</form>';
?>

<?php include_once "base.php" ?>
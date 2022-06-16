<?php
require_once "functions.php";
require_once "templates.php";
require_once "genres.php";
?>

<?= generateHead() ?>

<body>

    <?= generateTop() ?>
    
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
        </div>
        <div class="year blauw">
            <label class="blauw" for="year">select year</label>
            <select class="blauw" id="year" name="year">
                <optgroup class="blauw" label="YEAR">
                    <option class="blauw" value=""></option>
                    <option class="blauw" value="2005">2005</option>
                    <option class="blauw" value="2006">2006</option>
                    <option class="blauw" value="2007">2007</option>
                </optgroup>
            </select>
        </div>
        <div class="genre wit">
            <label class="wit" for="genre">select genre</label>
            <select class="wit" id="genre" name="genre">
                <optgroup class="wit" label="GENRE">
                    <option class="wit" value=""></option>
                    <option class="wit" value="drama">DRAMA</option>
                    <option class="wit" value="crime">CRIME</option>
                    <option class="wit" value="horror">HORROR</option>
                </optgroup>
        </div>
    </form>
    <?= generateFooter() ?>
</body>

</html>
<?php
require_once 'db_connectie.php';

function getContent()
{
    // if (count($_GET) == 2) {
    // } elseif ((count($_GET) == 1) && (isset($_GET['movie_id']))) {
    //     return getMovie($_GET['movie_id']);
    // } elseif ((count($_GET) == 1) && (isset($_GET['genre']))) {
    //     return getMovieByGenre($_GET['genre']);
    // } else {
    //     $text = "";
    //     for ($i = 0; $i < 30; $i++) {
    //         $color = getColor();
    //         $size = getSize();
    //         $line = "<div class='{$color} {$size}'> {$i} </div>";
    //         $text .= $line;
    //     }

    //     return $text;
    // }

    if (sizeof($_GET) > 0) {
        return getMovieBySearch();
    } else {
        $text = "";
        for ($i = 0; $i < 30; $i++) {
            $color = getColor();
            $size = getSize();
            $line = "<div class='{$color} {$size}'> {$i} </div>";
            $text .= $line;
        }

        return $text;
    }
}

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

function getMovie($id)
{
    $db = maakVerbinding();
    $sql = "select * from movie
            where movie_id = (:movie_id)";
    $query = $db->prepare($sql);
    $query->execute(['movie_id' => $id]);
    $content = "";

    while ($rij = $query->fetch()) {
        $content .= "<div class='wit thumbnail'>" . "<img src='assets/" . $rij['cover_image']  . "' alt='." . $rij['title'] . "'><div>" . $rij['title'] . "</div></div>";
    }

    return $content;
}

function getMovieByGenre($id)
{
    $db = maakVerbinding();
    $sql = "select * from movie m
            join movie_genre mg on m.movie_id=mg.movie_id
            where genre_name = (:genre)";
    $query = $db->prepare($sql);
    $query->execute(['genre' => $id]);
    $content = "";

    while ($rij = $query->fetch()) {
        $content .= createFiller();
        $color = getColor();
        $size = getSize();
        $line = "<div class='{$color} thumbnail'>" . "<img src='assets/" . $rij['cover_image'] . "' alt='" . $rij['title']  . "'><div>" . $rij['title'] . "</div></div>";
        $content .= $line;
    }

    return $content;
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

function getMovieBySearch()
{
    $db = maakVerbinding();

    $genre = "";
    if (isset($_GET['genre'])) {
        $genre = $_GET['genre'];
    };
    $year = "";
    if (isset($_GET['year'])) {
        $year = $_GET['year'];
    };
    $title = "";
    if (isset($_GET['title'])) {
        $title = $_GET['title'];
    };
    $name = "";
    $name2 = "";
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
        $name2 = $_GET['name'];
    };

    $counter = 0;
    $whereClause = " where (";
    if (isset($_GET['genre'])) {
        $whereClause .= " (mg.genre_name = (:genre)) ";
        $counter++;
    }
    if (isset($_GET['year'])) {
        if ($counter > 0) {
            $whereClause .= "AND ";
        }
        $whereClause .= " (m.publication_year = (:year)) ";
        $counter++;
    }
    if (isset($_GET['title'])) {
        if ($counter > 0) {
            $whereClause .= "AND ";
        }
        $whereClause .= " m.title like concat ('%', (:title), '%') ";
        $counter++;
    }
    if (isset($_GET['name'])) {
        if ($counter > 0) {
            $whereClause .= "AND ";
        }
        // $whereClause .= " ( (pc.lastname LIKE '%(:name)%') OR (pd.lastname LIKE '%(:name)%') )";
        $whereClause .= " (pc.lastname like concat ('%', (:name), '%') OR pd.lastname like concat ('%', (:name2), '%') )";
        // $whereClause .= " (pc.lastname OR pd.lastname) like concat ('%', (:name), '%') ";
    }
    // $whereClause .= ")";
    $whereClause .= ")
                    GROUP BY m.movie_id, m.title, m.cover_image";

    // $sql = "select * from movie m
    //         join movie_genre mg on m.movie_id = mg.movie_id
    //         join movie_Cast mc on m.movie_id = mc.movie_id
    //         join movie_director md on m.movie_id = md.movie_id
    //         join person pc on mc.person_id = pc.person_id
    //         join person pd on md.person_id = pd.person_id";
    $sql = "select m.movie_id, m.title, m.cover_image from movie m
            join movie_genre mg on m.movie_id = mg.movie_id
            join movie_Cast mc on m.movie_id = mc.movie_id
            join movie_director md on m.movie_id = md.movie_id
            join person pc on mc.person_id = pc.person_id
            join person pd on md.person_id = pd.person_id";
    $sql .= $whereClause;

    $query = $db->prepare($sql);
    // $query->execute([':genre' => $genre, ':year' => $year, ':title' => $title, ':name' => $name]);
    // $query->execute([':genre' => $genre, ':year' => $year]);

    if (sizeof($_GET) == 4) {
        $query->execute([':genre' => $genre, ':year' => $year, ':title' => $title, ':name' => $name, ':name2' => $name2]);
    }
    if (sizeof($_GET) == 3) {
        if (!isset($_GET['genre'])) {
            $query->execute([':year' => $year, ':title' => $title, ':name' => $name, ':name2' => $name2]);
        } elseif (!isset($_GET['year'])) {
            $query->execute([':genre' => $genre, ':title' => $title, ':name' => $name, ':name2' => $name2]);
        } elseif (!isset($_GET['title'])) {
            $query->execute([':genre' => $genre, ':year' => $year, ':name' => $name, ':name2' => $name2]);
        } elseif (!isset($_GET['name'])) {
            $query->execute([':genre' => $genre, ':year' => $year, ':title' => $title]);
        }
    }
    if (sizeof($_GET) == 1) {
        if (isset($_GET['genre'])) {
            $query->execute([':genre' => $genre]);
        } elseif (isset($_GET['year'])) {
            $query->execute([':year' => $year]);
        } elseif (isset($_GET['title'])) {
            $query->execute([':title' => $title]);
        } elseif (isset($_GET['name'])) {
            $query->execute([':name' => $name, ':name2' => $name2]);
        }
    }
    if (sizeof($_GET) == 2) {
        if (isset($_GET['genre'])) {
            if (isset($_GET['year'])) {
                $query->execute([':genre' => $genre, ':year' => $year]);
            } elseif (isset($_GET['title'])) {
                $query->execute([':genre' => $genre, ':title' => $title]);
            } elseif (isset($_GET['name'])) {
                $query->execute([':genre' => $genre, ':name' => $name, ':name2' => $name2]);
            }
        } elseif (isset($_GET['year'])) {
            if (isset($_GET['title'])) {
                $query->execute([':year' => $year, ':title' => $title]);
            } elseif (isset($_GET['name'])) {
                $query->execute([':year' => $year, ':name' => $name, ':name2' => $name2]);
            }
        } elseif (isset($_GET['title'])) {
            $query->execute([':title' => $title, ':name' => $name, ':name2' => $name2]);
        }
    }


    $content = "";

    while ($rij = $query->fetch()) {
        $content .= createFiller();
        $color = getColor();
        // $size = getSize();
        $line = "<div class='{$color} thumbnail'>" . "<img src='assets/" . $rij['cover_image'] . "' alt='" . $rij['title']  . "'><div>" . $rij['title'] . "</div></div>";
        $content .= $line;
    }

    return $content;
    // return $sql;
}
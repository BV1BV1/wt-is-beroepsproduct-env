<?php require_once('./services/db.php') ?>

<?php
function getMovies($genre)
{
    $sql = "SELECT M.name FROM MOVIE M INNER JOIN GENRE G ON M.GENRE_ID = G.ID WHERE G.Name like '%  :genre  %' ";

    $query = getConnection()->prepare($sql);
    // $results = $query->execute([':genre' => $genre]);
    $results = $query->execute([':genre' => $genre]);
    return var_dump($results);
}
?>
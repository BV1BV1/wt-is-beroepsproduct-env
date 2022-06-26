<?php
include_once "session.php";
require_once "db_connectie.php";
require_once "model/movies.php";

addMovieToWatchlist($_POST['movie_id'], $email = $_SESSION['email']);
$redirect = 'Location: movie.php?movie_id=';
$redirect .= $_POST['movie_id'];

header($redirect);

echo var_dump($redirect);

exit();
<?php

session_start();

if (!isset($_SESSION['paginasbezocht'])) {
    $_SESSION['paginasbezocht'] = 0;
} else {
    $_SESSION['paginasbezocht']++;
}

if (!isset($_SESSION['loggedIn'])) {
    $_SESSION['loggedIn'] = false;
} 

// echo "<div>" . $_SESSION['paginasbezocht']  .  "</div>";
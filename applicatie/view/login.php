<?php
include_once "session.php";

function displayWelcome()
{
    $username = $_SESSION['username'];
    $html = '<h1 class="geel welcomeMessage">Welcome ' . htmlspecialchars($username) . '</h1>';
    return $html;
}

function createLoginScreen()
{
    $html = '
        <form class="wit loginForm" action="processLogin.php" method="post">
            <label class="wit" for="email">e-mail address</label>
            <input class="wit" type="email" id="email" name="email" required>
            <label class="wit" for="text">password</label>
            <input class="wit" type="password" id="password" name="password" required>
            <input class="wit" type="submit" value="Log in">
        </form>
        ';

    return $html;
}
<?php
include_once "session.php";

function displayWelcome()
{
    $html = '
    <h1 class="wit">Welcome' . htmlspecialchars($_SESSION['username']) . ' !</h1>
    ';
    return $html;
}

function createLoginScreen()
{
    $html = '
        <form class="wit loginForm spanC2R2" action="processLogin.php" method="post">
            <label class="wit" for="email">e-mail address</label>
            <input class="wit" type="email" id="email" name="email" required>
            <label class="wit" for="text">password</label>
            <input class="wit" type="password" id="password" name="password" required>
            <input class="wit submitbutton" type="submit" value="Log in">
        </form>
        ';

    return $html;
}